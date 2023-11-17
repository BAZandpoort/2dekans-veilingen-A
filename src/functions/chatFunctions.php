<?php
include "../src/connect.php";
include "../components/util.php";
function getChatData($chatid){
    $resultaat = fetch("SELECT * FROM tblchat WHERE gesprekID= ?",['type' => 'i', 'values' => $chatid]); 
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC); 
}

function InsertIntoChatTbl($ontvanger, $zenderVoornaam, $zenderAchternaam, $bericht, $chatid){
$resultaat = insert("INSERT INTO tblchat (gesprekID, ontvanger, zenderVoornaam, zenderAchternaam, bericht) VALUES ('?','?','?','?','?')",
    ['type' => 'i', 'value' => $chatid],
    ['type' => 's', 'value' => $ontvanger],
    ['type' => 's', 'value' => $zenderVoornaam], 
    ['type' => 's', 'value' => $zenderAchternaam], 
    ['type' => 's', 'value' => $bericht]
);
return $resultaat;
 
}

function getZender ($gebruikersid) {
 $resultaat = fetch("SELECT * FROM tblgebruikers WHERE gebruikerid = ?",['type' => 'i', 'value' => $gebruikersid]); 
 return ($resultaat ->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC); 
}

function getOntvanger ($user) {
    $resultaat = fetch("SELECT * FROM tblgebruikers WHERE gebruikerid = ?",['type' => 'i', 'value' => $user]);
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['voornaam']; 
}

function getnotification ($user) {
    $resultaat = fetch("SELECT * FROM tblnotifications WHERE ontvangersid= ? ORDER BY id DESC",['type' =>'i', 'value' => $user]); 
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC); 
}

function updateNotification ($id) {
    $resultaat = insert("UPDATE tblnotifications SET status = '1' WHERE id = ?",['type' => 'i', 'value' => $id]); 
    return $resultaat; 
}

function createNotification ($ontvangersid, $link) {
    $resultaat = insert("INSERT INTO tblnotifications (notificatie, ontvangersid, status, link)
    VALUES ('Je hebt een nieuw bericht',?,0,?)",
    ['type' => 'i', 'value' => $ontvangersid], 
    ['type' => 's', 'value' => $link]
    ) ;
    return $resultaat;
}
function deleteNotification($id) {
    $resultaat = insert("DELETE FROM tblnotifications WHERE id = ?",['type' => 'i', 'value' => $id]); 
    return $resultaat; 
}
function delectechat($chatid) {
    $resultaat = insert("DELETE FROM tblnotifications WHERE id=?",['type' => 'i', 'value' => $chatid]); 
    return $resultaat; 
}
?>