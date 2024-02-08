<?php
include "../connect.php";
include "../functions/maintenanceFunctions.php";

if (isset($_GET["enable"])) {
    setMaintenance($mysqli);
    header('location: ../index.php');
}

if (isset($_GET["disable"])) {
    unsetMaintenance($mysqli);
    header('location: ../index.php');

}

?>