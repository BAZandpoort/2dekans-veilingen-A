<?php
function getHighestBid($connection, $productid) {
    $resultaat = $connection->query("SELECT MAX(bod) AS highest_bid FROM tblboden WHERE productid = ".$productid."");
    $row = $resultaat->fetch_assoc();

    if (!(isset($row['highest_bid']))) {
        return "-";
    } else {
        return $row['highest_bid'];
    }
}

function getBuyer($connection,$productid) {
    $resultaat = $connection->query("SELECT gebruikersid FROM tblboden WHERE bod = '".getHighestBid($connection,$productid)."' AND productid = '".$productid."'");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['gebruikersid'];
}

function addFactuur($connection, $productid,$datum) {
    $check = $connection->query("SELECT count(*) FROM tblfacturen WHERE productid = '".$productid."' AND koperid = '".getBuyer($connection,$productid)."'");
    $count = $check->fetch_assoc()["count(*)"];
    if ($count <= 0) { 
     $resultaat = $connection->query("INSERT INTO tblfacturen (productid,koperid,datum) VALUES ('".$productid."','".getBuyer($connection,$productid)."','".$datum."')");
     return $resultaat;
    }
}

function addProductToFavorites($connection, $productid, $gebruikerid) {
    $resultaat = $connection->query("INSERT INTO tblfavorieten (productid, gebruikerid) VALUES ('".$productid."','".$gebruikerid."')");
    return $resultaat;
}

function deleteProductFromFavorites($connection, $productid, $gebruikerid) {
    $resultaat = $connection->query("DELETE FROM tblfavorieten WHERE productid = '".$productid."' AND gebruikerid = '".$gebruikerid."'");
    return $resultaat;
}

function getAllPurchases($connection, $userid) {
    $resultaat = $connection->query("SELECT tblproducten.foto, tblproducten.naam AS naam_product, MAX(tblboden.bod) AS highest_bid, tblgebruikers.voornaam, tblgebruikers.naam, tblfacturen.datum, tblfacturen.factuurid
                                     FROM tblfacturen
                                     INNER JOIN tblproducten ON (tblfacturen.productid = tblproducten.productid)
                                     INNER JOIN tblboden ON (tblboden.productid = tblfacturen.productid)
                                     INNER JOIN tblgebruikers ON (tblproducten.verkoperid = tblgebruikers.gebruikerid)
                                     WHERE tblfacturen.koperid = ".$userid."
                                     HAVING MAX(tblboden.bod) IS NOT null");

    if(mysqli_num_rows($resultaat) == 0) {
        return null;
    } else {
        return $resultaat;
    }
}

function getLastPurchases($connection, $userid, $limit) {
    $resultaat = $connection->query("SELECT tblproducten.foto, tblproducten.productid, tblproducten.naam AS naam_product, tblgebruikers.voornaam, tblgebruikers.naam, tblfacturen.datum
                                     FROM tblfacturen
                                     INNER JOIN tblproducten ON (tblfacturen.productid = tblproducten.productid)
                                     INNER JOIN tblgebruikers ON (tblproducten.verkoperid = tblgebruikers.gebruikerid)
                                     WHERE tblfacturen.koperid = ".$userid."
                                     LIMIT ".$limit."");
    return $resultaat;
}

function getTotalBoughtProducts($connection, $userid) {
    $resultaat = $connection->query("SELECT COUNT(tblfacturen.productid) AS count
                                     FROM tblfacturen
                                     WHERE tblfacturen.koperid = ".$userid."");
    $row = $resultaat->fetch_assoc();

    return $row['count'];
}

function getTotalExpenses($connection, $userid) {
    $resultaat = $connection->query("
    SELECT SUM(hoogste_bod) AS totale_omzet
    FROM (
        SELECT MAX(tblboden.bod) AS hoogste_bod
        FROM tblboden
        INNER JOIN tblproducten ON tblboden.productid = tblproducten.productid
        INNER JOIN tblfacturen ON tblfacturen.koperid = tblboden.gebruikersid
        WHERE tblfacturen.koperid = ".$userid."
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
?> 