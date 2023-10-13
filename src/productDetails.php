<?php
include "./components/navbar.php";
include "./functions/sellerFunctions.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>title</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php
if (isset($_GET['gekozenProduct'])) {
    foreach(getProductInfo($mysqli, $_GET['gekozenProduct']) as $row) {
      echo '
      <div class="divider"></div>
      <div class="bg-[#F1FAEE] card card-side bg-base-100 shadow-xl">
        <figure class="flex w-3/5">
          <img id="productFoto" class="float-right items-center w-3/5" src="../public/img/'.$row['foto'].'" alt="'.$row['foto'].'"/>
        </figure>
        <div class="divider divider-horizontal"></div>
        <div class="card-body">
          <div class="card bg-base-50 bg-[#FFFFFF]">
            <div class="card-body">
              <p id="productNaam"> - Product naam: '.$row['naam'].'</p>
              <p id="productPrijs"> - Product prijs: €'.$row['prijs'].'</p>
              <p id="productBeschrijving"> - Product beschrijving: '.$row['beschrijving'].'</p>
              <p id="productVerkoper"> - Verkoper van het product: '.getSellerName($mysqli, $row['verkoperid']).' '.getSellerLastName($mysqli, $row['verkoperid']).'</p>
            </div>
          </div>
        </div>
      </div>
      ';
    };
};
    
?>

</body>
</html>