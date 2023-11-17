<?php
include "connect.php";
echo "<h1>Record verwijderen</h1>";
    $sql = "DELETE FROM tblproducten WHERE productid =" . $_GET['verwijder'];
    print $sql;
    if ( ->query($sql)) {
        echo "Record succesvol verwijderd.";
        header("location: index.php");
    } else {
        echo "Record niet kunnen verwijderen: " .  ->error;
    }
     ->close();
    ?>