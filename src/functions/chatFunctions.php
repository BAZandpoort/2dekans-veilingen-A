<?php
include "../src/connect.php";
function getChatData($mysqli){
    $resultaat = $mysqli->query("SELECT * FROM tblchat"); 
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC); 
}

function InsertIntoChatTbl($mysqli, $ontvanger, $zenderVoornaam, $zenderAchternaam, $bericht){
$sql = "INSERT INTO tblchat (gesprekID, ontvanger, zenderVoornaam, zenderAchternaam, bericht) VALUES (2 ,'".$ontvanger."','".$zenderVoornaam."','".$zenderAchternaam ."','".$bericht."')";
return $mysqli->query($sql);
 
}

function getZender ($mysqli, $gebruikersid) {
 $resultaat = $mysqli -> query ("SELECT * FROM tblgebruikers WHERE gebruikerid =".$gebruikersid); 
 return ($resultaat ->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC); 
}

function getOntvanger ($mysqli, $user) {
    $resultaat = $mysqli->query("SELECT * FROM tblgebruikers WHERE gebruikerid = ".$user);
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_assoc()['voornaam']; 
}

function deleteChatTbl ($mysqli) {
    
}
?>