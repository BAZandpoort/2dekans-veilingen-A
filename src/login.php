<?php
session_start();
include "connect.php";
include "./functions/userFunctions.php";
include "components/navbar.php";
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
<?php
if(isset($_GET["error"])){
    print'<div class="alert alert-error">
    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
    <span>Error! failed login.</span>
  </div>';
}
?>
<body class="min-h-screen bg-[#F1FAEE]">
    <div class="card w-full max-w-lg h-screen shadow-2xl bg-white ml-auto ">
      <form class="card-body"  method="post" action="login.php">
        <div class="form-control gap-2">
        <h2 class="text-black text-2xl ">Login</h2>
        <label class="label">
            <span class="label-text text-black">Email</span>
        </label>
        <input type="email"  name="email" placeholder="Email" class="input input-bordered w-full max-w-md bg-white text-black" required/>
        <label class="label">
            <span class="label-text text-black">Password</span>
        </label>
        <input type="password"  name="password" placeholder="Password" class="input input-bordered w-full max-w-md bg-white text-black" required/>
        <input type="submit" name="submit" value="Login" class="btn text-black bg-white mt-3 w-full border-white hover:text-white hover:bg-black"/>
    </form>
    <div class="flex justify-center mt-2">
        <a href="registreren.php" class="link text-black">I don't have an account</a>
    </div>
</div>
</body>
</html>