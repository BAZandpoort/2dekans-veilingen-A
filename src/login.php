<?php
session_start();
include "connect.php";
include "./functions/userFunctions.php";
if (isset($_POST["knop"])) {
 $email = $_POST["email"];
 $password = $_POST["password"];
 if(isEmailCorrect($mysqli,$email)){
     if(isPasswordCorrect($mysqli,$password,$email)){  
        $gebruikersid = getGebruikersid($mysqli,$email);
             $_SESSION["login"]= $gebruikersid;
             if (checkIfAdmin($mysqli,$email)){
                 $_SESSION['admin']="true";
                
             }
             header("Location:index.php");
         } else {
            
            
         }
     }
     
}

?>
    <!DOCTYPE html>
    <html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#F1FAEE] min-h-screen">
<form method="post" action="login.php">


    <div class="flex min-h-screen items-center text-black">.
        <div class="flex flex-col gap-2 p-20 max-w-20 mx-auto bg-white rounded-xl shadow-lg flex items-center justify-center">
        <h3 class="">Hier inloggen</h3>
    <input type="email" name="email" placeholder="email" class="input input-bordered  input-md w-full max-w-xs" />
    <input type="password" name="password" placeholder="password" class="input input-bordered input-md w-full max-w-xs" />

    <input class="btn bg-[#1D3557] text-white" type="submit" id="knop" name="knop" value="Login">
    </div>
    </div>
</form>
</body>
</html>