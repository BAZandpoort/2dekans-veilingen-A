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
      <div class="flex items-center justify-center w-4/5 h-screen">
        <figure>
            <img id="productFoto" class="float-right items-center w-2/3" src="../public/img/'.$row['foto'].'" alt="'.$row['foto'].'"/>
        </figure>
        <div class="card-body float-right items-center justify-center">
            <p id="productNaam"> - Product naam: '.$row['naam'].'</p>
            <p id="productPrijs"> - Product prijs: €'.$row['prijs'].'</p>
            <p id="productBeschrijving"> - Product beschrijving: '.$row['beschrijving'].'</p>
            <p id="productVerkoper"> - Verkoper van het product: '.getSellerName($mysqli, $row['verkoperid']).' '.getSellerLastName($mysqli, $row['verkoperid']).'</p>
        </div>
      </div>
      ';
    };
};
    
?>

</body>
</html>