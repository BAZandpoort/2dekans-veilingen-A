<?php

include "./../memcached/memcached-api.php";

/*De variabel globaal initialiseren*/
global $cachesysteem;
/**/


function cache_start() {
    $cacheObject = new Memcached();

    if (!$cacheObject) {
        print("Problems starting the caching system!");
    } else {
        $cacheObject->addServer('localhost', 3306); //default port of mysqli is port 3306
    };

    return $cacheObject;
};

function cache_createKey($cacheObject, $keyName, $keyValue) {
    return cache_getCacheObject($cacheObject)->set($keyName, $keyValue, 0, 0);
};

function cache_getCacheObject($cacheObject) {
    return $cacheObject;
};

function cache_getCacheValue($cacheObject, $keyName) {
    return cache_getCacheObject($cacheObject)->get($keyName);
};

function cache_insertIntoDatabase($connect, $cacheObject, $keyName, $userID) {
    return ($connect->query("INSERT INTO tblcache(gebruikerid, cachenaam, cachewaarde) VALUES ('".$userID."', '".$keyName."', '".cache_getCacheValue($cacheObject, $keyName)."')"));
};

function cache_getInfoFromDatabase($connect, $userID) {
    return ($connect->query("SELECT * FROM tblcache WHERE gebruikerid = '".$userID."'"));
};

function cache_getUserEmailInDatabase($connect, $userID) {
    return cache_getInfoFromDatabase($connect, $userID)->fetch_assoc()['cachenaam']; 
};

function cache_getUserPasswordInDatabase($connect, $userID) {
    return cache_getInfoFromDatabase($connect, $userID)->fetch_assoc()['cachewaarde']; 
};

/*function cache_updateInDatabase($connect, $cacheObject) {

};

function cache_update($cacheObject) {

};*/

function cache_deleteInfoInDatabase($connect, $userID) {
    return ($connect->query("DELETE FROM tblcache WHERE gebruikerid='".$userID."'"));
};

function cache_deleteInfo($cacheObject, $keyName) {
    return cache_getCacheObject($cacheObject)->delete($keyName);
};

function cache_stop($cacheObject) {
    $cacheObject->quit();
};

?>