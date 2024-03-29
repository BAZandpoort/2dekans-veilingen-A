<?php
include "./components/navbar.php";
include "./functions/sellerFunctions.php";
include "./functions/adminFunctions.php";
require_once "./functions/userFunctions.php"; 
include "components/countdown.php";

include "./functions/chatFunctions.php";
if (isset($_SESSION["login"])) {
  if (doesChatExists($mysqli, $_SESSION['login'], $_GET['user'])) {
    $chatdataLink = doesChatExists($mysqli, $_SESSION['login'], $_GET['user']);
    $link = $chatdataLink;
  } else {
    $ontvangersid = $_GET["user"];
    $chatid = bin2hex(random_bytes(16));
    $link = 'chatSystem.php?user=' . $_GET["user"] . '&chatid=' . $chatid . '';
    createChat($mysqli, $chatid, $ontvangersid, $_SESSION["login"], $link);
  }
} else {
  $link = 'gebruikerprofiel.php?user=' . $_GET["user"];
}
include "./components/countdown.php";
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>Profiel gebruiker</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body data-theme="<?php echo $_SESSION['theme'] ?>">
  <?php

  if (isset($_POST["Report"])) {
    $reden = $_POST["reden"];

    if (addReport($mysqli, $_SESSION["reportUser"], $_SESSION["login"], $reden, 0)) {

      if ($_SESSION["theme"] == 'retro') {
        echo '    
    <div class="form-control flex justify-center items-center">
      <div class="  max-w-lg mx-auto justify-center items-center">
        <img id="Support" src="../public/img/Support3.png" alt="Support.png">
      </div>
        <a href="gebruikerProfiel.php?user=' . $_SESSION["reportUser"] . '" class="btn btn-xs sm:btn-sm md:btn-md lg:btn-lg btn-success">Return</button></a>
      
    </div>';
      } else if ($_SESSION["theme"] == 'dark') {
        echo '    
    <div class="form-control flex justify-center items-center">
      <div class="  max-w-lg mx-auto justify-center items-center">
        <img id="Support" src="../public/img/Support2.png" alt="Support.png">
      </div>
        <a href="gebruikerProfiel.php?user=' . $_SESSION["reportUser"] . '" class="btn btn-xs sm:btn-sm md:btn-md lg:btn-lg btn-success">Return</button></a>
      
    </div>';
      }
    }
  }





  if (isset($_GET['user'])) {
    foreach (getSeller($mysqli, $_GET['user']) as $row) {
      $_SESSION["reportUser"] = $_GET["user"];

      echo '
      <div class="divider lg:divider-horizontal bg-base-50"></div>
      <div class="divider"></div>
      <div class="bg-[#F1FAEE] card card-side bg-base-100 shadow-xl border-2">
       <div class="avatar">
         <div class="h-80 w-80 rounded-full ">
          <img id="gebruikerFoto" src="../public/img/' . $row['profielfoto'] . '" alt="' . $row['profielfoto'] . '"/>
        </div>
        </div>

        <div class="divider lg:divider-horizontal bg-base-50"></div>

         <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
          <div class="card-body">
            <h2 class="text-2xl font-bold">Naam:  ' . $row['voornaam'] . ' ' . $row['naam'] . '</h2>
            <h2 class="text-2xl font-bold">Email:  ' . $row['email'] . '</h2>
            <details class="collapse bg-base-200">
                <summary class="collapse-title text-xl font-medium">Description</summary>
                    <div class="collapse-content"> 
                         <p>' . $row['beschrijving'] . '</p>
                    </div>
            </details>
            <a href="' . $link . '">
                <button class="btn" name="liveChat">live chat</button>
                </a>
         </div>
         </div>

         <div class="card flex-shrink-0 w-full max-w-sm bg-base-100">
         <div class="card-body">
           <h2 class="text-2xl font-bold">Status</h2>

           ';
                if($row["admin"] == "1") {
                echo'<h2 class="text-2xl font-bold text-lime-600">Admin</h2>'; 
              } else {
                if(isset($_POST["rate"])) {
                  $user = $_POST["user"];
                  $rating1 = ($_POST["rating-10"])/2;
                  $loginUser = $_SESSION["login"];
                  addRate($mysqli, $rating1, $user, $loginUser); 
                }else{
                  $user = $_GET["user"];
                }
                echo'<h2 class="text-2xl font-bold text-lime-600">Gebruiker</h2>
                <h2 class="text-2xl font-bold">Overall Review</h2>  
                <form method="post" action="gebruikerProfiel.php?user='.$user.'">
                <div class="rating rating-lg rating-half">
                    <input type="radio" name="rating-10" class="rating-hidden" value="0" />
                     <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-1" value="1" />
                     <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-2 "value="2" />
                     <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-1" value="3"/>
                     <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-2" value="4"/>
                     <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-1" value="5"/>
                     <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-2" value="6"/>
                     <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-1" value="7"/>
                     <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-2" value="8"/>
                     <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-1" value="9"/>
                     <input type="radio" name="rating-10" class="bg-green-500 mask mask-star-2 mask-half-2" value="10"/>
                     <input type="hidden" name="user" value="'.$user.'" id="user" />
                     </div>'; 
                     $loginUser = $_SESSION["login"];
                     $alreadyChecked = checkIfRated($mysqli, $user, $loginUser); 
                     if ($alreadyChecked == "0") {
                    echo' <button class="btn btn-wide hover:bg-[#FF7F7F]" name="rate" >Rate</button>'; 
                     }
                     echo '
                     </form>';                  
                    $gemiddeldeRating = getGemiddeldeRating($mysqli,$user); 
                    $countRating = getCountRating($mysqli, $user); 
                    if ($countRating === "0") {
                      echo "Deze gebruiker is nog niet beoordeeld"; 
                    } else {
                      $gemiddeldeRating = round($gemiddeldeRating, 0); 
                      echo ' 
                      <div class="stats shadow">
                      <div class="stat">
                      <div class="stat-title">Beoordeling</div>
                      <div class="stat-value text-primary">'.$gemiddeldeRating.'/5</div>
                      </div>
                      </div>
                      ';
                    }

              } 
             echo '

           </div>
           </div>
           
           <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
           <div class="card-body">';
      if (isset($_SESSION['login']) && $_SESSION['login'] == $_GET['user']) {
        print '<h2 class="text-2xl font-bold">Edit account</h2>
            <a href="aanpassenGebruikers.php">
              <button class="btn btn-wide hover:bg-[#FF7F7F]">Edit</button>
            </a>';
      } else {
        print '<h2 class="text-2xl font-bold">Report user</h2>
            <button class="btn  hover:bg-[#FF7F7F]" onclick="my_modal_1.showModal()">Report</button>
                <dialog id="my_modal_1" class="modal">
                     <div class="modal-box">
                     <form method="post" action="gebruikerProfiel.php">      
                        <p class="py-4">Geef reden voor je report</p>
                        <textarea placeholder="Reden" name="reden" class="textarea textarea-bordered textarea-md w-full max-w-xs" ></textarea>
                        <div class="flex justify-between items-end">
                            <button type="submit" class="btn btn-error" name="Report">Report</button>
                             </form>


                            <div class="modal-action">
                                <form method="dialog" class="m-0">
                                    <button class="btn btn-warning">Cancel</button>
                                </form>
                            </div>
                        </div>    
                     </div>
                </dialog>';
      }
      print '</div>
                </div>';
      if (isset($_SESSION["admin"])) {
        echo ' <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
           <div class="card-body">
           <h2 class="text-2xl font-bold">Check User Reports</h2>
            <button class="btn  hover:bg-[#FF7F7F]" onclick="my_modal_2.showModal()">User Reports</button>
                <dialog id="my_modal_2" class="modal">
                    <div class="modal-box">
                      <h3 class="font-bold text-lg text-center">User reports</h3>
                      <div class="overflow-x-auto h-96">
                      <table class="table table-pin-rows">';
        foreach (getReportedUsers($mysqli, $_SESSION['reportUser']) as $row) {

          echo "
                        
                        <tr>
                      
                            <td>
                                <div class='flex items-center'>
                                    <div>
                                    <div class='font-bold'>Meldernummer:</div>
                                    <div class='text-blue-700'>" . $row['melderid'] . "</div>

                                    
                                    </div>
                                </div>
                            </td>
                              <td>
                                 <div class='font-bold'>Reden: </div>
                                  <div>" . $row["reden"] . "</div>
                              <td>
                            <td>
                            <div class='font-bold'>Behandeld: </div>";

          if ($row["behandeld"] == 0) {
            echo "
                              <label class='swap swap-flip'>
                              <input type='checkbox' />
                             <div class='swap-off text-red-700' >✕</div>
                                    <div class='swap-on text-lime-500'><a href='./aanpassenReportBehandeld.php?report=" . $row['rapportid'] . "'><button class='btn btn-ghost'>Veranderen naar behandeld?</button></a></div>
                                    </label>";
          } else {
            echo "
                              <label class='swap swap-flip'>
                              <input type='checkbox' />
                              <div class='swap-off text-lime-500'>✓</div>
                              <div class='swap-on text-red-700'><a href='./aanpassenReportOnbehandeld.php?report=" . $row['rapportid'] . "'><button class='btn btn-ghost'>Veranderen naar onbehandeld?</button></a></div>
                              </label>";
          }
          "
                            </td>
                          
                        </tr>
                       
                        
                        
                        ";
        }
        echo '</table>
                              </div>
                              <div class="modal-action">
                               <form method="dialog">
                                 <button class="btn">Cancel</button>
                               </form>
                             </div>
                     </div>
                </dialog>
                   <a href="verwijderGebruiker.php?verwijder=' . $row["gebruikerid"] . '" class="btn bg-red">Verwijder</a>';
      }
      echo '
          </div>
          </div>

         
        </div>
        </div>
        </div>
        </div>

        <br>';
    }
    echo '

<div class= "pl-10 flex flex-wrap gap-4 ">';
    foreach (getSellerProductInfo($mysqli, $_GET['user']) as $row) {
      echo '
        <div class=" mr-4 mt-11 w-80  overflow-hidden rounded-lg bg-white dark:bg-slate-800 shadow-md duration-300 hover:scale-105 hover:shadow-lg">
  <a href = "productDetails.php?gekozenProduct=' . $row['productid'] . '"><img id = "productFoto" class="h-48 w-full object-cover object-center" src="../public/img/' . $row['foto'] . '" alt="' . $row['foto'] . '" width="240" hight="320" /></a> 


  <div class="p-4">
    <h2 class="mb-2 text-lg font-medium dark:text-white text-gray-900">' . $row['naam'] . '</h2>
    <p class="mb-2 text-base dark:text-gray-300 text-gray-700">' . $row['beschrijving'] . '</p>
    <div class="flex items-center">
      <p class="mr-2 text-lg font-semibold text-gray-900 dark:text-white">€ ' . $row['prijs'] . '</p>
    </div>
     <p class="mb-2 text-base dark:text-gray-300 text-gray-700">' . $row['categorie'] . '</p>
     
  </div>
</div>';
    };

    echo '
</div>';


      /* foreach(getSellerProductInfo($mysqli, $_GET['user']) as $row) {

}
    
   
/*


        echo'
        
        <div class="flex flex-wrap gap-12">
        
              
             <div class="card w-96 p-6 shadow-xl bg-white">';
                if (empty($row["foto"])) {
                echo' <figure><img src="../public/img/brokenImageIcon.png" width="240" hight="320" /></figure>';  
                } else {
                echo'
                <figure><img src="../public/img/'.$row["foto"].'" width="240" hight="320" /></figure>';
                }
                echo'
                <div class="card-body"> 
                
                <a href="productDetails.php?gekozenProduct='.$row['productid'].'" id="productNaam" class="card-title">
                    <h2 class="card-title text-black">
                    '.$row["naam"].'
                    </h2>
                </a>
                <p class="text-black">'.$row["beschrijving"].'</p>
                    <div class="card-actions justify-end">';
                    if (empty($row["categorie"])) {
                    echo ' <div class="badge badge-outline text-black">none</div> ';
                    } else {
                    echo '<div class="badge badge-outline text-black">'.$row["categorie"].'</div>';
                    }
                    echo ' <div class="badge badge-outline text-black"> € '.$row["prijs"].'</div> ';
                    $dateNow = date("Y-m-d H:i:s");
                    $start = strtotime($dateNow);
                    $end = strtotime($row['eindtijd']);
            
                    $hours = intval(($end - $start)/3600);
                    if ($hours <= 0) {
                        echo "tijd is afgelopen"; 
                    } else {
                    echo '
                    <span id="product-' . $row['productid'] .'" class="countdown font-mono text-2xl text-black">
                        <span id="hours" style="--value:00;"></span>:
                        <span id="minutes" style="--value:00;"></span>:
                        <span id="seconds" style="--value:00;"></span>
                    </span>';
                    }
                    echo '<img src="../public/img/addfavorite.png" class="h-10 w-10" class="btn">
                    
                    <a href="bod.php?product=' . $row["productid"] . '"">
                    <button class="btn btn-outline text-black bg-white border-white hover:text-white hover:bg-black ">Bid</button>
                    </a>';
                    if (isset($_SESSION["admin"])) {
                        echo '<a href="productVerwijderenAdmin.php?verwijder=' . $row["productid"] . '" class="btn bg-[#FF7F7F]">Verwijder</a>';
                    } 
                    print'
                </div>
                </div>
                </div>';
                $tijd = $row["eindtijd"];


                echo '<script> countDown(' . $row['productid'] . ', '. strtotime($tijd) . '); </script>';
            */;

    //};

  };



  ?>

</body>

</html>