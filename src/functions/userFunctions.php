<?php

function isEmailCorrect($connection, $email)
{
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where email = '" . $email . "'");
    return ($resultaat->num_rows == 0) ? false : true;
}
function isPasswordCorrect($connection, $password, $email)
{
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where email = '" . $email . "'");
    return (password_verify($password, $resultaat->fetch_assoc()['wachtwoord'])) ? true : false;
}

function getAllCategories($connection)
{
    $resultaat = $connection->query("SELECT * FROM tblcategorieen");
    return ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
}

function registerUser($connection, $fname, $lname, $email, $password, $adres, $profile_picture, $desc)
{
    if (empty($profile_picture)) {
        $profile_picture = "profile.png";
    }

    $password = convertPasswordToHash($password);


    $resultaat = $connection->query("INSERT INTO tblgebruikers (email, voornaam, naam, wachtwoord, admin, adres, profielfoto, beschrijving,theme) VALUES ('" . $email . "','" . $fname . "','" . $lname . "','" . $password . "', 0,'" . $adres . "','" . $profile_picture . "','" . $desc . "','dark')");
    return $resultaat;
}

function updateUser($connection, $userid, $fname, $lname, $email, $password, $profile_picture, $desc, $adres)
{
    if (empty($profile_picture)) {
        if (getProfilePicture($connection, $userid)) {
            $profile_picture = getProfilePicture($connection, $userid);
        } else {
            print $connection->error;
        }
    }
    if (empty($password)) {
        $sql = "UPDATE tblgebruikers set email = '" . $email . "', voornaam = '" . $fname . "', naam = '" . $lname . "', adres = '" . $adres . "', profielfoto = '" . $profile_picture . "', beschrijving = '" . $desc . "' where gebruikerid = '" . $userid . "'";
        return ($connection->query($sql));
    } else {
        $password = convertPasswordToHash($password);

        return ($connection->query("UPDATE tblgebruikers set email = '" . $email . "', voornaam = '" . $fname . "', naam = '" . $lname . "',
        wachtwoord = '" . $password . "', adres = '" . $adres . "', profielfoto = '" . $profile_picture . "', beschrijving = '" . $desc . "' where gebruikerid = '" . $userid . "'"));
    }
}

function convertPasswordToHash($password)
{
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
    return $hashedpassword;
}

function getAllFavourites($connection, $userid)
{
    $resultaat = $connection->query("SELECT tblfavorieten.productid, tblproducten.foto, tblproducten.naam, tblproducten.eindtijd, tblgebruikers.voornaam, tblgebruikers.naam AS achternaam
                               FROM tblfavorieten 
                               INNER JOIN tblproducten ON (tblproducten.productid = tblfavorieten.productid)
                               INNER JOIN tblgebruikers ON (tblgebruikers.gebruikerid = tblfavorieten.gebruikerid)
                               WHERE tblgebruikers.gebruikerid = " . $userid . "");
    return $resultaat;
}
function getUser($connection, $gebruikerid)
{
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where gebruikerid= '" . $gebruikerid . "'");
    return ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
}

function getProfilePicture($connection, $userid)
{
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where gebruikerid= '" . $userid . "'");
    return ($resultaat->num_rows == 0) ? false : $resultaat->fetch_assoc()['profielfoto'];
}

function getGebruikersid($connection, $email)
{
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where email = '" . $email . "'");
    return ($resultaat->num_rows == 0) ? false : $resultaat->fetch_assoc()['gebruikerid'];
}
function checkIfAdmin($connection, $email)
{
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where email = '" . $email . "' and admin=1");
    return ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
}
function getAdressFromUser($connection, $userid)
{
    return getUser($connection, $userid)->fetch_assoc()['adres'];
}

function getDataTblproducten($mysqli)
{
    $resultaat = $mysqli->query("SELECT * FROM tblproducten");
    return ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
}

function getDataTblproductenreclame($mysqli)
{
    $resultaat = $mysqli->query("SELECT *  FROM tblproducten, tblgebruikers WHERE reclame = 1 AND gebruikerid = verkoperid");
    return ($resultaat->num_rows == 0) ? false : $resultaat->fetch_all(MYSQLI_ASSOC);
}
function getGekozenCategorie($connection, $categorietype)
{
    return ($connection->query("SELECT * FROM tblproducten WHERE categorie='" . $categorietype . "'"));
}

function createSearchlist($connection, $searchItem)
{
    $lijst = array();
    $item = array(
        "productid" => "",
        "verkoperid" => "",
        "foto" => "",
        "naam" => "",
        "prijs" => "",
        "beschrijving" => "",
        "categorie" => "",
        "startdatum" => "",
        "eindtijd" => ""
    );

    foreach (getSearchResults($connection, $searchItem) as $row) {
        $item[0] = $row['productid'];
        $item[1] = $row['verkoperid'];
        $item[2] = $row['foto'];
        $item[3] = $row['naam'];
        $item[4] = $row['prijs'];
        $item[5] = $row['beschrijving'];
        $item[6] = $row['categorie'];
        $item[7] = $row['startdatum'];
        $item[8] = $row['eindtijd'];

        $lijst[] =  $item;
    };

    return $lijst;
}

function getSearchResults($connection, $searchItem)
{
    return ($connection->query("SELECT * from tblproducten WHERE naam LIKE '" . $searchItem . "%' OR naam='" . $searchItem . "'"));
}

function getNumSearchResult($list)
{
    return count($list);
}

function addReport($connection, $gebruikerid, $melderid, $reden, $behandeld)
{
    $resultaat = $connection->query("INSERT INTO tblrapporten (gebruikerid, melderid, reden, behandeld) VALUES ('" . $gebruikerid . "','" . $melderid . "','" . $reden . "', '" . $behandeld . "')");
    return $resultaat;
}
function addRate($mysqli, $rating1, $gebruikerRate, $user) {
    $resultaat = $mysqli->query("INSERT INTO tblrating (gebruikersID, raterID, rate) VALUES ('".$gebruikerRate."','".$user."','".$rating1. "')"); 
    return $resultaat;
}
function getGemiddeldeRating($mysqli, $user) {
    $query="SELECT  avg(rate) as rating FROM tblrating WHERE gebruikersID = '".$user."'";
    $resultaat = $mysqli->query($query);
   // return var_dump($resultaat); 
   return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['rating'];
}
function getCountRating($mysqli,$user) {
    $query="SELECT count(rate) as rating FROM tblrating WHERE gebruikersID = '".$user."'";
    $resultaat = $mysqli->query($query);
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['rating'];
}
function checkIfRated($mysqli, $user, $gebruikerRate) {
    $query = "SELECT count(rate) as rating FROM tblrating WHERE gebruikersID = '".$user."' AND raterID = '".$gebruikerRate."'"; 
    $resultaat = $mysqli->query($query); 
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['rating'];
}
?>
