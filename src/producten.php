<?php
include "connect.php"; 
include "components/navbar.php";
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
<body >
    <div class="flex x-45 float right">
  <?php
    if(isset($_GET["error1"])){
      $_SESSION["productid"] = "empty";
      print'<div class="alert alert-error">
      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
      <span>Error! Failed to succesfully bid, try logging out and in again.</span>
  </div>';
  }
  
  if(isset($_GET["error3"])){
      $_SESSION["productid"] = "empty";
      print'<div class="alert alert-error">
      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
      <span>Error! No product selected.</span>
  </div>';
  }
  
  if(isset($_GET["error4"])){
      print'<div class="alert alert-error">
      <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
      <span>Error! Can not bid on your own product, you little cheater!</span>
  </div>';
  }
  
  if (isset($_GET["succes"])) {
      $_SESSION["productid"] = "empty";
      print  '<div class="alert alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>Your bid has been added, good luck!</span>
              </div>';
  }
  echo '<div class="flex flex-wrap gap-4">';
  if (isset($_GET['gekozenCategorie'])) {
    $categorie = $_GET['gekozenCategorie'];
    foreach(getGekozenCategorie($mysqli, $categorie) as $data) {
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
           
            <a href="bod.php?product=' . $data["productid"] . '"">
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
  ?>
</div>
</body>
</html>