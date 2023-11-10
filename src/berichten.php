<?php
include "components/navbar.php"; 
include "functions/chatFunctions.php";  

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>title</title>
</head>
<body class="min-h-screen bg-[#F1FAEE]">
    <?php
        $user = $_SESSION["login"];
        $data = getnotification($mysqli, $user);
        foreach ($data as $value) {
            echo'<a href="'.$value["link"].'">'.$value["notificatie"].'</a>'; 
        }
    ?>
</body>
</html>