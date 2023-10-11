<?php

 include "components/navbar.php";


if(!isset($_SESSION["login"])){
  header("location: index.php");
}




$gebruikerid = $_SESSION["login"];

if(isset($_POST["bied"])) {
$bod = $_POST["bod"];

if ($_SESSION["productid"] == "empty") {
  header("location: overzichtVeilingen.php?error3");

}


foreach(getPrice($mysqli,$_SESSION["productid"]) as $row){
if($bod < $row["prijs"]) {
    header("location: overzichtVeilingen.php?error2");
    return;

} else {



$sql = "INSERT INTO tblboden (productid, bod, gebruikersid) VALUES ('". $_SESSION["productid"]."', '".$bod."', '".$gebruikerid."')";
         if ($mysqli->query($sql)) {
            header("location: overzichtVeilingen.php?succes");
        } else {
          header("location: overzichtVeilingen.php?error1");
        }
        $mysqli->close();
// justify-center
     
}
}
}
if (isset($_GET["product"])) {
  $_SESSION["productid"] = $_GET["product"];
  }

?>



<!DOCTYPE html>
<head><meta charset="UTF-8" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>title</title></head>
<body>
<div class="form-control flex items-center bg-[#F1FAEE]">
  <label class="label">
    <span class="label-text text-2xl">Add your bid</span>
  </label>
  <form method="post" action="bod.php" >
  <label class="input-group">
    <input type="number" placeholder="0.00" class="input input-bordered" name="bod"/>
    <button type="submit" class="btn btn-warning" name="bied" >Bid</button>
</form>
  </label>
</div>

<div tabindex="0" class="collapse collapse-arrow border border-base-300 bg-base-200">
  <div class="collapse-title text-xl font-medium">
    Please be aware of following guidelines and or tips:
  </div>
  <div class="collapse-content"> 
    <p>1. You must bid above the asked minimum, or your bid will not be accepted.</p>
    <p>2. Please know that there are others bidding for your wished item as well.</p>
    <p>3. Stay alert of the timer of the item you are bidding for. This is like a competition after all to win the item.</p>
    <p>4. You will receive a notification if you did have the highest bid so you can communicate with the seller to buy the product.</p>
  </div>
</div>
</body>
