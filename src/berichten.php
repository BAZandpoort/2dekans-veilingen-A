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
        if ($data != false) {
            
            foreach ($data as $value) {
                if ($value["status"] == 0) {
                    $titel = "ongelezen notificatie"; 
                } else {
                    $titel = "gelezen notificatie"; 
                }
                if (isset($_POST["knop"])) {
                    $id = $value["id"]; 
                    updateNotification($mysqli, $id); 
                    header("Location: ".$value["link"]);
                }
                    if (isset($_POST["knop2"])) {
                    $id = $value["id"]; 
                    deleteNotification($mysqli, $id);
                    // header("Location: berichten.php");
                 }

        }


       echo '
       <form method="post" action="berichten.php">
       <div class="card w-96 bg-base-100 shadow-xl">
        <div class="card-body">
        <h2 class="card-title">'.$titel.'</h2>
         <p> '.$value["notificatie"].'</p>
         <div class="card-actions justify-end">
          <button class="btn btn-primary" name="knop">check bericht</button>
          <button class="btn btn-primary" name="knop2">melding verwijderen</button>
          </div>
         </div>
        </div>
        </form>';
        }
    
    ?>
</body>
</html>