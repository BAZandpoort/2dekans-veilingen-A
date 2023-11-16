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
    include "components/navbar.php";
    include "functions/adminFunctions.php";
    include "connect.php"; 
    include "components/countdown.php";
    
    echo '<div class="flex flex-wrap gap-4">';
    
    $output = array();

    $output = unserialize($_GET['zoekresultatenlijst']);
    

    if (isset($_GET['zoekresultatenlijst'])) {
      for($i = 0; $i < getNumSearchResult($output); $i++) {
        echo'<div class="card w-96 p-6 shadow-xl bg-white">';
        if (empty($output[$i][2])) {
         echo' <figure><img src="../public/img/brokenImageIcon.png" width="240" hight="320" /></figure>';  
        } else {
         echo'
          <figure><img src="../public/img/'.$output[$i][2].'" width="240" hight="320" /></figure>';
        }
        echo'
        <div class="card-body"> 
        <a href="productDetails.php?gekozenProduct='.$output[$i][0].'" id="productNaam" class="card-title">
          <h2 class="card-title text-black">
            '.$output[$i][3].'
          </h2>
        </a>
         <p class="text-black">'.$output[$i][5].'</p>
          <div class="card-actions justify-end">';
          if (empty($output[$i][6])) {
           echo ' <div class="badge badge-outline text-black">none</div> ';
          } else {
           echo '<div class="badge badge-outline text-black">'.$output[$i][6].'</div>';
          }
           echo ' <div class="badge badge-outline text-black"> € '.$output[$i][4].'</div> ';
           $hours = getTimeDifference($output[$i][8]);
           if ($hours <= 0) {
              echo "tijd is afgelopen"; 
           } else {
           echo '
           <span id="product-' . $output[$i][0] .'" class="countdown font-mono text-2xl text-black">
              <span id="hours" style="--value:00;"></span>:
              <span id="minutes" style="--value:00;"></span>:
              <span id="seconds" style="--value:00;"></span>
            </span>';
           }
            echo '<a href="../src/favorietenToevoegen.php?product= '.$output[$i][0].'">
              <img src="../public/img/addfavorite.png" class="h-10 w-10" class="btn">
            </a>
            <a href="productDetails.php?gekozenProduct=' . $output[$i][0] . '"">
            <button class="btn btn-outline text-black bg-white border-white hover:text-white hover:bg-black ">Bid</button>
            </a>';
            if (isset($_SESSION['admin'])) {
              echo '<a href="productVerwijderenAdmin.php?verwijder=' . $output[$i][0] . '" class="btn bg-[#FF7F7F]">Verwijder</a>';
            };
          print'</div>
        </div>
      </div>';
      $tijd = $output[$i][8];
      };
    };
?>
</body>
</html>