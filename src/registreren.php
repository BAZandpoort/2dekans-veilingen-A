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
        <label class="label">
            <span class="label-text text-white">Voornaam</span>
        </label>
        <input type="text" placeholder="Voornaam" class="input input-bordered w-full max-w-md" />
        <label class="label">
            <span class="label-text text-white">Achternaam</span>
        </label>
        <input type="text" placeholder="Achternaam" class="input input-bordered w-full max-w-md" />
        <label class="label">
            <span class="label-text text-white">E-mailadres</span>
        </label>
        <input type="email" placeholder="E-mailadres" class="input input-bordered w-full max-w-md" />
        <label class="label">
            <span class="label-text text-white">Wachtwoord</span>
        </label>
        <input type="password" placeholder="Wachtwoord" class="input input-bordered w-full max-w-md" />
        <label class="label">
        <span class="label-text text-white">Beschrijving</span>
        </label>
        <textarea class="textarea textarea-bordered h-24" placeholder="Beschrijving"></textarea>
        <br>
        <input type="file" class="file-input file-input-ghost w-full max-w-md bg-white" />
        <br>
        <input type="submit" id="submitknop" name="submitknop" value="Registreer" class="btn bg-white" />
    </div>
</body>
</html>