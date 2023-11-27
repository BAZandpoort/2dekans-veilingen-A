<?php
    include "connect.php";
    include "functions/adminFunctions.php";
    session_start();

    changeReportChecked($mysqli, $_GET['report']);

    header("Location: gebruikerProfiel.php?user=".$_SESSION["reportUser"]."");
    ?>