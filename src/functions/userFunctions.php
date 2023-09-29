<?php

function isEmailCorrect($connection,$email){
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where email = '".$email."'");
    return ($resultaat->num_rows == 0) ? false : true;
}
function isPasswordCorrect($connection,$password,$email){
    $resultaat = $connection->query("SELECT * FROM tblgebruikers where email = '".$email."'");
    return (password_verify($password,$resultaat->fetch_assoc()['wachtwoord']))?true:false;
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