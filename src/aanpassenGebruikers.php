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


if (isset($_POST["wijzigen"])) {
    $gebruikerid = $_POST["gebruikerID"];
    $email = $_POST["email"];
    $voornaam = $_POST["voornaam"];
    $naam = $_POST["naam"];
    $wachtwoord = $_POST["wachtwoord"];
    $status = $_POST["status"];
    $profielfoto = $_POST["profielfoto"];
    $bechrijving = $_POST["beschrijving"];
    updateUser($mysqli, $gebruikerid, $voornaam, $naam, $email, $wachtwoord, $profielfoto, $beschrijving, $status);
    $wachtwoord = convertPasswordToHash($wachtwoord);
    header('location: index.php');
}

    $sql = "select * from tblgebruikers where gebruikerid = 1";
    $resultaat = $mysqli->query($sql);
    $row = $resultaat->fetch_assoc();
    echo '
    <div class="form-control flex flex-col min-h-screen justify-center items-center">
    <table>
    <form method="post" action="boek_aanpassen.php">
    <div class= "flex flex-col gap-2">
        <tr><td><input type="hidden" name="gebruikerid" value="' . $row["gebruikerid"] . '"></td></tr>
        <label class="label">
        <span class="label-text text-white">E-mail</span>
        </label>
        <tr><td><input type="text" name="email" value="' . $row["email"] . '" class="input input-bordered w-full max-w-md"></td></tr><br>

        <label class="label">
        <span class="label-text text-white">Voornaam</span>
        </label>
        <tr><td><input type="text" name="voornaam" value="' . $row["voornaam"] . '" class="input input-bordered w-full max-w-md"></td></tr>

        <label class="label">
        <span class="label-text text-white">Naam</span>
        </label>
        <tr><td><input type="text" name="naam" value="' . $row["naam"] . '" class="input input-bordered w-full max-w-md"></td></tr>
        <span class="label-text text-white">Wachtwoord</span>
        <tr><td><input type="text" name="wachtwoord" value=" '. $row["wachtwoord"] .' " class="input input-bordered w-full max-w-md"></td></tr>
        <span class="label-text text-white">Status</span>
        <tr><td><input type="text" name="status" value=" '. $row["status"] .' " class="input input-bordered w-full max-w-md"></td></tr>
        <span class="label-text text-white">Profielfoto</span>
        <tr><td><input type="file" name="profielfoto" class="file-input file-input-ghost w-full max-w-md bg-white"></td></tr>
        
        <img src="' . $row["profielfoto"] . ' " width="300" height="300" alt="" >
        <span class="label-text text-white">Beschrijving</span>
        <tr><td><textarea class="textarea textarea-bordered h-24 w-full max-w-md" id="beschrijving" name="beschrijving" value="'. $row["beschrijving"] . '"></textarea></td></tr>
        <tr><td colspan=2> <input type="submit" value="wijzigen" name="wijzigen"  class="">></td></tr>    
    </div>
    </form>
</table>
</div>
';

?>

</body>
</html>