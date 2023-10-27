<?php
include "./connect.php";
include "./functions/userFunctions.php";
session_start();
require 'lang.php';
?>
<div class="navbar bg-[#F1FAEE]">
    <div class="navbar-start">
        <a href="index.php" class="btn btn-ghost normal-case text-xl text-black"><?= __('2nd chance auctions')?></a>
    </div>
    <div class="navbar-center">
        <details class="dropdown mb-0">
            <summary class="m-1 btn btn-ghost text-black"><?= __('Categories')?></summary>
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
        <input type="text" placeholder=<?= __('Search')?> class="input input-bordered bg-transparent md:w-auto" />
    </div>
    <div class="navbar-end">
    <div class="dropdown">
  <label tabindex="0" class="btn btn-ghost m-1"><?= __('Languages')?></label>
  <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-black text-white rounded-box w-52">
    <li><a href="index.php?lang=nl">Nederlands</a></li>
    <li><a href="index.php?lang=en">English</a></li>
    <li><a href="index.php?lang=fr">Français</a></li>
  </ul>
</div>
        <?php
        if (isset($_SESSION["login"])) {
        ?>
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle">
                    <div class="indicator">
                        <?php
                        $userid = $_SESSION["login"];
                        $favorites = getAllFavourites($mysqli, $userid)->fetch_all(MYSQLI_ASSOC);
                        $count = isset($favorites["productId"]) ? 1 : count($favorites);
                        if ($count == 0) {
                        ?>
                            <img src="../public/img/favourite.png" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        </div>
                        </label>
                        <div tabindex="0" class="mt-3 z-[1] card card-compact dropdown-content bg-black w-52 shadow">
                            <div class="card-body text-white">
                                <span class="font-bold text-lg"><?= __('Favorites')?></span>
                                <span class="text-md"><?= __('Add favorites to your list to view')?></span>
                            </div>
                        </div>
                    </div>
                        <?php
                        }else{
                            print' <span class="badge badge-sm indicator-item">' . $count . '</span>'
                        ?>              
                                    <a href="favorieten.php">
                                        <img href="" src="../public/img/favourite.png" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
        <li><a href="dashboard.php">Dashboard</a></li>
        <li>
                        <a href="aankoopgeschiedenis.php" class="justify-between">
                            <?=__('Purchase History')?>
                        </a>
                    </li>
        <li><a href="productToevoegen.php"><?= __('Add Product')?></a></li>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="loguit.php"><?= __('Logout')?></a></li>
    </ul>
</div>
<?php
        } else {
            print '<a href="login.php" class="btn btn-ghost text-black ml-2">';?><?=__('login')?> <?php echo '</a>';
        }
?>
</div>
</div>
