<?php 
include '../src/components/util.php';
function getTimeDifference($endTime) {
    $time = strtotime($endTime) - strtotime(date("Y-m-d H:i:s"));
    return $time;
}

function deleteUser($gebruikerid) {
    $resultaat = insert("DELETE FROM tblgebruikers where gebruikerid = ?",['type'=>'i','value'=>$gebruikerid]);
    return $resultaat;
}

function deleteProducts($verkoperid) {
    $resultaat = insert("DELETE FROM tblproducten where verkoperid = ?", ['type'=>'i', 'value'=>$verkoperid]);
    return $resultaat;
}

function getReportedUsers($gebruikerid) {
    $resultaat = fetch("SELECT * FROM tblrapporten WHERE gebruikerid = ?",['type'=>'i', 'value'=>$gebruikerid]);
    return $resultaat;
}

function changeReportChecked($rapportid) {
        $resultaat = insert("UPDATE tblrapporten set behandeld = 1 WHERE rapportid = ?",['type'=>'i', 'value'=>$rapportid]);
        return $resultaat;
}
function changeReportUnchecked($rapportid) {
    $resultaat = fetch("UPDATE tblrapporten set behandeld = 0 WHERE rapportid = ?",['type'=>'i', 'value'=>$rapportid]);
    return ($resultaat);
}

?>