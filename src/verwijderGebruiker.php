<?php
include "connect.php";
include "functions/adminFunctions.php";
echo "<h1>Record verwijderen</h1>";
    if (deleteUser(  $_GET["verwijder"]) && (deleteProducts(  $_GET["verwijder"]))) {
       header("location: index.php");
    } else {
        echo "Record niet kunnen verwijderen: " .  ->error;
    }
     ->close();
    ?>