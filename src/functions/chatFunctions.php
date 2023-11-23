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

function createChat ($mysqli, $gesprekid,$ontvangersid,$zenderid, $link) {
    $sql = ("INSERT INTO tblchat (gesprekid, ontvangerid, zenderid, link)
    VALUES ('".$gesprekid."'," . $ontvangersid . ",".$zenderid.", '".$link."')") ;
    return $mysqli->query($sql);
}

function deleteNotification($mysqli, $id) {
    $sql = ("DELETE FROM tblnotifications WHERE id = " .$id); 
    return $mysqli -> query($sql); 
}

function deletechat($mysqli, $chatid) {
    $sql = ("DELETE FROM tblchat WHERE gesprekid= '" .$chatid."'"); 
    return $mysqli -> query($sql); 
}

function checkIfChatExists($connection,$userid,$otherUserId){
    $query = "SELECT * FROM tblchat where ontvangerid='".$userid."' OR zenderid='".$userid."'
    AND ontvangerid='".$otherUserId."' OR zenderid='".$otherUserId."'";
    $resultaat = $connection->query($query);
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC);
}
?>