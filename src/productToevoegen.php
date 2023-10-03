<!DOCTYPE html>
<html lang="en" class="bg-[#1D3557]">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Producten toevoegen</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
  <?php
  include "connect.php";
  include "functions/sellerFunctions.php";
  include "functions/userFunctions.php";
  include "components/navbar.php";
  session_start();

  if (!isset($_SESSION['login'])) {
    header('location: index.php');
    return;
  };

  if (isset($_POST['submit'])) {
    $naam = $_POST['naam'];
    $prijs = $_POST['prijs'];
    $beschrijving = $_POST['beschrijving'];
    $categorie = $_POST['categorie'];
    $entime = date('Y-m-d H:i:s', strtotime('+12 hours'));
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/2dekans-veilingen-A/public/img/";
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    if (filesize($file_name) < 0) {
      echo "Error";
    }
    if ((empty($_POST['file']))) {
      if (!(move_uploaded_file($file_tmp, $upload_dir . $file_name))) {
        echo "Error, kon de foto niet verplaatsen.";
      };
    }


    if (addProduct($mysqli, $naam, $beschrijving, $prijs, $categorie, $file_name)) {
      header('location: index.php');
    }
  }

  ?>
  <form action="productToevoegen.php" method="post" enctype="multipart/form-data">
    <div class="form-control w-full max-w-md mx-auto p-3">

      <label class="label">
        <span class="label-text text-[#F1FAEE]">Productfoto</span>
      </label>
      <input type="file" name="file" class="file-input file-input-ghost w-full max-w-md bg-white" required />
      </label>
      <label class="label">
        <span class="label-text text-[#F1FAEE]">Product</span>
      </label>
      <input type="text" name="naam" placeholder="Product" class="input input-bordered w-full max-w-md" required />
      </label>
      <label class="label">
        <span class="label-text text-[#F1FAEE]">Minimale prijs</span>
      </label>
      <input type="text" name="prijs" placeholder="Minimale prijs" class="input input-bordered w-full max-w-md" required />
      </label>
      <div class="form-control">
        <label class="label">
          <span class="label-text text-[#F1FAEE]">Beschrijving</span>
        </label>
        <textarea class="textarea textarea-bordered h-24" name="beschrijving" placeholder="Beschrijving" required></textarea>
      </div>
      <div class="form-control w-full max-w-md " required>
        <label class="label">
          <span class="label-text text-[#F1FAEE]">Categorie</span>
        </label>
        <?php
        if (getAllCategories($mysqli)) {
          echo "
  <select class='select select-bordered' name='categorie' required >
   <option disabled selected>Kies een categorie</option>";

          foreach (getAllCategories($mysqli) as $row) {

            echo " <option value= " . $row["categorienaam"] . " >" . $row["categorienaam"] . " </option>
  ";
          }
        }
        ?>
        </select>
      </div>
      <div class="form-control w-full max-w-md">
        <label class="label">

        </label>
        <button type="submit" name="submit" class="btn bg-white">PRODUCT TOEVOEGEN</button>

      </div>


    </div>
  </form>

</body>

</html>