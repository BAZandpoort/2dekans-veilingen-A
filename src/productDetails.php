<?php
include "./functions/sellerFunctions.php";
include "./components/navbar.php";
include "./functions/adminFunctions.php";

if(isset($_POST["bied"])) {

 /* $currentData = fetch("SELECT * FROM tblboden WHERE productid = ? ORDER BY bodenID DESC", ['type' => 'i', 'value' => $i]);
  $_SESSION["gebruikerid1"] = $data["gebruikerid"];
  $_SESSION["productid1"] = $data["productid"]; */

  $bod = $_POST["bod"];
  $product = $_POST["product"];

  $hours = getTimeDifference(getProductTime($product));
  if ($hours <= 0) {
    header('location: overzichtVeilingen.php?errorTimeDone');
    return;
  }

  if (empty($product)) {
    header("location: overzichtVeilingen.php?errorNoProduct");
    return;
  }

  if (getProductSellerid(  $product) == $_SESSION["login"]) {
    header("location: productDetails.php?error4&gekozenProduct=" . $product . "");
    return;
  }

  if (getProductPrice(  $product) > $bod) {
    header("location: productDetails.php?errorUnderPrice&gekozenProduct=" . $product . "");
    return;
  } else {

    $sql = "INSERT INTO tblboden (productid, bod, gebruikersid) VALUES ('" . $product . "', '" . $bod . "', '" . $_SESSION["login"] . "')";
    if ( ->query($sql)) {
      $sql2 = "UPDATE tblproducten  SET prijs =  '" . $bod . "' WHERE productid = '" . $product . "'";
      if ( ->query($sql2)) {

        header("location: overzichtVeilingen.php?succes");
        return;
      }
    } else {
      header("location: overzichtVeilingen.php?errorFailedToBid");
      return;
    }
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>title</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function copyURL() {
      var textToCopy = window.location.href;
      var tempInput = document.createElement("input");
      tempInput.value = textToCopy;
      document.body.appendChild(tempInput);
      tempInput.select();
      document.execCommand("copy");
      document.body.removeChild(tempInput);
      alert("Copied link!")
    }
  </script>
</head>
<body data-theme='<?php echo $_SESSION["theme"] ?>'>
<?php
include "./components/countdown.php";
if (isset($_GET['gekozenProduct'])) {
    foreach(getProduct( $_GET['gekozenProduct']) as $row) {
      echo '
      <div class="divider"></div>
      <div class="bg-[#F1FAEE] card card-side bg-base-100 shadow-xl border-2 border-base-300 m-4">
        <figure class="flex w-2/5 object-scale-down">
          <img id="productFoto" class="float-right items-center" src="../public/img/' . $row['foto'] . '" alt="' . $row['foto'] . '"/>
        </figure>
        <div class="divider divider-horizontal"></div>
        <div class="card-body">
          <div class="card bg-base-50 bg-[#FFFFFF]">
            <div class="card-body">';
            if(isset($_GET["errorUnderPrice"])){
              print'<div class="alert alert-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>Error! Can not bid under minimal price.</span>
              </div>';
      }
      if (isset($_GET["error4"])) {
        print '<div class="alert alert-error">
                <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                <span>Error! Can not bid on your own product, you little cheater!</span>
              </div>';
      }
      print '<h2 class="text-2xl font-bold" id="productNaam"> ' . $row['naam'] . '</h2>
            <p class="text-slate-400 hover:text-blue-800"  id="productVerkoper"><a href="gebruikerProfiel.php?user=' . $row["verkoperid"] . '">' . getSellerName(  $row['verkoperid']) . ' ' . getSellerLastName(  $row['verkoperid']) . '</a></p>
              <div id="productprijs" class="badge badge-outline text-black"> € ' . $row["prijs"] . '</div>';
      if ($row['categorie']) {
        print '<div id="productprijs" class="badge badge-outline text-black">' . $row["categorie"] . '</div> ';
      }
      print '<p id="productBeschrijving">' . $row['beschrijving'] . '</p>
              <div class="flex">
              <form method="post" action="favorietenToevoegen.php?product=' . $row['productid'] . '">'; 
              echo '
         <span id="product-' . $row['productid'] .'" class="countdown font-mono text-2xl text-black">
            <span id="hours" style="--value:00;"></span>:
            <span id="minutes" style="--value:00;"></span>:
            <span id="seconds" style="--value:00;"></span>
          </span>';

          $tijd = $row["eindtijd"];?>
      <button class="btn w-40 mr-3">TOEVOEGEN AAN FAVORIETEN</button>
      </form>
      <button class="btn w-40" onclick="copyURL()">DELEN</button>
      </div>
      <label class="label">
        <span class="label-text !text-2xl">Add your bid</span>
      </label>
      <form method="post" action="productDetails.php">
        <label class="input-group">
          <?php
          echo '<input type="hidden" name="product" value="' . $_GET["gekozenProduct"] . '"/>';
          ?>
          <input type="number" placeholder="0.00" class="input input-bordered" name="bod" step="0.01" min="0.00" />
          <button type="submit" class="btn btn-warning" name="bied">Bid</button>
      </form>
      </label>
      </div>
      <details class="collapse border border-base-300 collapse-arrow">
        <summary class="collapse-title text-xl font-medium">Please be aware of following guidelines and or tips:</summary>
        <div class="collapse-content">
          <p>1. You must bid above the asked minimum, or your bid will not be accepted.</p>
          <p>2. Please know that there are others bidding for your wished item as well.</p>
          <p>3. Stay alert of the timer of the item you are bidding for. This is like a competition after all to win the item.</p>
          <p>4. You will receive a notification if you did have the highest bid so you can communicate with the seller to buy the product.</p>
        </div>
      </details>
      </div>
      </div>
      </div>
      </div>
  <?php
  echo '<script> countDown(' . $row['productid'] . ', '. strtotime($tijd) . '); </script>';
    };
  } else {
    header('location: overzichtVeilingen.php?errorNoProduct');
  };

  ?>
</body>

</html>