<?php
include "connect.php";
include "functions/adminFunctions.php";
echo "<h1>Record verwijderen</h1>";
    if (deleteUser($mysqli, $gebruikerid) && (deleteproducts($mysqli, $verkoperid))) {
        echo "Record succesvol verwijderd.";

        header("location: index.php");
    } else {
        echo "Record niet kunnen verwijderen: " . $mysqli->error;
    }
    $mysqli->close();
    ?>