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
?>