<?php
session_start();
include "connect.php";
include "./functions/userFunctions.php";
if (isset($_SESSION["login"])) {
    header("location:index.php");
}


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
     header('location: login.php?error');
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

<?php
if(isset($_GET["error"])){
    print'<div class="alert alert-error">
    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
    <span>Error! failed login.</span>
  </div>';
}
?>
    <div class="flex min-h-screen items-center text-black">.
        <div class="flex flex-col gap-2 p-20 max-w-20 mx-auto bg-white rounded-xl shadow-lg flex items-center justify-center ">




        <h3 class="">Hier inloggen</h3>
    <input type="email" name="email" placeholder="email" class="input input-bordered  input-md w-full max-w-xs" />
    <input type="password" name="password" placeholder="password" class="input input-bordered input-md w-full max-w-xs" />

    <input class="btn bg-[#1D3557] text-white" type="submit" id="knop" name="knop" value="Login" $GET>
    </div>
    </div>
</form>
</form>
</body>
</html>