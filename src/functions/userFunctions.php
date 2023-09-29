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

function convertPasswordToHash($password) {
    $hashedpassword = password_hash($password, PASSWORD_DEFAULT);
    return $hashedpassword;
};

?>
