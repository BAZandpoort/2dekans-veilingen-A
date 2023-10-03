<?
include "connect.php";
session_start();
?>

<div class="navbar bg-base-100">
    <div class="navbar-start">
        <a class="btn btn-ghost normal-case text-xl">2dekans veilingen</a>
    </div>
    <div class="navbar-center">
        <details class="dropdown mb-0">
            <summary class="m-1 btn">Categorieën</summary>
            <ul name="categorieknop" tabindex="0" class="p-2 shadow menu dropdown-content z-[1] rounded-box w-25">
            </ul>
        </details>
        <input type="text" placeholder="Search" class="input input-bordered md:w-auto " />
    </div>
    <div class="navbar-end">
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle">
                <div class="indicator">
                    <img src="../public/img/bookmark.png" xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <span class="badge badge-sm indicator-item">8</span>
                </div>
            </label>
            <div tabindex="0" class="mt-3 z-[1] card card-compact dropdown-content w-52 bg-base-100 shadow">
                <div class="card-body">
                    <span class="font-bold text-lg">8 Items</span>
                    <div class="card-actions">
                        <button class="btn btn-primary btn-block">View Favorites</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                <div class="w-10 rounded-full">
                    <img src="../public/img/profile.png" />
                </div>
            </label>
            <ul tabindex="0" class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li>
                    <a href="aanpassenGebruikers.php" class="justify-between">
                        Profile
                    </a>
                </li>
                <li><a>Settings</a></li>
                <?php
                if (isset($_SESSION["login"])) {
                    echo '<li><a href="loguit.php">Logout</a></li>';
                } else {
                    echo '<li><a href="login.php">Login</a></li>';
                }
                ?>
            </ul>
        </div>
    </div>
</div>