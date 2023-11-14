<?php
require_once "./functions/developerFunctions.php";
session_start();
?>
<?php
session_destroy();

print "<h3><br>Je bent uitgelogd.</h3>";
header("Location:index.php");
?>
