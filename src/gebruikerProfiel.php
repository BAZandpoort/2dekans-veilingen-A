<?php
include "./components/navbar.php";
include "./functions/sellerFunctions.php";
include "./functions/chatFunctions.php";

if (isset($_POST["liveChat"])) {
    if(isset($_SESSION["login"])){
        if(doesChatExists($mysqli,$_SESSION['login'],$_GET['user'])){
            $chatdataLink = doesChatExists($mysqli,$_SESSION['login'],$_GET['user']);
            header('location: '.$chatdataLink);
        }else{
            $ontvangersid = $_GET["user"];
            $chatid = bin2hex(random_bytes(16));
            $link = 'chatSystem.php?user=' . $_GET["user"] . '&chatid=' . $chatid . '';
            createChat($mysqli,$chatid, $ontvangersid,$_SESSION["login"], $link);
            header('location: chatSystem.php?user=' . $_GET["user"] . '&chatid=' . $chatid . '');
        }

    }
    //header('location: gebruikerprofiel.php?user='.$_GET["user"]);
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

  if(addReport($mysqli, $_SESSION["reportUser"], $_SESSION["login"], $reden, 0)) {
  
    if($_SESSION["theme"] == 'retro') {
    echo'    
    <div class="form-control flex justify-center items-center">
      <div class="  max-w-lg mx-auto justify-center items-center">
        <img id="Support" src="../public/img/Support3.png" alt="Support.png">
      </div>
        <a href="gebruikerProfiel.php?user=' . $_SESSION["reportUser"] .'" class="btn btn-xs sm:btn-sm md:btn-md lg:btn-lg btn-success">Return</button></a>
      
    </div>';
  } else if($_SESSION["theme"] == 'dark') {
    echo'    
    <div class="form-control flex justify-center items-center">
      <div class="  max-w-lg mx-auto justify-center items-center">
        <img id="Support" src="../public/img/Support2.png" alt="Support.png">
      </div>
        <a href="gebruikerProfiel.php?user=' . $_SESSION["reportUser"] .'" class="btn btn-xs sm:btn-sm md:btn-md lg:btn-lg btn-success">Return</button></a>
      
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
         <div class="w-50 rounded-full ">
          <img id="gebruikerFoto" src="../public/img/' . $row['profielfoto'] . '" alt="' . $row['profielfoto'] . '"/>
        </div>
        </div>

        <div class="divider lg:divider-horizontal bg-base-50"></div>

         <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
          <div class="card-body">
            <h2 class="text-2xl font-bold"> ' . $row['voornaam'] . ' ' . $row['naam'] . '</h2>
            <h2 class="text-2xl font-bold"> ' . $row['email'] . '</h2>
            <details class="collapse bg-base-200">
                <summary class="collapse-title text-xl font-medium">Description</summary>
                    <div class="collapse-content"> 
                         <p>' . $row['beschrijving'] . '</p>
                    </div>
            </details>
            <form method="post" action="gebruikerProfiel.php?user=' . $_GET["user"] . '">
                <button class="btn" name="liveChat">live chat</button>
            </form>
         </div>
         </div>

         <div class="card flex-shrink-0 w-full max-w-sm bg-base-100">
         <div class="card-body">
           <h2 class="text-2xl font-bold">Status</h2>

           ';
                if($row["admin"] == "1") {
                echo'<h2 class="text-2xl font-bold text-lime-600">Admin</h2>';
              } else {
                echo'<h2 class="text-2xl font-bold text-lime-600">Gebruiker</h2>';
              }
             echo '
           </div>
           </div>
           
           <div class="card flex-shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
           <div class="card-body">
           <h2 class="text-2xl font-bold">Report user</h2>
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
                </dialog>
                </div>
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
                                    <div class='text-blue-700'>".$row['melderid']."</div>

                                    
                                    </div>
                                </div>
                            </td>
                              <td>
                                 <div class='font-bold'>Reden: </div>
                                  <div>". $row["reden"] ."</div>
                              <td>
                            <td>
                            <div class='font-bold'>Behandeld: </div>";
 
                            if($row["behandeld"] == 0) {
                              echo "
                              <label class='swap swap-flip'>
                              <input type='checkbox' />
                             <div class='swap-off text-red-700' >✕</div>
                                    <div class='swap-on text-lime-500'><a href='./aanpassenReportBehandeld.php?report=".$row['rapportid']."'><button class='btn btn-ghost'>Veranderen naar behandeld?</button></a></div>
                                    </label>";
                                  
                            } else {
                              echo "
                              <label class='swap swap-flip'>
                              <input type='checkbox' />
                              <div class='swap-off text-lime-500'>✓</div>
                              <div class='swap-on text-red-700'><a href='./aanpassenReportOnbehandeld.php?report=".$row['rapportid']."'><button class='btn btn-ghost'>Veranderen naar onbehandeld?</button></a></div>
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

        foreach (getSellerProductInfo($mysqli, $_GET['user']) as $row) {



            echo '
        
        <div class="flex flex-wrap gap-12">
        
              
             <div class="card w-96 p-6 shadow-xl bg-white">';
            if (empty($row["foto"])) {
                echo ' <figure><img src="../public/img/brokenImageIcon.png" width="240" hight="320" /></figure>';
            } else {
                echo '
                <figure><img src="../public/img/' . $row["foto"] . '" width="240" hight="320" /></figure>';
            }
            echo '
                <div class="card-body"> 
                <a href="productDetails.php?gekozenProduct=' . $row['productid'] . '" id="productNaam" class="card-title">
                    <h2 class="card-title text-black">
                    ' . $row["naam"] . '
                    </h2>
                </a>
                <p class="text-black">' . $row["beschrijving"] . '</p>
                    <div class="card-actions justify-end">';
            if (empty($row["categorie"])) {
                echo ' <div class="badge badge-outline text-black">none</div> ';
            } else {
                echo '<div class="badge badge-outline text-black">' . $row["categorie"] . '</div>';
            }
            echo ' <div class="badge badge-outline text-black"> € ' . $row["prijs"] . '</div> ';
            $dateNow = date("Y-m-d H:i:s");
            $start = strtotime($dateNow);
            $end = strtotime($row['eindtijd']);

            $hours = intval(($end - $start) / 3600);
            if ($hours <= 0) {
                echo "tijd is afgelopen";
            } else {
                echo '
                    <span id="product-' . $row['productid'] . '" class="countdown font-mono text-2xl text-black">
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
            print '
                </div>
                </div>
                </div>';
            $tijd = $row["eindtijd"];


            echo '<script> countDown(' . $row['productid'] . ', ' . strtotime($tijd) . '); </script>';;
        };
    };

    ?>

</body>

</html>