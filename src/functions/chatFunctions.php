<?php
function getChatData($mysqli, $id){
    $resultaat = $mysqli->query("SELECT * FROM tblchat WHERE zenderid= '".$id."' or ontvangerid= '".$id."'"); 
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC); 
}

function InsertIntoChatTbl($mysqli, $ontvanger, $zenderVoornaam, $zenderAchternaam, $bericht, $chatid){
    $sql = "INSERT INTO tblchat(gesprekID, ontvanger, zenderVoornaam, zenderAchternaam, bericht) VALUES ('".$chatid."','".$ontvanger."','".$zenderVoornaam."','".$zenderAchternaam ."','".$bericht."')";
    return $mysqli->query($sql);
    
}
function getZender($mysqli,$gebruikersid) {
 $resultaat = $mysqli->query("SELECT * FROM tblgebruikers WHERE gebruikerid = '".$gebruikersid."'"); 
 return ($resultaat ->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC); 
}

function getOntvanger ($mysqli,$user) {
    $resultaat = $mysqli->query("SELECT * FROM tblgebruikers WHERE gebruikerid = '".$user."'");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['voornaam']; 
}

function getnotification($mysqli,$user) {
    $resultaat = $mysqli ->query("SELECT* FROM tblnotifications WHERE ontvangersid=".$user." ORDER BY id DESC"); 
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC); 
}

function updateNotification ($mysqli, $id) {
    $sql = ("UPDATE tblnotifications
    SET status = '1'
    WHERE id = ".$id); 
    return $mysqli -> query($sql); 
}

function createNotification ($mysqli, $ontvangersid, $link) {
    $sql = ("INSERT INTO tblnotifications (notificatie, ontvangersid, status, link)
    VALUES ('Je hebt een nieuw bericht'," . $ontvangersid . ",0, '".$link."')") ;
    return $mysqli->query($sql);
}

function deleteNotification($mysqli, $id) {
    $sql = ("DELETE FROM tblnotifications WHERE id = " .$id); 
    return $mysqli -> query($sql); 
}

function delectechat($mysqli, $chatid) {
    $sql = ("DELETE FROM tblnotifications WHERE id= '" .$chatid."'"); 
    return $mysqli -> query($sql); 
}
?>