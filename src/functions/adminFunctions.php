<?php 
function getTimeDifference($endTime) {
    $currentDate = date("Y-m-d H:i:s");
    $endDate = strtotime($endTime);
    $currentDate = strtotime($currentDate);
    $timeDifference = $endDate - $currentDate;
    $timeDifference = date("H:i:s", $timeDifference);
    return $timeDifference;
}

function deleteUser($connection, $gebruikerid) {
    $resultaat = $connection->query("DELETE FROM tblgebruikers where gebruikerid = '". $gebruikerid."'");
    return $resultaat;
}

function deleteProducts($connection, $verkoperid) {
    $resultaat = $connection->query("DELETE FROM tblproducten where verkoperid = '". $verkoperid."'");
    return $resultaat;
}

function getReportedUsers($connection, $gebruikerid) {
    $resultaat = $connection->query("SELECT * FROM tblrapporten WHERE gebruikerid = ".$gebruikerid."");
    return $resultaat;
}
?>