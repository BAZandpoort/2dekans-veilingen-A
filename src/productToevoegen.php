<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Producten toevoegen</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
  <?php
  include "connect.php";
  include "functions/sellerFunctions.php";
  include "functions/userFunctions.php";
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
<body class="h-screen bg-[#F1FAEE]">
  <div>
    <div class="flex justify-start items-start">
      <a href="index.php" class="btn btn-ghost normal-case text-xl text-black">2dekans veilingen</a> 
    </div>
    <form class="form-control h-full flex items-center justify-center" action="productToevoegen.php" method="post" enctype="multipart/form-data">
      <div class="card w-full max-w-lg shadow-2xl bg-white p-8 mx-auto justify-center items-center">
        <h2 class="text-black text-2xl mb-4">Add Product</h2>
        <div class="flex flex-col gap-2">  
          <div class="flex flex-row gap-2"> 
            <div class="flex flex-col w-full"> 
              <label class="label text-black">Product</label>
              <input type="text" name="naam" placeholder="Product" class="input input-bordered w-full max-w-md text-black bg-white" required />
            </div>
            <div class="flex flex-col w-full"> 
              <label class="label text-black">Minimale prijs</label>
              <input type="text" name="prijs" placeholder="Minimale prijs" class="input input-bordered w-full max-w-md text-black bg-white" required />
            </div>
          </div>
          <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full"> 
              <label class="label text-black">Beschrijving</label>
              <textarea class="textarea textarea-bordered h-24  text-black bg-white" name="beschrijving" placeholder="Beschrijving" required></textarea>
            </div>
          </div>
          <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full"> 
              <label class="label text-black">Productfoto</label>
              <input type="file" name="file" class="file-input file-input-bordered bg-white text-black" required />
            </div>
          </div>
          <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full"> 
              <label class="label text-black">Categorie</label>
              <?php
                if (getAllCategories($mysqli)) {
                  print "<select class='select select-bordered bg-white text-black' name='categorie' required >
                  <option disabled selected>Kies een categorie</option>";

                  foreach (getAllCategories($mysqli) as $row) {
                    print " <option value= " . $row["categorienaam"] . " >" . $row["categorienaam"] . " </option>";
                  }
                }
              ?>
              </select>
            </div>
          </div>
          <input type="submit" name="submit" class="btn border-none bg-white text-black hover:text-white hover:bg-black" value="PRODUCT TOEVOEGEN">
        </div>
      </div>
    </form>
  </div>
</body>
</html>