<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require veranderTheme();
function veranderTheme (){

    $_SESSION['darkmode'] = $_SESSION['darkmode'] ?? "light";
    $_SESSION['darkmode'] = $_GET['darkmode'] ?? $_SESSION['darkmode'];

    return $_SESSION['darkmode'].".php";
}

?>