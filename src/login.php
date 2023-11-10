<?php

session_start();

include "connect.php";
include "./functions/userFunctions.php";
if (isset($_SESSION["login"])) {
    header("location:index.php");
}


if (isset($_POST["submit"])) {
 $email = $_POST["email"];
 $password = $_POST["password"];
 if(isEmailCorrect($mysqli,$email)){
     if(isPasswordCorrect($mysqli,$password,$email)){  
        $gebruikersid = getGebruikersid($mysqli,$email);
             $_SESSION["login"]= $gebruikersid;
             if(checkIfAdmin($mysqli,$email)){
                $_SESSION["admin"] = "true";
             }
             header("Location:index.php");
         } else {

        
         }
     }
     header('location: login.php?error');
}



?>
<?php
require 'lang.php';
?>
    <!DOCTYPE html>
    <html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen" data-theme='<?php echo $_SESSION["theme"] ?>'>
<div class="flex justify-start items-start">
        <a href="index.php" class="btn btn-ghost normal-case text-xl text-black"><?= Vertalen('2nd chance auctions')?></a>
        <div class="card w-full max-w-lg h-screen shadow-2xl bg-white ml-auto">
        <form class="card-body" method="post" action="login.php">
        <?php
            if(isset($_GET["error"])){
                print'<div class="alert alert-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>Error! failed login.</span>
            </div>';
            }
        ?>    
        <div class="form-control gap-2">
            <h2 class="text-black text-2xl "><?= Vertalen('login')?></h2>
            <label class="label">
                <span class="label-text text-black"><?= Vertalen('Email')?></span>
            </label>
            <input type="email"  name="email" placeholder=<?= Vertalen('Email')?> class="input input-bordered w-full max-w-md bg-white text-black" required/>
            <label class="label">
                <span class="label-text text-black"><?= Vertalen("Password")?></span>
            </label>
            <input type="password"  name="password" placeholder=<?= Vertalen('password')?> class="input input-bordered w-full max-w-md bg-white text-black" required/>
            <input type="submit" name="submit" value=<?= Vertalen('login')?> class="btn text-black bg-white mt-3 w-full border-white hover:text-white hover:bg-black"/>
        </form>
        <div class="flex justify-center mt-2">
            <a href="registreren.php" class="link text-black"><?= Vertalen("I don't have an account")?></a>
        </div>
    </div>
</div>
</body>
</html>