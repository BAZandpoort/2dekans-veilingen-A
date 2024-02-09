<?php
include "connect.php";
include "functions/maintenanceFunctions.php";

if(getMaintenance($mysqli) == 0) {
    header('location: index.php');
} else {
    showMaintenance($mysqli);
}


?>
<body class="h-screen" data-theme='<?php echo $_SESSION["theme"] ?>'>