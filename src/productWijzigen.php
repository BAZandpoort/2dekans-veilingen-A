<!DOCTYPE html>
<html lang="en" class="bg-[#1D3557]">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Product Wijzigen</title>
	<link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.7/dist/full.css" rel="stylesheet" type="text/css" />
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="h-screen bg-[#F1FAEE]">
	  <?php
include "connect.php";
include "functions/sellerFunctions.php";
include "functions/userFunctions.php";

session_start();

/*if(!isset($_SESSION['login'])){
  header('location: index.php');
  return;
};*/


if (isset($_POST['submit'])) {
  $productID =$_POST['productID'];
	$naam= $_POST['naam'];
  	$prijs= $_POST['prijs'];
  	$beschrijving= $_POST['beschrijving'];
  	$categorie= $_POST['categorie'];
  	$entime = date('Y-m-d H:i:s', strtotime('+12 hours'));
  	$upload_dir= $_SERVER['DOCUMENT_ROOT']."/2dekans-veilingen-A/public/img/";
  	$file_name= $_FILES['file']['name'];
  	$file_tmp= $_FILES['file']['tmp_name'];


  if (filesize( $file_name ) < 0){
  echo "Error";
  }
  if((empty($_POST['file']))){
    if (!(move_uploaded_file($file_tmp, $upload_dir . $file_name))) {
        echo "Error, kon de foto niet verplaatsen.";
      };
      modifyProduct2($mysqli, $naam, $productID ,$beschrijving, $prijs, $categorie);
  }
  var_dump($file_name);
    if(modifyProduct($mysqli, $naam, $productID ,$beschrijving, $prijs, $categorie, $file_name)){
    header('location: index.php');
    }else{
	echo "Error product wijzigen.";
    }


}else{

 //Als er geen gekozenproduct is dan moet het naar index.
  if (!isset($_GET['gekozenProduct'])) {
    header("Location: index.php");
  } else {
    $productID = $_GET['gekozenProduct'];
    if(mysqli_num_rows(getProduct($mysqli, $productID)) == 0) {
      header("Location: index.php");  
      //Als productID niet bestaat dan moet het naar index.
    }
  }
 
  foreach(getProduct($mysqli, $productID) as $row) {


echo '<div>
    <div class="flex justify-start items-start">
      <a href="index.php" class="btn btn-ghost normal-case text-xl text-black">2dekans veilingen</a> 
    </div>
    <form class="form-control h-full flex items-center justify-center" action="productWijzigen.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="productID" value="'.$productID.'"">
      <div class="card w-full max-w-lg shadow-2xl bg-white p-8 mx-auto justify-center items-center">
        <h2 class="text-black text-2xl mb-4">Modify Product</h2>
        <div class="flex flex-col gap-2">  
          <div class="flex flex-row gap-2"> 
            <div class="flex flex-col w-full"> 
              <label class="label text-black">Product</label>
              <input type="text" name="naam" placeholder="Product" value = "'.$row["naam"].'" class="input input-bordered w-full max-w-md text-black bg-white" required  />
            </div>
            <div class="flex flex-col w-full"> 
              <label class="label text-black">Minimale prijs</label>
              <input type="text" name="prijs" placeholder="Minimale prijs" value = "'.$row["prijs"].'" class="input input-bordered w-full max-w-md text-black bg-white" required />
            </div>
          </div>
          <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full"> 
              <label class="label text-black">Beschrijving</label>
              <textarea class="textarea textarea-bordered h-24  text-black bg-white" name="beschrijving" placeholder="Beschrijving"  required>'.$row["beschrijving"].'</textarea>
            </div>
          </div>
          <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full"> 
              <label class="label text-black">Productfoto</label>
              <input type="file" name="file" class="file-input file-input-bordered bg-white text-black" value = "'.$row["foto"].'" />
            </div>
          </div>
          <div class="flex flex-row gap-2">
            <div class="flex flex-col w-full"> 
              <label class="label text-black" >Categorie</label>';
                $productCategorie = getProductCategorie($mysqli,$productID);
                print'<select class="select select-bordered bg-white text-black" name="categorie" required >';
                if($row["categorie"] == false ){
                  print' <option selected disabled>Kies een categorie</option>';

                }

                foreach(getAllCategories($mysqli) as $row1){
                  if($row["categorie"] == $row1["categorienaam"]){
                    print' <option disabled>Kies een categorie</option>
                    <option selected value="'.$row1["categorienaam"].'">'.$row1["categorienaam"].'</option>';
                  }else{
                    print'<option value="'.$row1["categorienaam"].'">'.$row1["categorienaam"].'</option>';
                  }
                
                }
                print'</select>';
             }
           
          }
              ?>
              </select>
            </div>
          </div>
          <input type="submit" name="submit" class="btn border-none bg-white text-black hover:text-white hover:bg-black" value="PRODUCT Wijzigen">
        
      
        </div>
      </div>
    </form>
  </div>
</body>
</html>