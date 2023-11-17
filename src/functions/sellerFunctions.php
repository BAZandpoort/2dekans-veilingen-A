<?php  
include '../src/components/util.php';
function addProduct($userid,$naam, $beschrijving, $prijs, $categorie, $foto, $eindtijd){
    $query = "INSERT INTO tblproducten (verkoperid,naam, beschrijving, prijs, categorie, foto, eindtijd ) VALUES (?,?,?,?,?,?,?)";
    return(insert($query,
        ['type'=>'i', 'value'=>$userid],
        ['type'=>'s', 'value'=>$naam],
        ['type'=>'s', 'value'=>$beschrijving],
        ['type'=>'d', 'value'=>$prijs],
        ['type'=>'s', 'value'=>$categorie],
        ['type'=>'s', 'value'=>$foto],
        ['type'=>'s', 'value'=>$eindtijd]
    ));
}

function modifyProduct($naam ,$productID ,$beschrijving, $prijs, $categorie, $foto){
    if(empty($foto)) {
        if(getProduct($productID)){
            $foto = getProductPicture($productID);
        }
    }
    $query = "UPDATE tblproducten SET naam =?, beschrijving =?, prijs =?, categorie =?, foto =? WHERE productid =?";
    return(insert($query,
        ['type'=>'s', 'value'=>$naam],
        ['type'=>'s', 'value'=>$beschrijving],
        ['type'=>'d', 'value'=>$prijs],
        ['type'=>'s', 'value'=>$categorie],
        ['type'=>'s', 'value'=>$foto],
        ['type'=>'i', 'value'=>$productID]
    ));
}

function getProduct($productID){
    return fetch("SELECT * FROM tblproducten WHERE productid =?",['type'=>'i', 'value'=>$productID]);
}
function getProductCategorie($productID){  
    $resultaat = fetch("SELECT categorie FROM tblproducten where productid=?",['type'=>'i', 'value'=> $productID]);
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['categorie'];
}
function getProductPicture($productID) {
    return getProduct($productID)->fetch_assoc()['foto'];
}

function getSeller($sellerID) {
    return (fetch("SELECT * FROM tblgebruikers WHERE gebruikerid =?",['type'=>'i', 'value'=>$sellerID])); 
};

function getSellerName($sellerID) {
    return getSeller($sellerID)->fetch_assoc()['voornaam'];
};

function getSellerLastName($sellerID) {
    return getSeller($sellerID)->fetch_assoc()['naam'];
};

function getSellerProductInfo($verkoperid) {
    return (fetch("SELECT * FROM tblproducten WHERE verkoperid =?",['type'=>'i', 'value'=>$verkoperid])); 
};

function getProductPrice($productid){
    return getProduct($productid)->fetch_assoc()['prijs'];
}

function getProductSellerid($productid){
    return getProduct($productid)->fetch_assoc()['verkoperid'];
}
function getProductTime($productid){
    return getProduct($productid)->fetch_assoc()['eindtijd'];
}

function getSellerProducts($sellerID){
    $resultaat = fetch("SELECT * FROM tblproducten WHERE verkoperid =?",['type'=>'i', 'value'=>$sellerID]);
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
    
};


?>