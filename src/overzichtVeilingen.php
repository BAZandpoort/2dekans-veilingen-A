<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
    <title>title</title>
</head>
<body class="min-h-screen bg-[#F1FAEE]">
<script defer>
        function countDown(productcId, tijd) {
          const wrapper = document.getElementById('product-' + productcId);
          var countDownDate = tijd * 1000;  
          var now = <?php print time() ?> * 1000;
           var x = setInterval(function() {
          now = now + 1000;
   
          var distance = countDownDate - now;
   
       var days = Math.floor(distance / (1000 * 60 * 60 * 24));
       var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
       var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
       var seconds = Math.floor((distance % (1000 * 60)) / 1000);
   
       wrapper.querySelector("#hours").style = "--value:" + hours + ";"
       wrapper.querySelector("#minutes").style = "--value:" + minutes + ";"
       wrapper.querySelector("#seconds").style = "--value:" + seconds + ";"    
           }, 1000);
        }
    </script>
    <?php
    include "components/navbar.php";
    include "functions/adminFunctions.php";
    include "connect.php"; 
    
    echo '<div class="flex flex-wrap gap-4">';
    if(getDataTblproducten($mysqli)){
    foreach (getDataTblproducten($mysqli) as $data) {     
        
      echo'<div class="card w-96  shadow-xl bg-white">';
      if (empty($data["foto"])) {
       echo' <figure><img src="../public/img/brokenImageIcon.png" width="240" hight="320" /></figure>';  
      } else {
      echo'
      <figure><img src="../public/img/'.$data["foto"].'" width="240" hight="320" /></figure>';
      }
      echo'
      <div class="card-body">
        <h2 class="card-title text-black">
          '.$data["naam"].'
        </h2>
       <p class="text-black">'.$data["beschrijving"].'</p>
        <div class="card-actions justify-end">';
        if (empty($data["categorie"])) {
         echo ' <div class="badge badge-outline text-black">none</div> ';
        } else {
         echo '<div class="badge badge-outline text-black">'.$data["categorie"].'</div>';
        }
         echo ' <div class="badge badge-outline text-black"> € '.$data["prijs"].'</div> ';
         $dateNow = date("Y-m-d H:i:s");
         $start = strtotime($dateNow);
         $end = strtotime($data['eindtijd']);
   
         $hours = intval(($end - $start)/3600);
         if (($hours) < 0) {
            echo "tijd is afgelopen"; 
         } else {
         echo '
         <span id="product-' . $data['productid'] .'" class="countdown font-mono text-2xl text-black">
            <span id="hours" style="--value:00;"></span>:
            <span id="minutes" style="--value:00;"></span>:
            <span id="seconds" style="--value:00;"></span>
          </span>';
         }
          echo '<img src="../public/img/addfavorite.png" class="h-10 w-10" class="btn">
          <button class="btn btn-outline text-black bg-white border-white hover:text-white hover:bg-black ">Bid</button>
        </div>
      </div>
    </div>';
    $tijd = $data["eindtijd"];

    echo '<script> countDown(' . $data['productid'] . ', '. strtotime($tijd) . '); </script>';
    }
  }
  echo '</div>';
      ?>
      

      
</body>
</html>