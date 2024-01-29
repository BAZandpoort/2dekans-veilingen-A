<?php
    include "connect.php";
    include "functions/buyerFunctions.php";
    session_start();

    deleteProductFromFavorites(  $_GET['product'], $_SESSION['login']);

    header("Location: favorieten.php");
?>