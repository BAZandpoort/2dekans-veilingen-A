<?php  
function addProduct($connection, $userid,$naam, $beschrijving, $prijs, $categorie, $foto, $eindtijd){
    return($connection ->query("INSERT INTO tblproducten (verkoperid,naam, beschrijving, prijs, categorie, foto, eindtijd ) VALUES ($userid,'".$naam."'
        , '".$beschrijving."','" .$prijs."','" .$categorie."','" .$foto."','".$eindtijd."')"));
}
?>