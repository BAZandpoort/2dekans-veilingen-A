
<?php
include "connect.php";
include "components/navbar.php";

var_dump($_SESSION['login']);
if (isset($_POST["submit"])){

  $change_reclame = insert(
    'UPDATE tblgebruikers SET reclame= 1 WHERE gebruikerid = ? ',
    ['type' => 'i', 'value' => $_SESSION['login'] ],
    
  );
var_dump($change_reclame);

?>
<div class="h-screen flex items-center justify-center items-center">
<a href="index.php" class="btn normal-case text-xl text-black text-center btn-center h-screen flex items-center justify-center items-center">Click to go back</a>
</div>
<?php
};



?>
<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $_SESSION['theme'] ?>">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>reclame</title>
	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen" data-theme="<?php echo $_SESSION['theme'] ?>">
	  <?php

$_SESSION["theme"] = 'retro';

$theme = ($change_theme['theme'] === 'dark') ? 'dark' : 'retro';
$_SESSION["theme"] = $theme;

?>

<div class="h-screen flex items-center justify-center">
<div class="card w-96 bg-base-100 shadow-xl ">
  <figure class="px-10 pt-10 w-auto h-auto ">
    <img src="../public/img/adss.png" alt="ads" class="rounded-xl object-center" >
  </figure>
  <div class="card-body items-center text-center">
    <h2 class="card-title">Want ads?</h2>
    <p>By buying this your products will be on top of the search results.</p>
    <div class="card-actions">
    <form method="post" action="reclame.php">
    <button name="submit" class="btn text-black object-center bg-white mt-3 w-full border-white hover:text-white hover:bg-black">Buy now</button>
    </form>  
  </div>
  </div>
</div>
</div>