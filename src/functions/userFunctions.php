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
function addProduct($connection, $naam, $beschrijving, $prijs, $categorie, $foto){
    return($connection ->query("INSERT INTO tblproducten (verkoperid,naam, beschrijving, prijs, categorie, foto ) VALUES (0,'".$naam."'
        , '".$beschrijving."','" .$prijs."','" .$categorie."','" .$foto."')"));
}

?>
