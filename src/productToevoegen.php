<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Products</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
  <?php
  include "connect.php";
  include "functions/sellerFunctions.php";
  include "functions/userFunctions.php";
  session_start();
  require 'lang.php';

  if (!isset($_SESSION['login'])) {
    header('location: index.php');
    return;
  };

  if (isset($_POST['submit'])) {
    $userid = $_SESSION["login"];
    $naam = $_POST['naam'];
    $prijs = $_POST['prijs'];
    $beschrijving = $_POST['beschrijving'];
    $categorie = $_POST['categorie'];
    $upload_dir = $_SERVER['DOCUMENT_ROOT'] . "/2dekans-veilingen-A/public/img/";
    $file_name = $_FILES['file']['name'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $timer = $_POST['duur-timer'];
    $current_timestamp = date("Y-m-d H:i:s");
    $eindtijd = date('Y-m-d H:i:s',strtotime('+'.$timer.' hour',strtotime($current_timestamp)));

    if (filesize($file_name) < 0) {
      echo "Error";
    }
    if ((empty($_POST['file']))) {
      if (!(move_uploaded_file($file_tmp, $upload_dir . $file_name))) {
        echo "Error, kon de foto niet verplaatsen.";
      };
    }


    if (addProduct($mysqli, $userid, $naam, $beschrijving, $prijs, $categorie, $file_name, $eindtijd)) {
      header('location: index.php');
    }
  }
  ?>
<body class="h-screen bg-[#F1FAEE]">
  <div>
    <div class="flex justify-start items-start">
      <a href="index.php" class="btn btn-ghost normal-case text-xl text-black"><?= __('2nd chance auctions')?></a> 
    </div>
    <form class="form-control h-full flex items-center justify-center" action="productToevoegen.php" method="post" enctype="multipart/form-data">
      <div class="card w-full max-w-lg shadow-2xl bg-white p-8 mx-auto justify-center items-center">
        <h2 class="text-black text-2xl mb-4"><?= __('Add Product')?></h2>
        <div class="flex flex-col gap-2">  
          <div class="flex flex-row gap-2"> 
            <div class="flex flex-col w-full"> 
              <label class="label text-black"><?= __('Product')?></label>
              <input type="text" name="naam" placeholder=<?= __('Product')?> class="input input-bordered w-full max-w-md text-black bg-white" required />
            </div>
            <div class="flex flex-col w-full"> 
              <label class="label text-black"><?= __('Minimum price')?></label>
              <input type="number" name="prijs" placeholder=<?= __('Minimum price')?> class="input input-bordered w-full max-w-md text-black bg-white" required />
            </div>
          </div>
          <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full"> 
              <label class="label text-black"><?= __('How long should your auction last')?>?</label>
              <select class='select select-bordered bg-white text-black' name='duur-timer' required >
                  <option value="6">6 uur</option>
                  <option value="12">12 uur</option>
                  <option value="18">18 uur</option>
                  <option value="24">24 uur</option>
                  <option value="30">30 uur</option>
                  <option value="36">36 uur</option>
                  <option value="42">42 uur</option>
                  <option value="48">48 uur</option>
              </select>
            </div>
          </div>
          <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full"> 
              <label class="label text-black"><?= __('Description')?></label>
              <textarea class="textarea textarea-bordered h-24  text-black bg-white" name="beschrijving" placeholder=<?= __('Description')?> required></textarea>
            </div>
          </div>
          <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full"> 
              <label class="label text-black"><?= __('Product Picture')?></label>
              <input type="file" name="file" class="file-input file-input-bordered bg-white text-black" required />
            </div>
          </div>
          <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full"> 
              <label class="label text-black"><?= __('Category')?></label>
              <?php
                if (getAllCategories($mysqli)) {
                  print "<select class='select select-bordered bg-white text-black' name='categorie' required >
                  <option disabled selected>Choose a category</option>";

                  foreach (getAllCategories($mysqli) as $row) {
                    print " <option value= " . $row["categorienaam"] . " >" . $row["categorienaam"] . " </option>";
                  }
                }
              ?>
              </select>
            </div>
          </div>
          <input type="submit" name="submit" class="btn border-none bg-white text-black hover:text-white hover:bg-black" value=<?= __('ADD PRODUCT')?>>
        </div>
      </div>
    </form>
  </div>
</body>
</html>