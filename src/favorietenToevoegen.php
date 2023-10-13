<?php
    session_start();
    include "connect.php";
    include "functions/buyerFunctions.php";

    if(isset($_SESSION['login']) && isset($_GET['product'])) {
       addProductToFavorites($mysqli, $_GET['product'], $_SESSION['login']); 

       header("Location: favorieten.php");
    } else {
        header("Location: index.php");
    }
?>