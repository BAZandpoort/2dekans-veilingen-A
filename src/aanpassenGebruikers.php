<!DOCTYPE html>
<html class="bg-[#1D3557]" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
    <title>Document</title>
</head>
<body>


<?php
include "connect.php";
include "functions/userFunctions.php";
session_start();


if(isset($_SESSION["login"])){
    header('location: index.php');
}

if (isset($_POST["wijzigen"])) {
    $gebruikerid = $_POST["gebruikerid"];
    $email = $_POST["email"];
    $voornaam = $_POST["voornaam"];
    $naam = $_POST["naam"];
    $wachtwoord = $_POST["wachtwoord"];
    $profielfoto = $_POST["profielfoto"];
    $beschrijving = $_POST["beschrijving"];
    if(updateUser($mysqli, $gebruikerid, $voornaam, $naam, $email, $wachtwoord, $profielfoto, $beschrijving)){
        header('location: index.php');
    }else{
        print $mysqli->error;
    }


}
    foreach(getUser($mysqli,1) as $row){
    echo '
    <div class=" flex flex-col min-h-screen justify-center items-center">
    <form method="post" action="aanpassenGebruikers.php">
    <div class= "flex flex-col gap-2">
        <tr><td><input type="hidden" name="gebruikerid" value="' . $row["gebruikerid"] . '"></td></tr>

        <div class="form-control w-full max-w-xs">
        <label class="label">
         <span class="label-text text-white">E-mail</span>
        </label>
        <input type="text" name="email" value="' . $row["email"] . '" class="input input-bordered w-full max-w-md">
        </div>


        <div class="form-control w-full max-w-xs">
        <label class="label">
         <span class="label-text text-white">Voornaam</span>
        </label>
       <input type="text" name="voornaam" value="' . $row["voornaam"] . '" class="input input-bordered w-full max-w-md">
        </div>

        <div class="form-control w-full max-w-xs">
        <label class="label">
         <span class="label-text text-white">Naam</span>
        </label>
       <input type="text" name="naam" value="' . $row["naam"] . '" class="input input-bordered w-full max-w-md">
        </div>

        <div class="form-control w-full max-w-xs">
        <label class="label">
         <span class="label-text text-white">Wachtwoord</span>
        </label>
       <input type="password" name="wachtwoord" class="input input-bordered w-full max-w-md">
       </div>

        <div class="form-control w-full max-w-xs">
        <label class="label">
         <span class="label-text text-white">Profielfoto</span>
        </label>
        <input type="file" name="profielfoto" class="file-input file-input-ghost w-full max-w-md bg-white">
        </div>

        <div class="form-control w-full max-w-xs">
        <label class="label">
         <span class="label-text text-white">Beschrijving</span>
        </label>
        <textarea class="textarea textarea-bordered h-24 w-full max-w-md" name="beschrijving" value="">'.$row["beschrijving"].'</textarea>
        </div>


         <input type="submit" value="wijzigen" name="wijzigen"  class="btn text-white">  

    </div>
    </form>

    <div class="flex-col min-h-screen justify-center items-center ">
    <a href="index.php" class="text-white">Annuleren</a>
    </div>
</div>
';
}
?>

</body>
</html>