<?php

function isEmailCorrect($connection,$email){
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where email = '".$email."'");
    return ($resultaat->num_rows == 0) ? false : true;
}
function isPasswordCorrect($connection,$password,$email){
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where email = '".$email."'");
    return (password_verify($password,$resultaat->fetch_assoc()['wachtwoord']))?true:false;
}

function getAllCategories($connection){
    return($connection->query("SELECT * FROM tblcategorieen"));
}

function registerUser($connection, $fname, $lname, $email, $password, $profile_picture, $desc) {
    if(empty($profile_picture)) {
        $profile_picture = "profile.png";
    }

    $password = convertPasswordToHash($password);

    $resultaat = $connection->query("INSERT INTO tblgebruikers (email, voornaam, naam, wachtwoord, profielfoto, beschrijving) VALUES ('".$email."','".$fname."','".$lname."','".$password."','".$profile_picture."','".$desc."')");
    return $resultaat;
}

function updateUser($connection, $userid, $fname, $lname, $email, $password, $profile_picture, $desc) {
    if(empty($profile_picture)) {
        if(getProfilePicture($connection,$userid)){
            $profile_picture = getProfilePicture($connection,$userid);
        }else{
            print $connection->error;
        }
    }
    if(empty($password)){
        $sql = "UPDATE tblgebruikers set email = '" . $email . "', voornaam = '" . $fname . "', naam = '" . $lname . "', profielfoto = '" . $profile_picture . "', beschrijving = '" . $desc . "' where gebruikerid = '" . $userid . "'";
        return ($connection->query($sql));
    }else{
        $password = convertPasswordToHash($password);

        return ($connection->query("UPDATE tblgebruikers set email = '" . $email . "', voornaam = '" . $fname . "', naam = '" . $lname . "',
        wachtwoord = '" . $password . "', profielfoto = '" . $profile_picture . "', beschrijving = '" . $desc . "' Where gebruikerid = '" . $userid . "'"));
    }
}

function convertPasswordToHash($password) {
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
    return $hashedpassword;
}

function getAllFavourites($connection, $userid) {
    $resultaat = $connection->query("SELECT tblfavorieten.productid, tblproducten.foto, tblproducten.naam, tblgebruikers.voornaam, tblgebruikers.naam AS achternaam
                               FROM tblfavorieten 
                               INNER JOIN tblproducten ON (tblproducten.productid = tblfavorieten.productid)
                               INNER JOIN tblgebruikers ON (tblgebruikers.gebruikerid = tblfavorieten.gebruikerid)
                               WHERE tblgebruikers.gebruikerid = ".$userid."");
    return $resultaat;
}
function getUser($connection,$gebruikerid){
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where gebruikerid= '".$gebruikerid."'");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
}
function getProfilePicture($connection,$userid){
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where gebruikerid= '".$userid."'");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['profielfoto'];
}

function getGebruikersid($connection,$email){
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where email = '".$email."'");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['gebruikerid'];
}
function checkIfAdmin($connection,$email){
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where email = '".$email."'");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['"admin"'];
}
?>
