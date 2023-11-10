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
        
       echo ' <div class="card w-96 bg-base-100 shadow-xl">
        <div class="card-body">
        <h2 class="card-title">'.$value["notificatie"].'</h2>
         <p>If a dog chews shoes whose shoes does he choose?</p>
         <div class="card-actions justify-end">
          <button class="btn btn-primary">Buy Now</button>
          </div>
         </div>
        </div>' ;
        }
    ?>
</body>
</html>