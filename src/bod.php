<?php
 include "connect.php";
 include "functions/userFunctions.php";
 session_start();

if(!isset($_SESSION["login"])){
  header("location: index.php");
}

$gebruikerid = $_SESSION["login"];

if(isset($_POST["bied"])) {
    include "connect.php";
$bod = $_POST["bod"];


foreach(getPrice($mysqli,$_SESSION["productid"]) as $row){
if($bod < $row["prijs"]) {
    echo "Error bij het toevoegen van je bod: Je hebt waarschijnlijk onder het minimum geboden. Ga terug en probeer snel opnieuw<br> ";
    print "<a href='overzichtVeilingen.php'>Ga terug</a>";
    return;

} else {



$sql = "INSERT INTO tblboden (productid, bod, gebruikersid) VALUES ('". $_SESSION["productid"]."', '".$bod."', '".$gebruikerid."')";
         if ($mysqli->query($sql)) {
            header("location: overzichtVeilingen.php");
        } else {
            echo "Error bij het toevoegen van je bod toevoegen, ga terug naar de pagina en probeer opnieuw.<br> ";
            print "<a href='overzichtVeilingen.php'>producten</a>";
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
<div class="form-control">
  <label class="label">
    <span class="label-text">Geef uw bod in</span>
  </label>
  <form method="post" action="bod.php">
  <label class="input-group">
    <input type="number" placeholder="0.00" class="input input-bordered" name="bod"/>
    <button type="submit" class="btn btn-warning" name="bied" >Bid</button>
</form>
  </label>
</div>

</body>