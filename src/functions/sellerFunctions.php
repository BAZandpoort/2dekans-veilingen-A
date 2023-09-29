<?php  
function addProduct($connection, $naam, $beschrijving, $prijs, $categorie, $foto,$tijd){
    return($connection ->query("INSERT INTO tblproducten (verkoperid,naam, beschrijving, prijs, categorie, foto, eindtijd ) VALUES (0,'".$naam."'
        , '".$beschrijving."','" .$prijs."','" .$categorie."','" .$foto."','".$tijd."')"));
}

?>