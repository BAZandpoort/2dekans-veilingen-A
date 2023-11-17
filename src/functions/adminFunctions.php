<?php

function getTimeDifference($endTime) {
    $time = strtotime($endTime) - strtotime(date("Y-m-d H:i:s"));
    return $time;
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

function changeReportChecked($connection, $rapportid) {
        $sql = "UPDATE tblrapporten set behandeld = 1 WHERE rapportid = '". $rapportid. "'";
        return ($connection->query($sql));
}
function changeReportUnchecked($connection, $rapportid) {
    $sql = "UPDATE tblrapporten set behandeld = 0 WHERE rapportid = '". $rapportid. "'";
    return ($connection->query($sql));
}

?>