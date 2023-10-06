<?php
    include "components/navbar.php";
    include "functions/buyerFunctions.php";

    if(!(isset($_SESSION['login']))) {
        header("Location: index.php");
    }

    /*  SELECT tblproducten.foto, tblproducten.naam, MAX(tblboden.bod) AS highest_bid, tblgebruikers.voornaam, tblgebruikers.naam, tblfacturen.datum
        FROM tblfacturen
        INNER JOIN tblproducten ON (tblfacturen.productid = tblproducten.productid)
        INNER JOIN tblboden ON (tblboden.productid = tblfacturen.productid)
        INNER JOIN tblgebruikers ON (tblproducten.verkoperid = tblgebruikers.gebruikerid)
        WHERE tblfacturen.koperid = 38;
    */
?>
<!DOCTYPE html>
<html lang="en" class="bg-[#F1FAEE]">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body class="min-h-screen bg-[#F1FAEE]">
    <div class="overflow-x-auto max-w-4xl mx-auto p-3">
        <table class="table bg-white shadow-lg">
            <thead>
                <tr>
                    <th class="text-left">Product</th>
                    <th class="text-center">Prijs</th>
                    <th class="text-center">Datum/tijd</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach (getAllPurchases($mysqli, $_SESSION['login']) as $row) {
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
                                    <div class='text-sm opacity-50'>".$row['voornaam']." ".$row['naam']."</div>
                                    </div>
                                </div>
                            </td>
                            <td class='text-center'>€".$row['highest_bid']."</td>
                            <td class='text-center'>".$row['datum']."</td>
                        </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>