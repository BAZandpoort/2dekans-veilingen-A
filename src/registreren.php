<?php
    include "connect.php";
    include "functions/userFunctions.php";
    include "functions/buyerFunctions.php";
    include "functions/developerFunctions.php";
    require 'lang.php';
?>
<!DOCTYPE html>
<html lang="en" class="bg-[#F1FAEE]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?= __('Register')?></title>
</head>
<body>
<div class="flex justify-start items-start">
    <a href="index.php" class="btn btn-ghost normal-case text-xl text-black"><?= __('2nd chance auctions')?></a> 
    <div class="card w-full max-w-xl h-screen shadow-2xl bg-white ml-auto">
    <form class="card-body" method="post" action="registreren.php" enctype="multipart/form-data">
        <div class="form-control">
            <h2 class="text-black text-2xl"><?= __('Register')?></h2>
            <label class="label">
                <span class="label-text text-black"><?= __('First name')?></span>
            </label>
            <input type="text" id="voornaam" name="voornaam" placeholder=<?= __('First name')?> class="input input-bordered w-full max-w-md bg-white text-black" required/>
            <label class="label">
                    <span class="label-text text-black"><?= __('Last name')?></span>
                </label>
                <input type="text"  id="achternaam" name="achternaam" placeholder=<?= __('Last name')?> class="input input-bordered w-full max-w-md bg-white text-black" required/>
                <label class="label">
                    <span class="label-text text-black"><?= __('Email')?></span>
                </label>
                <input type="email" id="email" name="email" placeholder=<?= __('Email')?> class="input input-bordered w-full max-w-md bg-white text-black" required/>
                <label class="label">
                    <span class="label-text text-black"><?= __('Password')?></span>
                </label>
                <input type="password" id="wachtwoord" name="wachtwoord" placeholder=<?= __('Password')?> class="input input-bordered w-full max-w-md bg-white text-black" required/>
                <label class="label">
                <span class="label-text text-black"><?= __('Description')?></span>
                </label>
                <textarea class="textarea textarea-bordered h-24 w-full max-w-md bg-white text-black" id="beschrijving" name="beschrijving" placeholder=<?= __('Description')?>></textarea>
                <label class="label">
                    <span class="label-text text-black"><?= __('Profile Picture')?></span>
                </label>
                <input type="file" name="file" class="file-input file-input-bordered w-full max-w-md bg-white text-black" />
                <input type="submit" id="submitknop" name="submitknop" value=<?= __('Register')?> class="btn text-black bg-white mt-3 w-full border-white hover:text-white hover:bg-black"/>
            </form>
            <div class="flex justify-center mt-2">
                <a href="login.php" class="link text-black"><?= __('I have an account')?></a>
            </div>
        </div>
    </div>
</div>
    <?php
        if(isset($_POST['submitknop'])) {
            $cachesysteem = cache_start();
            if(!(isEmailCorrect($mysqli, $_POST['email']))) {
                $voornaam = $_POST['voornaam'];
                $achternaam = $_POST['achternaam'];
                $email = $_POST['email'];
                $wachtwoord = $_POST['wachtwoord'];
                $beschrijving = $_POST['beschrijving'];
                $upload_dir = $_SERVER["DOCUMENT_ROOT"]."/2dekans-veilingen-A/public/img/";
                $file_name = $_FILES['file']['name'];
                $file_tmp = $_FILES['file']['tmp_name'];

                cache_createKey($cachesysteem, $email, $wachtwoord);

                registerUser($mysqli, $voornaam, $achternaam, $email, $wachtwoord, $file_name, $beschrijving);
                if((empty($_POST['file']))) {
                    move_uploaded_file($file_tmp, $upload_dir.$file_name);
                }

                cache_insertIntoDatabase($mysqli, $cachesysteem, $email, getGebruikersid($mysqli, $email));

                /* Kan nog aangepast worden*/
                header("Location: login.php");
            }
        }
    ?>
</body>
</html>