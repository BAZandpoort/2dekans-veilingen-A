<?php  
function addProduct($connection, $naam, $beschrijving, $prijs, $categorie, $foto,$tijd){
    return($connection ->query("INSERT INTO tblproducten (verkoperid,naam, beschrijving, prijs, categorie, foto, eindtijd ) VALUES (0,'".$naam."'
        , '".$beschrijving."','" .$prijs."','" .$categorie."','" .$foto."','".$tijd."')"));
}

function modifyProduct($connection,$naam ,$productID ,$beschrijving, $prijs, $categorie, $foto){
    if(empty($foto)) {
        if(getProduct($connection,$productID)){
            $foto = getProductPicture($connection,$productID);
        }else{
            print $connection->error;
        }
    }
    return($connection->query("UPDATE tblproducten SET naam = '".$naam."' , beschrijving = '".$beschrijving."', prijs = '" .$prijs."', categorie = '" .$categorie."', foto = '" .$foto."'") ) ;

}

function modifyProduct2($connection,$naam ,$productID ,$beschrijving, $prijs, $categorie){
    return($connection->query("UPDATE tblproducten SET naam = '".$naam."' , beschrijving = '".$beschrijving."', prijs = '" .$prijs."', categorie = '" .$categorie."'") ) ;

}

function getProduct($connection,$productID){
    return $connection->query("SELECT * FROM tblproducten WHERE productid = '".$productID."'");
}
function getProductCategorie($connection, $productID){  
    $resultaat = $connection->query("SELECT categorie FROM tblproducten where productid= '".$productID."'");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['categorie'];
}
function getProductPicture($connection,$productID) {
    return getProduct($connection,$productID)->fetch_assoc()['foto'];
}
?>