<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Producten bekijken</title>
  	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
  	<script src="https://cdn.tailwindcss.com"></script>
</head>
	<body class="h-screen bg-[#F1FAEE]">
	<?php 
	include 'connect.php';
	include "functions/sellerFunctions.php";
	include "functions/userFunctions.php";
	require 'lang.php';
//session_start();

if(!isset($_SESSION['login'])){
  header('location: index.php');
  return;
};

	echo '<h1 align="center">Producten bekijken<h1>';
	//Als er geen gekozenverkoper is dan moet het naar index.
  if (!isset($_GET['gekozenVerkoper'])) {
    header("Location: index.php");
  } else {
    $sellerID = $_GET['gekozenVerkoper'];
    if(!(getSellerProducts($mysqli, $sellerID))){
     header("Location: index.php");  
      //Als sellerID niet bestaat dan moet het naar index.
    }
  }
 
echo "<h1 align='center'>Dit is de profielpagina van ".getSellerName($mysqli, $sellerID)."</h1>";
echo "<br>";
echo '
<div class= "pl-10 flex flex-row ">';
  foreach(getSellerProducts($mysqli, $sellerID) as $row){
  	  	echo '
  	  	<div class="mr-4 mt-11 w-80  overflow-hidden rounded-lg bg-white dark:bg-slate-800 shadow-md duration-300 hover:scale-105 hover:shadow-lg">
  <a href = "productDetails.php?gekozenProduct='.$row['productid'].'"><img id = "productFoto" class="h-48 w-full object-cover object-center" src="../public/img/'.$row['foto'].'" alt="'.$row['foto'].'" /></a> 
  <div class="p-4">
    <h2 class="mb-2 text-lg font-medium dark:text-white text-gray-900">'.$row['naam']. '</h2>
    <p class="mb-2 text-base dark:text-gray-300 text-gray-700">'.$row['beschrijving']. '</p>
    <div class="flex items-center">
      <p class="mr-2 text-lg font-semibold text-gray-900 dark:text-white">€ '.$row['prijs']. '</p>
    </div>
     <p class="mb-2 text-base dark:text-gray-300 text-gray-700">'.$row['categorie'].'</p>
     
  </div>
</div>';
  };

echo '
</div>';
	?>

</body>

</html>