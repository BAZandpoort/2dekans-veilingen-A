<?php

function cache_createKey($connection, $gebuikerid, $keyName, $keyValue) {
    return ($connection->query("INSERT INTO tblcache(gebruikerid, cachenaam, cachewaarde) VALUES('".$gebuikerid."', '".$keyName."', '".$keyValue."')"));
};

function cache_getCacheValue($connection, $keyName) {
    return ($connection->query("SELECT cachewaarde FROM tblcache WHERE cachenaam='".$keyName."'"));
};

function cache_getInfoFromDatabase($connection, $userID) {
    return ($connection->query("SELECT * FROM tblcache WHERE gebruikerid = '".$userID."'"));
};

function cache_getUserEmailInDatabase($connection, $userID) {
    return cache_getInfoFromDatabase($connection, $userID)->fetch_assoc()['cachenaam']; 
};

function cache_getUserPasswordInDatabase($connection, $userID) {
    return cache_getInfoFromDatabase($connection, $userID)->fetch_assoc()['cachewaarde']; 
};

function cache_getUserInDatabase($connection, $userID) {
    return cache_getInfoFromDatabase($connection, $userID)->fetch_assoc()['gebruikerid']; 
}

function cache_updateUserInDatabase($connection, $keyName, $userID) {
    return ($connection->query("UPDATE tblcache SET gebruikerid='".$userID."' WHERE cachenaam='".$keyName."'"));
};

function cache_updateInfoInDatabase($connection, $keyName, $keyValue, $userID) {
    return ($connection->query("UPDATE tblcache SET cachenaam='".$keyName."', cachewaarde='".$keyValue."' WHERE gebruikerid='".$userID."'"));
};

function cache_deleteInfoInDatabase($connection, $userID) {
    return ($connection->query("DELETE FROM tblcache WHERE gebruikerid='".$userID."'"));
};
?>