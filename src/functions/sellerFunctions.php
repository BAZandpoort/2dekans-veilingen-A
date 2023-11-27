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

function getSeller($connection, $sellerID) {
    return ($connection->query("SELECT * FROM tblgebruikers WHERE gebruikerid = '".$sellerID."'")); 
};

function getSellerName($connection, $sellerID) {
    return getSeller($connection, $sellerID)->fetch_assoc()['voornaam'];
};

function getSellerLastName($connection, $sellerID) {
    return getSeller($connection, $sellerID)->fetch_assoc()['naam'];
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