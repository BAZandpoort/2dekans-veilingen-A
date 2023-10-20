<?php
include "./components/navbar.php";
include "./functions/sellerFunctions.php";
include "components/countdown.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>title</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F1FAEE]">
<?php
if (isset($_GET['user'])) {
    foreach(getSeller($mysqli, $_GET['user']) as $row) {

      echo'
      <div class="divider"></div>
      <div class="bg-[#F1FAEE] card card-side bg-base-100 shadow-xl border-2">
       <div class="avatar">
         <div class="w-50 rounded-full" heigth="300" width="300">
        <figure object-scale-down">
          <img id="gebruikerFoto" class="float-right items-center" src="../public/img/'.$row['profielfoto'].'" alt="'.$row['profielfoto'].' "/>
        </figure>
        </div>
        </div>';
    }

    foreach(getSellerProductInfo($mysqli, $_GET['user']) as $row) {



        echo'
        <div class="flex flex-wrap gap-12">
              
             <div class="card w-96 p-6 shadow-xl bg-white">';
                if (empty($row["foto"])) {
                echo' <figure><img src="../public/img/brokenImageIcon.png" width="240" hight="320" /></figure>';  
                } else {
                echo'
                <figure><img src="../public/img/'.$row["foto"].'" width="240" hight="320" /></figure>';
                }
                echo'
                <div class="card-body"> 
                <a href="productDetails.php?gekozenProduct='.$row['productid'].'" id="productNaam" class="card-title">
                    <h2 class="card-title text-black">
                    '.$row["naam"].'
                    </h2>
                </a>
                <p class="text-black">'.$row["beschrijving"].'</p>
                    <div class="card-actions justify-end">';
                    if (empty($row["categorie"])) {
                    echo ' <div class="badge badge-outline text-black">none</div> ';
                    } else {
                    echo '<div class="badge badge-outline text-black">'.$row["categorie"].'</div>';
                    }
                    echo ' <div class="badge badge-outline text-black"> € '.$row["prijs"].'</div> ';
                    $dateNow = date("Y-m-d H:i:s");
                    $start = strtotime($dateNow);
                    $end = strtotime($row['eindtijd']);
            
                    $hours = intval(($end - $start)/3600);
                    if ($hours <= 0) {
                        echo "tijd is afgelopen"; 
                    } else {
                    echo '
                    <span id="product-' . $row['productid'] .'" class="countdown font-mono text-2xl text-black">
                        <span id="hours" style="--value:00;"></span>:
                        <span id="minutes" style="--value:00;"></span>:
                        <span id="seconds" style="--value:00;"></span>
                    </span>';
                    }
                    echo '<img src="../public/img/addfavorite.png" class="h-10 w-10" class="btn">
                    
                    <a href="bod.php?product=' . $row["productid"] . '"">
                    <button class="btn btn-outline text-black bg-white border-white hover:text-white hover:bg-black ">Bid</button>
                    </a>';
                    if (isset($_SESSION["admin"])) {
                        echo '<a href="productVerwijderenAdmin.php?verwijder=' . $row["productid"] . '" class="btn bg-[#FF7F7F]">Verwijder</a>';
                    } 
                    print'</div>
                </div>
                </div>';
                $tijd = $row["eindtijd"];


                echo '<script> countDown(' . $row['productid'] . ', '. strtotime($tijd) . '); </script>';
      ;
    };
};
    
?>

</body>
</html>