<?php

require('../memcached/memcached-api.php');

function cache_start($port) {
    $cacheObject = new Memcached();

    if (!$cacheObject) {
        print("Problems starting the caching system!");
    } else {
        $cacheObject->addServer('localhost', $port);
    };

    return $cacheObject;
};

function cache_createKey($cacheObject, $keyName, $keyValue) {
    return cache_getCacheObject($cacheObject)->set($keyName, $keyValue, 0, 0);
};

function cache_getCacheObject($cacheObject) {
    return $cacheObject;
};

function cache_getInfoFromDatabase($cacheObject, $cacheID, $userID) {

};

function cache_getUserEmailInDatabase($cacheObject, $cacheID, $userID) {

};

function cache_getUserPasswordInDatabase($cacheObject, $cacheID, $userID) {

};

function cache_updateInDatabase($connect) {

};

function cache_update($cacheObject) {

};

function cache_deleteInfoInDatabase($connect, $cacheObject, $cacheID) {

};

function cache_deleteInfo($cacheObject, $keyName) {

};

function cache_stop($cacheObject) {
    $cacheObject->quit();
};

?>