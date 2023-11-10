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
    
    $output = "";

    //parse_str($_GET['zoekresultatenlijst'], $output);
    $nieuwZoeklijst = explode(" ", $output);

    var_dump($nieuwZoeklijst);

    if ($_GET['zoekresultatenlijst']) {
        $i = 1;
        while($i < getNumSearchResult($output)) {
            echo $output[$i]['productid'] + " " + $output[$i]['verkoperid'] + " " + $output[$i]['foto'] + " " + $output[$i]['naam'] + " " + $output[$i]['beschrijving'] + " " + $output[$i]['categorie'] + " " + $output[$i]['startdatum'] + " " + $output[$i]['eindatum'] + "\n";
            $i++;
        };
    };
    /*if(getDataTblproducten($mysqli)){
    foreach (getDataTblproducten($mysqli) as $data) {     
        
      echo'<div class="card w-96 p-6 shadow-xl bg-white">';
      if (empty($data["foto"])) {
       echo' <figure><img src="../public/img/brokenImageIcon.png" width="240" hight="320" /></figure>';  
      } else {
      echo'
      <figure><img src="../public/img/'.$data["foto"].'" width="240" hight="320" /></figure>';
      }
      echo'
      <div class="card-body"> 
      <a href="productDetails.php?gekozenProduct='.$data['productid'].'" id="productNaam" class="card-title">
        <h2 class="card-title text-black">
          '.$data["naam"].'
        </h2>
      </a>
       <p class="text-black">'.$data["beschrijving"].'</p>
        <div class="card-actions justify-end">';
        if (empty($data["categorie"])) {
         echo ' <div class="badge badge-outline text-black">none</div> ';
        } else {
         echo '<div class="badge badge-outline text-black">'.$data["categorie"].'</div>';
        }
         echo ' <div class="badge badge-outline text-black"> € '.$data["prijs"].'</div> ';
         $hours = getTimeDifference($data['eindtijd']);
         if ($hours <= 0) {
            echo "tijd is afgelopen"; 
         } else {
         echo '
         <span id="product-' . $data['productid'] .'" class="countdown font-mono text-2xl text-black">
            <span id="hours" style="--value:00;"></span>:
            <span id="minutes" style="--value:00;"></span>:
            <span id="seconds" style="--value:00;"></span>
          </span>';
         }
          echo '<a href="../src/favorietenToevoegen.php?product= '.$data['productid'].'">
            <img src="../public/img/addfavorite.png" class="h-10 w-10" class="btn">
          </a>
          <a href="productDetails.php?gekozenProduct=' . $data["productid"] . '"">
          <button class="btn btn-outline text-black bg-white border-white hover:text-white hover:bg-black ">Bid</button>
          </a>';
          if (isset($_SESSION["admin"])) {
            echo '<a href="productVerwijderenAdmin.php?verwijder=' . $data["productid"] . '" class="btn bg-[#FF7F7F]">Verwijder</a>';
           } 
        print'</div>
      </div>
    </div>';
    $tijd = $data["eindtijd"];


    echo '<script> countDown(' . $data['productid'] . ', '. strtotime($tijd) . '); </script>';

    }
  }
*/
?>        
</body>
</html>