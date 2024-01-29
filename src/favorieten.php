<?php
    include "functions/buyerFunctions.php";
    include "components/navbar.php";
    include "functions/adminFunctions.php";

    if(!(isset($_SESSION['login']))) {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title><?= Vertalen('Document')?></title>
</head>
<body class="min-h-screen" data-theme="<?php echo $_SESSION['theme'] ?>">
    <div class="overflow-x-auto max-w-4xl mx-auto p-3">
        <table class="table bg-white shadow-lg">
            <thead>
                <tr>
                    <th><?= Vertalen('Product')?></th>
                    <th class="text-center"><?= Vertalen('Highest offer')?></th>
                    <th class="text-center"><?= Vertalen('Time left')?></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach (getAllFavourites(  $_SESSION['login']) as $row) {
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
                            
                            echo getHighestBid(  $row['productid']);

                            $time = getTimeDifference($row["eindtijd"]);
                            if ($time <= 0) {
                                $time = "afgelopen";
                            } else {
                                echo '
                                <td class="text-center">  
                                <span id="product-' . $row['productid'] .'" class="countdown font-mono text-2xl text-black">
                                    <span id="hours" style="--value:00;"></span>:
                                    <span id="minutes" style="--value:00;"></span>:
                                    <span id="seconds" style="--value:00;"></span>
                                    </span>
                                    </td>
                                    <script>  countDown(' . $row['productid'] . ', '. strtotime($row["eindtijd"]) . '); </script>';
                            }
                            echo "
                            <th class='text-center'>
                            <a href='productDetails.php?gekozenProduct=".$row['productid']."'><button class='btn btn-ghost btn-xs'>PLAATS BOD</button></a>
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