<?php  
function addProduct($connection, $userid,$naam, $beschrijving, $prijs, $categorie, $foto, $eindtijd){
    return($connection ->query("INSERT INTO tblproducten (verkoperid,naam, beschrijving, prijs, categorie, foto, eindtijd ) VALUES ($userid,'".$naam."'
        , '".$beschrijving."','" .$prijs."','" .$categorie."','" .$foto."','".$eindtijd."')"));
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