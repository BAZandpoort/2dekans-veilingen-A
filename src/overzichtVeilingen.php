<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
    <title>title</title>
</head>
<script defer>
  var countDownDate = <?php echo strtotime($endtime) ?> * 1000;
  var now = <?php print time() ?> * 1000;

  var x = setInterval(() => {

    now = now + 1000;

    var distance = countDownDate - now;

    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("hours").style = "--value:" + hours + ";"
    document.getElementById("minutes").style = "--value:" + minutes + ";"
    document.getElementById("seconds").style = "--value:" + seconds + ";"

  }, 1000);
</script>
<body>
    <?php
    include "components/navbar.php";
    include "functions/adminFunctions.php";
    include "connect.php"; 
    

    $resultaat = getDataTblproducten($mysqli);
    
    while ($data = $resultaat -> fetch_assoc()) {     
        
      echo'<div class="card w-96 bg-base-100 shadow-xl">';
      if (empty($data["foto"])) {
       echo' <figure><img src="../public/img/brokenImageIcon.png" width="240" hight="320" /></figure>';  
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
          <span class="countdown font-mono text-2xl">
          <span id="hours" style="--value:00;"></span>:
          <span id="minutes" style="--value:00;"></span>:
          <span id="seconds" style="--value:00;"></span>
          </span>
          <button class="btn btn-primary">Bid</button>
        </div>
      </div>
    </div>';
    $tijd = getTimeDifference($data["eindtijd"]);
      }

      ?>
      <script defer>
          var countDownDate = <?php echo strtotime($tijd) ?> * 1000;
          var now = <?php print time() ?> * 1000;
    

          var x = setInterval(function() {
       
        now = now + 1000;
    
        var distance = countDownDate - now;
    
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
        document.getElementById("hours").style = "--value:" + hours + ";"
        document.getElementById("minutes").style = "--value:" + minutes + ";"
        document.getElementById("seconds").style = "--value:" + seconds + ";"
    
      }, 1000);
    </script>


</body>
</html>