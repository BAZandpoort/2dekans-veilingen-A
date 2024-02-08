
<?php
include "connect.php";
include "components/navbar.php";
if (isset($_POST["submit"])) {
  header("location:index.php");

  



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
  <figure class="px-10 pt-10 w-max h-max ">
    <img src="../public/img/adss.png" alt="ads" class="rounded-xl object-center" >
  </figure>
  <div class="card-body items-center text-center">
    <h2 class="card-title">Want ads?</h2>
    <p>By buying this your products will be on top of the search results. And will never be gone.</p>
    <div class="card-actions">
    <form method="post" action="reclame.php">
    <button name="submit" class="btn text-black object-center bg-white mt-3 w-full border-white hover:text-white hover:bg-black">Buy now</button>
    </form>  
  </div>
  </div>
</div>
</div>