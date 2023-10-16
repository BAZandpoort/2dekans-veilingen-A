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
<body class="bg-[#F1FAEE]">
<?php
if (isset($_GET['gekozenProduct'])) {
    foreach(getProductInfo($mysqli, $_GET['gekozenProduct']) as $row) {
      echo '
      <div class="divider"></div>
      <div class="bg-[#F1FAEE] card card-side bg-base-100 shadow-xl border-2">
        <figure class="flex w-2/5 object-scale-down">
          <img id="productFoto" class="float-right items-center" src="../public/img/'.$row['foto'].'" alt="'.$row['foto'].'"/>
        </figure>
        <div class="divider divider-horizontal"></div>
        <div class="card-body">
          <div class="card bg-base-50 bg-[#FFFFFF]">
            <div class="card-body">
              <h2 class="text-2xl font-bold" id="productNaam"> '.$row['naam'].'</h2>
              <p class="text-slate-400 hover:text-blue-800"  id="productVerkoper"><a href="gebruikerProfiel.php?user=' . $row["verkoperid"] . '">'.getSellerName($mysqli, $row['verkoperid']).' '.getSellerLastName($mysqli, $row['verkoperid']).'</a></p>
              <div id="productprijs" class="badge badge-outline text-black"> € '.$row["prijs"].'</div>';
              if($row['categorie']){
                print'<div id="productprijs" class="badge badge-outline text-black">'.$row["categorie"].'</div> ';
              }
              print'<p id="productBeschrijving">'.$row['beschrijving'].'</p>
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