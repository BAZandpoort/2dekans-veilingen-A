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
<div class="form-control h-full flex items-center justify-center">
  <label class="label">
    <span class="label-text text-2xl">Geef uw bod in</span>
  </label>
  <form method="post" action="bod.php" >
  <label class="input-group text-2xl">
    <input type="number" placeholder="0.00" class="input input-bordered" name="bod"/>
    <button type="submit" class="btn btn-warning" name="bied" >Bid</button>
</form>
  </label>
</div>

</body>