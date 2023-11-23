<?php
function getChatData($mysqli, $id){
    $resultaat = $mysqli->query("SELECT * FROM tblchat WHERE zenderid= '".$id."' or ontvangerid= '".$id."'"); 
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC); 
}

function InsertIntoChatTbl($mysqli, $ontvanger, $zenderVoornaam, $zenderAchternaam, $bericht, $chatid){
    $sql = "INSERT INTO tblchat(gesprekID, ontvanger, zenderVoornaam, zenderAchternaam, bericht) VALUES ('".$chatid."','".$ontvanger."','".$zenderVoornaam."','".$zenderAchternaam ."','".$bericht."')";
    return $mysqli->query($sql);
    
}

function getOntvanger ($mysqli,$user) {
    $resultaat = $mysqli->query("SELECT * FROM tblgebruikers WHERE gebruikerid = '".$user."'");
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['voornaam']; 
}

function getMessage($connection,$chatid) {
    $resultaat = $connection->query("SELECT * FROM tblmessage WHERE chatid='".$chatid."' ORDER BY messageid DESC limit 1"); 
    return ($resultaat->num_rows == 0)?"geen berichten":$resultaat->fetch_assoc()['message']; 
}

function createMessage($connection, $chatid, $zenderid, $ontvangerid, $message) {
    $sql = "INSERT tblmessage (chatid, zenderid, ontvangerid, message) VALUES('".$chatid."','".$zenderid."','".$ontvangerid."','".$message."')";
    return $connection->query($sql);
}

function createChat ($connection, $gesprekid,$ontvangersid,$zenderid, $link) {
    $sql = ("INSERT INTO tblchat (gesprekid, ontvangerid, zenderid, link)
    VALUES ('".$gesprekid."'," . $ontvangersid . ",".$zenderid.", '".$link."')") ;
    return $connection->query($sql);
}

function deletechat($connection, $chatid) {
    $sql = ("DELETE FROM tblchat WHERE gesprekid= '" .$chatid."'"); 
    return $connection-> query($sql); 
}

function doesChatExists($connection,$userid,$otherUserId){
    $resultaat = $connection->query("SELECT * FROM tblchat WHERE ontvangerid='" .$userid."' AND zenderid='".$otherUserId."'");
    if($resultaat->num_rows == 0){
        $resultaat = $connection->query("SELECT * FROM tblchat WHERE zenderid='" .$userid."' AND ontvangerid='".$otherUserId."'");
        if($resultaat->num_rows == 0){
            return false;
        }
    }
    return $resultaat->fetch_assoc()['link'];
}
?>