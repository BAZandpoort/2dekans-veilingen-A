<?php
    include "components/navbar.php";
    include "functions/sellerFunctions.php";
    include "functions/buyerFunctions.php";


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
<body class="min-h-screen" data-theme='<?php echo $_SESSION["theme"] ?>'>
    <div class="overflow-x-auto max-w-4xl mx-auto p-3">
        <table class="table shadow-lg">
            <thead>
                <tr>
                    <th class="text-left">Product</th>
                    <th class="text-center">Hoogste bod</th>
                    <th class="text-center">Startdatum</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if((getActiveProducts(  $_SESSION['login'])) == null) {
                    echo "
                    <tr>
                        <td colspan=4>U hebt nog geen actieve producten.</td>
                    </tr>
                    ";
                } else {
                    foreach (getActiveProducts(  $_SESSION['login']) as $row) {
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
                                    <div class='font-bold'>".$row['naam_product']."</div>
                                    <div class='text-sm opacity-50'>".$row['voornaam']." ".$row['naam']."</div>
                                    </div>
                                </div>
                            </td>
                            <td class='text-center'>€"; echo getHighestBid(  $row['productid']); echo "</td>
                            <td class='text-center'>".$row['datum']."</td>
                        </tr>
                        ";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>