<?php
include "connect.php";
include "functions/adminFunctions.php";
echo "<h1>Record verwijderen</h1>";
    if (deleteUser($mysqli, $_GET["verwijder"]) && (deleteProducts($mysqli, $_GET["verwijder"]))) {
       header("location: index.php");
    } else {
        echo "Record niet kunnen verwijderen: " . $mysqli->error;
    }
    $mysqli->close();
    ?>