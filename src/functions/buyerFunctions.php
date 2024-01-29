<?php
require_once '../src/components/util.php';
function getHighestBid($productid) {
    $resultaat = fetch("SELECT MAX(bod) AS highest_bid FROM tblboden WHERE productid = ?",['type'=>'i', 'value'=>$productid]);
    $row = $resultaat->fetch_assoc();

    if (!(isset($row['highest_bid']))) {
        return "-";
    } else {
        return $row['highest_bid'];
    }
}

function addProductToFavorites($productid, $gebruikerid) {
    $resultaat = insert("INSERT INTO tblfavorieten (productid, gebruikerid) VALUES (?,?)",
        ['type'=>'i', 'value'=>$productid],
        ['type'=>'i', 'value'=>$gebruikerid]
    );
 return $resultaat;
}
function getBuyer($connection,$productid) {
    $resultaat = $connection->query("SELECT gebruikersid FROM tblboden WHERE bod = '".getHighestBid($connection,$productid)."' AND productid = '".$productid."'");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()["gebruikersid"];
}

function addFactuur($connection, $productid,$datum) {
    if (getBuyer($connection,$productid) == false) {
        return;
    }
    $check = $connection->query("SELECT count(*) FROM tblfacturen WHERE productid = '".$productid."' AND koperid = '".getBuyer($connection,$productid)."'");
    $count = $check->fetch_assoc()["count(*)"];
    if ($count <= 0) { 
     $resultaat = $connection->query("INSERT INTO tblfacturen (productid,koperid,datum) VALUES ('".$productid."','".getBuyer($connection,$productid)."','".$datum."')");
     return $resultaat;
    }
}

function deleteProductFromFavorites($productid, $gebruikerid) {
    $resultaat = insert("DELETE FROM tblfavorieten WHERE productid =? AND gebruikerid =?",
        ['type'=>'i', 'value'=>$productid],
        ['type'=>'i', 'value'=>$gebruikerid]
    );
    return $resultaat;
}

function getAllPurchases($userid) {
    $query = "SELECT tblproducten.foto, tblproducten.naam AS naam_product, MAX(tblboden.bod) AS highest_bid, tblgebruikers.voornaam, tblgebruikers.naam, tblfacturen.datum
    FROM tblfacturen
    INNER JOIN tblproducten ON (tblfacturen.productid = tblproducten.productid)
    INNER JOIN tblboden ON (tblboden.productid = tblfacturen.productid)
    INNER JOIN tblgebruikers ON (tblproducten.verkoperid = tblgebruikers.gebruikerid)
    WHERE tblfacturen.koperid = ?
    HAVING MAX(tblboden.bod) IS NOT null";
    $resultaat = fetch($query,['type'=>'i', 'value'=>$userid]);

    return ($resultaat->num_rows == 0)?null:$resultaat;
}

function getLastPurchases($userid, $limit) {
    $query = "SELECT tblproducten.foto, tblproducten.productid, tblproducten.naam AS naam_product, tblgebruikers.voornaam, tblgebruikers.naam, tblfacturen.datum
    FROM tblfacturen
    INNER JOIN tblproducten ON (tblfacturen.productid = tblproducten.productid)
    INNER JOIN tblgebruikers ON (tblproducten.verkoperid = tblgebruikers.gebruikerid)
    WHERE tblfacturen.koperid =? LIMIT ?";
    $resultaat = fetch($query,
        ['type'=>'i', 'value'=>$userid],
        ['type'=>'i', 'value'=>$limit]
    );
    return $resultaat;
}

function getTotalBoughtProducts($userid) {
    $query = "SELECT COUNT(tblfacturen.productid) AS count
    FROM tblfacturen
    WHERE tblfacturen.koperid = ?";
    $resultaat = fetch($query,['type'=>'i', 'value'=>$userid]);
    $row = $resultaat->fetch_assoc();

    return $row['count'];
}

function getTotalExpenses($userid) {
    $query = "SELECT SUM(hoogste_bod) AS totale_omzet
    FROM (
        SELECT MAX(tblboden.bod) AS hoogste_bod
        FROM tblboden
        INNER JOIN tblproducten ON tblboden.productid = tblproducten.productid
        INNER JOIN tblfacturen ON tblfacturen.koperid = tblboden.gebruikersid
        WHERE tblfacturen.koperid = ?
        AND CURRENT_TIMESTAMP > tblproducten.eindtijd
        GROUP BY tblproducten.productid
    ) AS subquery";
    $resultaat = fetch($query,['type'=>'i', 'value'=>$userid]);

    $row = $resultaat->fetch_assoc();

    if($row['totale_omzet'] == null) {
        return 0;
    } else {
        return $row['totale_omzet'];
    }
}
?> 