<?php
include "./connect.php";
include "./functions/userFunctions.php";
require_once "../src/components/util.php";
session_start();
require 'lang.php';

$_SESSION["theme"] = 'retro';

$gebruiker = isset($_SESSION['login']) ? $_SESSION['login'] : null;
//id naar int zetten
$gebruiker = $gebruiker +0;

//als je bent ingelogd dan verschijnt knop
if ($gebruiker) {
  $change_theme = fetch("SELECT * from tblgebruikers Where gebruikerid = ?",
  ['type' => 'i', 'value' => $_SESSION["login"]]);
  //als theme retro is pak dan retro anders dark
  $theme = ($change_theme['theme'] === 'dark') ? 'dark' : 'retro';
  $_SESSION["theme"] = $theme;
}
?>
<div data-theme='<?php $_SESSION["theme"] ?>'>
<div class="navbar" >
    <div class="navbar-start">
        <a href="index.php" class="btn btn-ghost normal-case text-xl text-black"><?= Vertalen('2nd chance auctions')?></a>
    
    <?php
    //zet standaard op false
    $gebruikerbestaatal = false;
    $nietHoogste = false;

    //krijg max id van alle producten van tblboden
    $meesteID = fetch("SELECT MAX(productid) As maxid FROM `tblboden`"); 

//als je ingelogd bent
if(isset($_SESSION["login"])) {
    //for loop om maxid als int te krijgen
    for($i = 1; $i <= $meesteID["maxid"]; $i++) {

    //heeft aangelogde gebruiker al geboden
    $tabeldata2 = fetchSingle("SELECT * FROM `tblboden` WHERE productid = ? ORDER BY bod DESC", ['type' => 'i', 'value'=>$i] );
    foreach($tabeldata2 as $data) {
        //als gebruiker het zelfde is als gebruikersid dan bestaat de gebruiker al
        if($data['gebruikersid'] === $gebruiker){
            $gebruikerbestaatal = true;
        }
    }
    
    if($gebruikerbestaatal == true){
    $tabeldata = fetchSingle("SELECT * FROM `tblboden` WHERE productid = ? ORDER BY bod DESC limit 1", ['type' => 'i', 'value'=>$i] );
   
    foreach($tabeldata as $data) {
    //als gebruiker niet het zelfde is als gebruikerid dan is gebruiker ni de hoogste
    if( $data['gebruikersid'] !== $gebruiker){
        $nietHoogste = true;
        $product = $data["productid"];
    }
    }
    }
    }
}
    if($gebruikerbestaatal && $nietHoogste){?>
<div class="alert max-w-xs shadow-lg ml-2">
  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="stroke-info shrink-0 w-6 h-6"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
  <div>
    <h3 class="font-bold"><?= Vertalen('Warning!')?></h3>
    <div class="text-xs"><?= Vertalen('Someone outbid you')?></div>
  </div>
  <div class="flex[0.8]">
  <div>
  <a href="productDetails.php?gekozenProduct=<?php echo $product ?>">
            <button class="btn btn-sm" ><?= Vertalen('see')?></button>
        </a>
        </div>
</div>
    </div>
<?php }
 ?>
 </div>




    <div class="navbar-center">
        <details class="dropdown mb-0">
            <summary class="m-1 btn btn-ghost text-black"><?= Vertalen('Categories')?></summary>
            <ul name="categorieknop" tabindex="0" class="p-2 shadow text-white bg-black menu dropdown-content z-[1] rounded-box w-32">
                <?php
                
                foreach (getAllCategories($mysqli) as $row) {
                    echo '
                        
                        <li><a href="producten.php?gekozenCategorie=' . $row['categorienaam'] . '" name="categorieID">' . $row['categorienaam'] . '</a></li>
                        ';
                };
                ?>
            </ul>
        </details>
        <?php
            echo "
                <form method='post' action='".basename($_SERVER['PHP_SELF'])."'>
                    <input type='text' name='searchResult' placeholder='".Vertalen('Search')."' class='input input-bordered bg-transparent md:w-auto'/>
                </form>
            ";
            if (isset($_POST['searchResult'])) {
                $zoeklijst = createSearchlist($mysqli, $_POST['searchResult']);
                
                header('Location: zoekresultaten.php?zoekresultatenlijst='.urlencode(serialize($zoeklijst)).'');
            };
        ?>
    </div>
    <div class="navbar-end"> 
    
    <div class="dropdown">
  <label tabindex="0" class="btn btn-ghost m-1"><?= Vertalen('Languages')?></label>
  <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-black text-white rounded-box w-52">
    <li><a href="index.php?lang=nl">Nederlands</a></li>
    <li><a href="index.php?lang=en">English</a></li>
    <li><a href="index.php?lang=fr">Français</a></li>
  </ul>
</div>
        <?php
        if (isset($_SESSION["login"])) {
        ?>
        <div>
        <a href="change-theme.php">
            <button class="btn btn-ghost" >Theme</button>
        </a>
        </div>
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle">
                    <div class="indicator">
                        <?php
                        $userid = $_SESSION["login"];
                        $favorites = getAllFavourites($mysqli, $userid)->fetch_all(MYSQLI_ASSOC);
                        $count = isset($favorites["productId"]) ? 1 : count($favorites);
                        ($_SESSION["theme"] == 'retro')
                        ? $favoriteImage= "favourite.png"
                        : $favoriteImage= "favourite-white.png"; 
                        
                        if ($count == 0) {
                            print'<img src="../public/img/' .$favoriteImage.'"  xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        ';?>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        </div>
                        </label>
                        <div tabindex="0" class="mt-3 z-[1] card card-compact dropdown-content bg-black w-52 shadow">
                            <div class="card-body text-white">
                                <span class="font-bold text-lg"><?= Vertalen('Favorites')?></span>
                                <span class="text-md"><?= Vertalen('Add favorites to your list to view')?></span>
                            </div>
                        </div>
                    </div>
                        <?php
                        }else{
                            print' <span class="badge badge-sm indicator-item">' . $count . '</span>
                                    <a href="favorieten.php">
                                        <img src="../public/img/' .$favoriteImage.'" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    ';?>
                                        </a>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                </div>
                            </label>
                        </div>  
                        <?php
                        }
                        ?>
<div class="dropdown dropdown-end">
    <label tabindex="0" class="btn btn-ghost btn-circle avatar">
        <div class="w-10 rounded-full">
            <?php
            if ($_SESSION["login"]) {
                $userid = $_SESSION["login"];
                $image = getProfilePicture($mysqli, $userid);
                print '<img src="../public/img/' . $image . '"/>';
            }
            ?>
        </div>
    </label>
    <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-black text-white rounded-box w-52">
        <li>
            <a href="aanpassenGebruikers.php" class="justify-between">
            <?= __('Profile')?>
            </a>
        </li>
        <li><a><?= __('Settings')?></a></li>
        <li><a href="berichten.php">Berichten</a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li>
                        <a href="aankoopgeschiedenis.php" class="justify-between">
                            <?=Vertalen('Purchase History')?>
                        </a>
                    </li>
        <li><a href="productToevoegen.php"><?= Vertalen('Add Product')?></a></li>
        <li><a href="loguit.php"><?= Vertalen('Logout')?></a></li>
    </ul>
</div>
<?php
        } else {
            print '<a href="login.php" class="btn btn-ghost text-black ml-2">Login</a>';
        }
?>
</div>
</div>
</html>
