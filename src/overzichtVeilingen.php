<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
    <title>title</title>
</head>
<body>
    <?php
    include "connect.php";
    include "functions/adminFunctions.php";
    session_start();

    $sql = "SELECT* FROM tblproducten"; 
    $resultaat = $mysqli ->query($sql); 
    
    while ($data = $resultaat -> fetch_assoc()) {
        $tijd = getTimeDifference($data["eindtijd"]);
        echo'<div class="card w-96 bg-base-100 shadow-xl">';
        if ($data["foto"] == "") {
         echo' <figure><img src="brokenImageIcon.png" width="240" hight="320" /></figure>';  
        } else {
        echo'
        <figure><img src="../public/img/'.$data["foto"].'" width="240" hight="320" /></figure>';
        }
        echo'
        <div class="card-body">
          <h2 class="card-title">
            '.$data["naam"].'
          </h2>
          <p>'.$data["beschrijving"].'</p>
          <div class="card-actions justify-end">
            <div class="badge badge-outline">'.$data["categorie"].'</div> 
            <div class="badge badge-outline"> € '.$data["prijs"].'</div>
            <div class="badge badge-outline">'.$tijd.'</div>
            <button class="btn btn-primary">Bid</button>
          </div>
        </div>
      </div>';
        }
        ?>

</body>
</html>