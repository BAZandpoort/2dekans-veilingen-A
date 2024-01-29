<?php  
require_once '../src/components/util.php';
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

function getTotalSoldProducts($connection, $sellerID) {
    $resultaat = $connection->query("SELECT COUNT(tblproducten.naam) AS total_sold FROM tblfacturen
                                     INNER JOIN tblproducten ON (tblproducten.productid = tblfacturen.productid) 
                                     WHERE tblproducten.verkoperid = ".$sellerID." AND CURRENT_TIMESTAMP > eindtijd");

    $row = $resultaat->fetch_assoc();
    return $row['total_sold'];
}

function getTotalActiveProducts($connection, $sellerID) {
    $resultaat = $connection->query("SELECT COUNT(naam) AS total_active_products FROM tblproducten WHERE verkoperid = ".$sellerID." AND CURRENT_TIMESTAMP < eindtijd");

    $row = $resultaat->fetch_assoc();
    return $row['total_active_products'];
}

function getActiveProducts ($connection, $sellerID) {
    $resultaat = $connection->query("SELECT tblproducten.productid, tblproducten.naam AS naam_product, tblproducten.foto, tblproducten.startdatum AS datum, tblgebruikers.voornaam, tblgebruikers.naam FROM tblproducten INNER JOIN tblgebruikers ON (tblgebruikers.gebruikerid = tblproducten.verkoperid) WHERE verkoperid = ".$sellerID." AND CURRENT_TIMESTAMP < eindtijd");

    if(mysqli_num_rows($resultaat) == 0) {
        return null;
    } else {
        return $resultaat;
    }
}

function getTotalRevenue($connection, $sellerID) {
    $resultaat = $connection->query("
    SELECT SUM(hoogste_bod) AS totale_omzet
    FROM (
        SELECT MAX(tblboden.bod) AS hoogste_bod
        FROM tblboden
        INNER JOIN tblproducten ON tblboden.productid = tblproducten.productid
        WHERE tblproducten.verkoperid = ".$sellerID."
        AND CURRENT_TIMESTAMP > tblproducten.eindtijd
        GROUP BY tblproducten.productid
    ) AS subquery");

    $row = $resultaat->fetch_assoc();

    if($row['totale_omzet'] == null) {
        return 0;
    } else {
        return $row['totale_omzet'];
    }
}

function getLastSales ($connection, $sellerID, $limit) {
    $resultaat = $connection->query("
    SELECT tblproducten.naam AS naam_product, tblproducten.productid, tblproducten.foto, tblgebruikers.voornaam, tblgebruikers.naam, tblfacturen.datum 
    FROM tblfacturen 
    INNER JOIN tblproducten ON tblproducten.productid = tblfacturen.productid
    INNER JOIN tblgebruikers ON tblgebruikers.gebruikerid = tblproducten.verkoperid
    WHERE tblproducten.verkoperid = ".$sellerID."
    LIMIT ".$limit."
    ");

    return $resultaat;
}

function getAllSales ($connection, $sellerID) {
    $resultaat = $connection->query(" SELECT tblproducten.naam AS naam_product, tblproducten.productid, tblproducten.foto, tblgebruikers.voornaam, tblgebruikers.naam, tblfacturen.datum 
                                      FROM tblfacturen 
                                      INNER JOIN tblproducten ON tblproducten.productid = tblfacturen.productid
                                      INNER JOIN tblgebruikers ON tblgebruikers.gebruikerid = tblproducten.verkoperid
                                      WHERE tblproducten.verkoperid = ".$sellerID."
                                    ");

    if(mysqli_num_rows($resultaat) == 0) {
        return null;
    } else {
        return $resultaat;
    }
}


?>