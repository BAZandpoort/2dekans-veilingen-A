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

function addProductToFavorites($connection, $productid, $gebruikerid) {
    $resultaat = $connection->query("INSERT INTO tblfavorieten (productid, gebruikerid) VALUES ('".$productid."','".$gebruikerid."')");
    return $resultaat;
}

function deleteProductFromFavorites($connection, $productid, $gebruikerid) {
    $resultaat = $connection->query("DELETE FROM tblfavorieten WHERE productid = '".$productid."' AND gebruikerid = '".$gebruikerid."'");
    return $resultaat;
}

function getAllPurchases($connection, $userid) {
    $resultaat = $connection->query("SELECT tblproducten.foto, tblproducten.naam, MAX(tblboden.bod) AS highest_bid, tblgebruikers.voornaam, tblgebruikers.naam, tblfacturen.datum
                                     FROM tblfacturen
                                     INNER JOIN tblproducten ON (tblfacturen.productid = tblproducten.productid)
                                     INNER JOIN tblboden ON (tblboden.productid = tblfacturen.productid)
                                     INNER JOIN tblgebruikers ON (tblproducten.verkoperid = tblgebruikers.gebruikerid)
                                     WHERE tblfacturen.koperid = ".$userid."");
    return $resultaat;
}
?> 