<?php  
function addProduct($connection, $naam, $beschrijving, $prijs, $categorie, $foto){
    return($connection ->query("INSERT INTO tblproducten (verkoperid,naam, beschrijving, prijs, categorie, foto ) VALUES (0,'".$naam."'
        , '".$beschrijving."','" .$prijs."','" .$categorie."','" .$foto."')"));
}

?>