<?php
    include "connect.php";
    include "functions/userFunctions.php";
    include "functions/buyerFunctions.php";
?>
<!DOCTYPE html>
<html lang="en" class="bg-[#1D3557]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <div class="form-control w-full max-w-md mx-auto p-3">
        <form method="post" action="registreren.php" enctype="multipart/form-data">
        <label class="label">
            <span class="label-text text-white">Voornaam</span>
        </label>
        <input type="text" id="voornaam" name="voornaam" placeholder="Voornaam" class="input input-bordered w-full max-w-md" required/>
        <label class="label">
            <span class="label-text text-white">Achternaam</span>
        </label>
        <input type="text"  id="achternaam" name="achternaam" placeholder="Achternaam" class="input input-bordered w-full max-w-md" required/>
        <label class="label">
            <span class="label-text text-white">E-mailadres</span>
        </label>
        <input type="email" id="email" name="email" placeholder="E-mailadres" class="input input-bordered w-full max-w-md" required/>
        <label class="label">
            <span class="label-text text-white">Wachtwoord</span>
        </label>
        <input type="password" id="wachtwoord" name="wachtwoord" placeholder="Wachtwoord" class="input input-bordered w-full max-w-md" required/>
        <label class="label">
        <span class="label-text text-white">Beschrijving</span>
        </label>
        <textarea class="textarea textarea-bordered h-24 w-full max-w-md" id="beschrijving" name="beschrijving" placeholder="Beschrijving"></textarea>
        <label class="label">
            <span class="label-text text-white">Profielfoto</span>
        </label>
        <input type="file" name="file" class="file-input file-input-ghost w-full max-w-md bg-white" />
        <br>
        <input type="submit" id="submitknop" name="submitknop" value="Registreer" class="btn bg-white mt-3 w-full max-w-md" />
        </form>
    </div>
    <?php
        if(isset($_POST['submitknop'])) {
            if(!(isEmailCorrect($mysqli, $_POST['email']))) {
                $voornaam = $_POST['voornaam'];
                $achternaam = $_POST['achternaam'];
                $email = $_POST['email'];
                $wachtwoord = $_POST['wachtwoord'];
                $beschrijving = $_POST['beschrijving'];
                $upload_dir = $_SERVER["DOCUMENT_ROOT"]."/2dekans-veilingen-A/public/img/";
                $file_name = $_FILES['file']['name'];
                $file_tmp = $_FILES['file']['tmp_name'];

                registerUser($mysqli, $voornaam, $achternaam, $email, $wachtwoord, $file_name, $beschrijving);
                if((empty($_POST['file']))) {
                    move_uploaded_file($file_tmp, $upload_dir.$file_name);
                }

                /* Kan nog aangepast worden*/
                header("Location: login.php");
            }
        }
    ?>
</body>
</html>