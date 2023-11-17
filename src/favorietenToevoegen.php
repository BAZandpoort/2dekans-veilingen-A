<?php
    session_start();
    include "connect.php";
    include "functions/buyerFunctions.php";
    include "functions/userFunctions.php";

    if(isset($_SESSION['login']) && isset($_GET['product'])) {
        $sql = "SELECT * FROM tblfavorieten WHERE productid = ".$_GET['product']." AND gebruikerid = ".$_SESSION['login']."";
        $result =  ->query($sql);

        if(mysqli_num_rows($result) == 0) {
            addProductToFavorites(  $_GET['product'], $_SESSION['login']); 

            header("Location: favorieten.php");
        } else {
            header("Location: productDetails.php?gekozenProduct=".$_GET['product']."");
        }
    } else {
        header("Location: index.php");
    }
?>