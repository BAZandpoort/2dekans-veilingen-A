<?php
include "../src/components/util.php";
?>
<?php

function isEmailCorrect($email){
    $resultaat = fetch("SELECT * FROM tblgebruikers where email = ?",['type' => 's', 'value' => $email]);
    return ($resultaat->num_rows == 0) ? false : true;
}
function isPasswordCorrect($password,$email){
    $resultaat = fetch("SELECT * FROM tblgebruikers where email = ?",['type' => 's', 'value' => $email]);
    return (password_verify($password,$resultaat->fetch_assoc()['wachtwoord']))?true:false;
}

function getAllCategories(){
    $resultaat = fetch("SELECT * FROM tblcategorieen");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
}

function registerUser($fname, $lname, $email, $password, $adres, $profile_picture, $desc) {
    if(empty($profile_picture)) {
        $profile_picture = "profile.png";
    }

    $password = convertPasswordToHash($password);

    $resultaat = insert("INSERT INTO tblgebruikers (email, voornaam, naam, wachtwoord, adres, profielfoto, beschrijving) VALUES ('?','?','?','?','?','?','?')",
    ['type' => 's', 'value' => $email],  
    ['type' => 's', 'value' => $fname],
    ['type' => 's', 'value' => $lname],
    ['type' => 's', 'value' => $password],
    ['type' => 's', 'value' => $adres],
    ['type' => 's', 'value' => $profile_picture],
    ['type' => 's', 'value' => $desc]    
    );
    return $resultaat;
}

function updateUser($userid, $fname, $lname, $email, $password, $profile_picture, $desc,$adres) {
    if(empty($profile_picture)) {
        if(getProfilePicture($userid)){
            $profile_picture = getProfilePicture($userid);
        }
    }
    if(empty($password)){
        $resultaat = insert("UPDATE tblgebruikers set email = '?', voornaam = '?', naam = '?', adres = '?', profielfoto = '?', beschrijving = '?' where gebruikerid = '?'",
        ['type' => 's', 'value' => $email],  
        ['type' => 's', 'value' => $fname],
        ['type' => 's', 'value' => $lname],
        ['type' => 's', 'value' => $adres],
        ['type' => 's', 'value' => $profile_picture],
        ['type' => 's', 'value' => $desc],
        ['type' => 'i', 'value' => $userid]
    );
        return $resultaat;
    }else{
        $password = convertPasswordToHash($password);

        return (insert("UPDATE tblgebruikers set email = '?', voornaam = '?', naam = '?', wachtwoord = '?', adres = '?', profielfoto = '?', beschrijving = '?' where gebruikerid = '?'",
        ['type' => 's', 'value' => $email],  
        ['type' => 's', 'value' => $fname],
        ['type' => 's', 'value' => $lname],
        ['type' => 's', 'value' => $password],
        ['type' => 's', 'value' => $adres],
        ['type' => 's', 'value' => $profile_picture],
        ['type' => 's', 'value' => $desc],
        ['type' => 'i', 'value' => $userid]    
    ));
    }
}

function convertPasswordToHash($password) {
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
    return $hashedpassword;
}

function getAllFavourites($userid) {
    $resultaat = fetch("SELECT tblfavorieten.productid, tblproducten.foto, tblproducten.naam, tblproducten.eindtijd, tblgebruikers.voornaam, tblgebruikers.naam AS achternaam
                               FROM tblfavorieten
                               INNER JOIN tblproducten ON (tblproducten.productid = tblfavorieten.productid)
                               INNER JOIN tblgebruikers ON (tblgebruikers.gebruikerid = tblfavorieten.gebruikerid)
                               WHERE tblgebruikers.gebruikerid = ?", ['type' => 'i', 'value' => $userid]);
    return ($resultaat->fetch_all(MYSQLI_ASSOC));
}
function getUser($gebruikerid){
    $resultaat = fetch("SELECT * FROM tblgebruikers where gebruikerid= ?", ['type' => 'i', 'value' => $gebruikerid]);
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
}
function getProfilePicture($userid){
    $resultaat =fetch("SELECT * FROM tblgebruikers where gebruikerid= ?", ['type' => 'i', 'value' => $userid]);
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['profielfoto'];
}

function getGebruikersid($email){
    $resultaat = fetch("SELECT * FROM tblgebruikers where email = ?",['type' => 's', 'value' => $email]);
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['gebruikerid'];
}
function checkIfAdmin($email){
    $resultaat = fetch("SELECT * FROM tblgebruikers where email = ? and admin=1", ['type' => 's', 'value' => $email]);
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
}
function getAdressFromUser($userid) {
    return getUser( $userid)->fetch_assoc()['adres'];
}

function getDataTblproducten(){
    $resultaat = fetch("SELECT * FROM tblproducten");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
}

function getGekozenCategorie($categorietype) {
    return (fetch("SELECT * FROM tblproducten WHERE categorie='?'",['type' => 's', 'value' => $categorietype]));
}

function createSearchlist($searchItem) {
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
   
    foreach(getSearchResults($searchItem) as $row) {
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

function getSearchResults($searchItem) {
    return (fetch("SELECT * from tblproducten WHERE naam LIKE '?%' OR naam='?'",['type' => 's', 'value' => $searchItem],['type' => 's', 'value' => $searchItem]));
}

function getNumSearchResult($list) {
    return count($list);
}

function addReport($gebruikerid, $melderid, $reden, $behandeld) {
    $resultaat = insert("INSERT INTO tblrapporten (gebruikerid, melderid, reden, behandeld) VALUES ('?','?','?', '?')",
    ['type' => 'i', 'value' => $gebruikerid],
    ['type' => 'i', 'value' => $melderid],
    ['type' => 's', 'value' => $reden],
    ['type' => 'i', 'value' => $$behandeld],
);
    return $resultaat;
}
?>