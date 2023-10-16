<?php

require('../memcached/memcached-api.php');

function getTimeDifference($endTime) {
    $currentDate = date("Y-m-d H:i:s");
    $endDate = strtotime($endTime);
    $currentDate = strtotime($currentDate);
    $timeDifference = $endDate - $currentDate;
    $timeDifference = date("H:i:s", $timeDifference);
    return $timeDifference;
}

function cache_start($port) {
    $cacheObject = new Memcached();

    if (!$cacheObject) {
        print("Problems starting the caching system!");
    } else {
        $cacheObject->addServer('localhost', $port);
    };

    return $cacheObject;
};

function cache_createKey() {

};

function cache_getCacheObject($cacheObject) {
    return $cacheObject;
};

function cache_get($cacheID) { 

};

function cache_update() {

}

function cache_stop($cacheObject) {
    $cacheObject->quit();
};

?>