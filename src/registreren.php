<?php
    include "connect.php";
    include "functions/userFunctions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body class="min-h-screen bg-[#F1FAEE]">
    <div class="card w-full max-w-xl shadow-2xl bg-white ml-auto">
      <form class="card-body">
        <div class="form-control ">
        <h2 class="text-black text-2xl">Registreer</h2>
        <label class="label">
            <span class="label-text text-black">Voornaam</span>
        </label>
        <input type="text" id="voornaam" name="voornaam" placeholder="Voornaam" class="input input-bordered w-full max-w-md bg-white text-black" required/>
        <label class="label">
                <span class="label-text text-black">Achternaam</span>
            </label>
            <input type="text"  id="achternaam" name="achternaam" placeholder="Achternaam" class="input input-bordered w-full max-w-md bg-white text-black" required/>
            <label class="label">
                <span class="label-text text-black">E-mailadres</span>
            </label>
            <input type="email" id="email" name="email" placeholder="E-mailadres" class="input input-bordered w-full max-w-md bg-white text-black" required/>
            <label class="label">
                <span class="label-text text-black">Wachtwoord</span>
            </label>
            <input type="password" id="wachtwoord" name="wachtwoord" placeholder="Wachtwoord" class="input input-bordered w-full max-w-md bg-white text-black" required/>
            <label class="label">
            <span class="label-text text-black">Beschrijving</span>
            </label>
            <textarea class="textarea textarea-bordered h-24 w-full max-w-md bg-white text-black" id="beschrijving" name="beschrijving" placeholder="Beschrijving"></textarea>
            <label class="label">
                <span class="label-text text-black">Profielfoto</span>
            </label>
            <input type="file" name="file" class="file-input file-input-bordered w-full max-w-md bg-white text-black" />
            <input type="submit" id="submitknop" name="submitknop" value="Registreer" class="btn text-black bg-white mt-3 w-full border-white hover:text-white" />
        </form>
        <div class="flex justify-center mt-2">
            <a href="login.php" class="link text-black">I have an account</a>
        </div>
    </div>
<!--<div class="card flex-shrink-0 max-w-lg shadow-2xl bg-white">
      <div class="card-body">
        <div class="form-control">
            <form method="post" action="registreren.php" enctype="multipart/form-data">
            <h1 class="text-black text-xl text[#] mb-4">Registreer</h1>
            <label class="label">
                <span class="label-text text-black">Voornaam</span>
            </label>
            <input type="text" id="voornaam" name="voornaam" placeholder="Voornaam" class="input input-bordered w-full max-w-md bg-white text-black" required/>
            <label class="label">
                <span class="label-text text-black">Achternaam</span>
            </label>
            <input type="text"  id="achternaam" name="achternaam" placeholder="Achternaam" class="input input-bordered w-full max-w-md bg-white text-black" required/>
            <label class="label">
                <span class="label-text text-black">E-mailadres</span>
            </label>
            <input type="email" id="email" name="email" placeholder="E-mailadres" class="input input-bordered w-full max-w-md bg-white text-black" required/>
            <label class="label">
                <span class="label-text text-black">Wachtwoord</span>
            </label>
            <input type="password" id="wachtwoord" name="wachtwoord" placeholder="Wachtwoord" class="input input-bordered w-full max-w-md bg-white text-black" required/>
            <label class="label">
            <span class="label-text text-black">Beschrijving</span>
            </label>
            <textarea class="textarea textarea-bordered h-24 w-full max-w-md bg-white text-black" id="beschrijving" name="beschrijving" placeholder="Beschrijving"></textarea>
            <label class="label">
                <span class="label-text text-black">Profielfoto</span>
            </label>
            <input type="file" name="file" class="file-input file-input-bordered w-full max-w-md bg-white text-black" />
            <input type="submit" id="submitknop" name="submitknop" value="Registreer" class="btn text-black bg-white mt-3 w-full border-white hover:text-white" />
            </form>
            <a href="login.php" class="link text-black flex items-center justify-content w-full max-w-md te">I have an account</a>
        </div>
    </div>
</div>-->
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