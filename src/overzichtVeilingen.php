<?php
require 'lang.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?= __('Overview of auctions')?></title>
</head>

<body>
    <?php
    include "connect.php";
    include "functions/adminFunctions.php";
    session_start();

    if(isset($_GET["error1"])){
        $_SESSION["productid"] = "empty";
        print'<div class="alert alert-error">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>Error! Failed to succesfully bid, try logging out and in again.</span>
    </div>';
    }

    if(isset($_GET["error3"])){
        $_SESSION["productid"] = "empty";
        print'<div class="alert alert-error">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>Error! No product selected.</span>
    </div>';
    }

    if(isset($_GET["error4"])){
        print'<div class="alert alert-error">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span>Error! Can not bid on your own product, you little cheater!</span>
    </div>';
    }

    if (isset($_GET["succes"])) {
        $_SESSION["productid"] = "empty";
        print  '<div class="alert alert-success">
                  <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                  <span>Your bid has been added, good luck!</span>
                </div>';
    }

    $sql = "SELECT* FROM tblproducten";
    $resultaat = $mysqli->query($sql);

    while ($data = $resultaat->fetch_assoc()) {
        $tijd = getTimeDifference($data["eindtijd"]);
        echo '<br><table>
        <tr><td><img src="' . $data["foto"] . '" alt="product heeft geen foto"></td></tr>
       <tr> <td>naam: ' . $data["naam"] . '</td>
        <td>prijs: ' . $data["prijs"] . '</td> </tr>
       <tr> <td>beschrijving: ' . $data["beschrijving"] . '</td> </tr>
        <tr> <td>categorie: ' . $data["categorie"] . '</td> </tr>
       <tr> <td>resterende tijd: ' . $tijd . '</td></tr>
        <tr><td><a href="bod.php?product=' . $data["productid"] . '" class="btn">Bid</a></td></tr>
    </table><br>';
    }
    ?>

</body>

</html>