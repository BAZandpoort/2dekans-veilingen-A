<?php
    include "connect.php";
    include "functions/adminFunctions.php";
    session_start();

    changeReportUnchecked($mysqli, $_GET['report']);

    header("Location: gebruikerProfiel.php");
    ?>