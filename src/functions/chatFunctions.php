<?php
function getChatData($mysqli){
    $resultaat = $mysqli->query("SELECT * FROM tblchat"); 
    return ($resultaat->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC); 
}

function InsertIntoChatTbl($mysqli){

    
}

function deleteChatTbl ($mysqli) {

}

function getZender ($mysqli, $gebruikersid) {
 $resultaat = $mysqli -> query ("SELECT * FROM tblgebruikers WHERE gebruikerid =".$gebruikersid); 
 return ($resultaat ->num_rows == 0)?false:$resultaat->fetch_all(MYSQLI_ASSOC); 
}
?>