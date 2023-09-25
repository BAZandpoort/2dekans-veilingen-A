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
    // gebruik mijn updateUser functie :) -groetjes Nils
    updateUser($mysqli, $gebruikerid, $voornaam, $naam, $email, $wachtwoord, $profielfoto, $beschrijving, $status);
    header('location: index.php');
} else {
    $sql = "select * from tblgebruikers where gebruikerid = 1";
    $resultaat = $mysqli->query($sql);
    $row = $resultaat->fetch_assoc();
    echo '<table>
    <form method="post" action="boek_aanpassen.php"
    <tr><td><input type="hidden" name="gebruikerid" value="' . $row["gebruikerid"] . '"></td></tr>
    <label class="label">
    <span class="label-text">E-mail</span>
    </label>
    <tr><td>Naam</td><td><input type="text" name="email" value="' . $row["email"] . '"></td></tr>
    <span class="label-text text-white">Voornaam</span>
    <tr><td>Prijs</td><td><input type="text" name="voornaam" value="' . $row["voornaam"] . '"></td></tr>
    <span class="label-text text-white">Naam</span>
    <tr><td>url</td><td><input type="text" name="naam" value="' . $row["naam"] . '"></td></tr>
    <span class="label-text text-white">Wachtwoord</span>
    <tr><td>Naam</td><td><input type="text" name="wachtwoord" value=" '. $row["wachtwoord"] .' "></td></tr>
    <span class="label-text text-white">Status</span>
    <tr><td>Prijs</td><td><input type="text" name="status" value=" '. $row["status"] .' "></td></tr>
    <span class="label-text text-white">Profielfoto</span>
    <tr><td>profielfoto</td><td><input type="text" name="profielfoto" value=" '. $row["profielfoto"] .' "></td></tr>
    <img src="' . $row["profielfoto"] . ' " width="300" height="300" alt="">
    <span class="label-text text-white">Beschrijving</span>
    <tr><td>url</td><td><input type="text" name="bechrijving" value="' . $row["beschrijving"] .' " class="input input-bordered input-lg w-full max-w-xs"></td></tr>
    <tr><td colspan=2> <input type="submit" value="wijzigen" name="wijzigen"  class="">></td></tr>    
    </form>
</table>
';
}
?>

</body>
</html>