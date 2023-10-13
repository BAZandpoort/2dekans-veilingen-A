<?php
include "connect.php";
echo "<h1>Record verwijderen</h1>";
    $sql = "DELETE FROM tblproducten WHERE productid =" . $_GET['verwijder'];
    print $sql;
    if ($mysqli->query($sql)) {
        echo "Record succesvol verwijderd.";
        header("location: overzichtVeilingen.php");
    } else {
        echo "Record niet kunnen verwijderen: " . $mysqli->error;
    }
    $mysqli->close();
    ?>