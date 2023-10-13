<?php  

function addProduct($connection, $userid,$naam, $beschrijving, $prijs, $categorie, $foto, $eindtijd){
    return($connection ->query("INSERT INTO tblproducten (verkoperid,naam, beschrijving, prijs, categorie, foto, eindtijd ) VALUES ($userid,'".$naam."'
        , '".$beschrijving."','" .$prijs."','" .$categorie."','" .$foto."','".$eindtijd."')"));
}

function modifyProduct($connection,$naam ,$productID ,$beschrijving, $prijs, $categorie, $foto){
    if(empty($foto)) {
        if(getProduct($connection,$productID)){
            $foto = getProductPicture($connection,$productID);
        }else{
            print $connection->error;
        }
    }
    return($connection->query("UPDATE tblproducten SET naam = '".$naam."' , beschrijving = '".$beschrijving."', prijs = '" .$prijs."', categorie = '" .$categorie."', foto = '" .$foto."' WHERE productid = '".$productID."'") ) ;

}

function modifyProduct2($connection,$naam ,$productID ,$beschrijving, $prijs, $categorie){
    return($connection->query("UPDATE tblproducten SET naam = '".$naam."' , beschrijving = '".$beschrijving."', prijs = '" .$prijs."', categorie = '" .$categorie."' WHERE productid = '".$productID."'") ) ;

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

function getProductInfo($connection, $productID) {
    return ($connection->query("SELECT * FROM tblproducten WHERE productid = '".$productID."'"));
};

function getSeller($connection, $sellerID) {
    return ($connection->query("SELECT * FROM tblgebruikers WHERE gebruikerid = '".$sellerID."'")); 
};

function getSellerName($connection, $sellerID) {
    return getSeller($connection, $sellerID)->fetch_assoc()['voornaam'];
};

function getSellerLastName($connection, $sellerID) {
    return getSeller($connection, $sellerID)->fetch_assoc()['naam'];
};

?>