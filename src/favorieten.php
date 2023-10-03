<?php
    include "connect.php";
    include "functions/userFunctions.php";
    include "functions/buyerFunctions.php";
    session_start();

    if(!(isset($_SESSION['login']))) {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <div class="overflow-x-auto max-w-4xl mx-auto p-3">
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th class="text-center">Hoogste bod</th>
                    <th class="text-center">Tijd over</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach (getAllFavourites($mysqli, $_SESSION['login']) as $row) {
                        echo "
                        <tr>
                            <td>
                                <div class='flex items-center space-x-3'>
                                    <div class='avatar'>
                                    <div class='mask mask-squircle w-16 h-16'>
                                        <img src='../public/img/".$row['foto']."' alt='".$row['foto']."'/>
                                    </div>
                                    </div>
                                    <div>
                                    <div class='font-bold'>".$row['naam']."</div>
                                    <div class='text-sm opacity-50'>".$row['voornaam']." ".$row['achternaam']."</div>
                                    </div>
                                </div>
                            </td>
                            <td class='text-center'>€"; 
                            
                            echo getHighestBid($mysqli, $row['productid']);
                            
                            echo "</td>
                            <td class='text-center'>24u 14m</td>
                            <th class='text-center'>
                            <a href='product.php?product=".$row['productid']."'><button class='btn btn-ghost btn-xs'>PLAATS BOD</button></a>
                            </th>
                            <td>
                            <a href='verwijderUitFavorieten.php?product=".$row['productid']."'><button class='btn btn-sm btn-circle btn-ghost'>✕</button>
                            </td>
                        </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>