<?php
    include "functions/buyerFunctions.php";
    include "functions/sellerFunctions.php";
    include "components/navbar.php";

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
    <title>Dashboard</title>
</head>
<body data-theme="<?php echo $_SESSION['theme'] ?>">
    
<body class="bg-[#F1FAEE]">
    <div class="max-w-6xl mx-auto bg-white rounded-lg shadow-lg p-12">
        <h1 class="text-2xl font-bold"><?= Vertalen('Sales')?></h1>
        <div class="flex text-left p-3 shadow rounded-lg mt-3 mb-3">
            <div class="stat">
                <div class="stat-title"><?= Vertalen('Revenue')?></div>
                <div class="stat-value">€<?php echo getTotalRevenue($mysqli, $_SESSION['login']) ?></div>
                <div class="stat-desc"><?= Vertalen('Total amount of money brought in')?></div>
            </div>
            <div class="stat">
                <div class="stat-title"><?= Vertalen('Active products')?></div>
                <div class="stat-value"><?php echo getTotalActiveProducts($mysqli, $_SESSION['login']) ?></div>
                <div class="stat-desc"><a href="actieveProducten.php" class="link"><?= Vertalen('Overview of all active products')?></a></div>
            </div>
            <div class="stat">
                <div class="stat-title"><?= Vertalen('Products sold')?></div>
                <div class="stat-value"><?php echo getTotalSoldProducts($mysqli, $_SESSION['login']) ?></div>
                <div class="stat-desc"><a href="verkoopgeschiedenis.php" class="link"><?= __('Overview of all active products')?></a></div>
            </div>
        </div>  
        <h1 class="text-2xl font-bold"><?= Vertalen('Purchases')?></h1>
        <div class="flex text-left p-3 shadow rounded-lg mt-3 mb-3">
            <div class="stat">
                <div class="stat-title"><?= Vertalen('Expenses')?></div>
                <div class="stat-value">€<?php echo getTotalExpenses($mysqli, $_SESSION['login']) ?></div>
                <div class="stat-desc"><?= Vertalen('Total amount of money spent')?></div>
            </div>
            <div class="stat">
                <div class="stat-title"><?= Vertalen('Products bought')?></div>
                <div class="stat-value"><?php echo getTotalBoughtProducts($mysqli, $_SESSION['login']) ?></div>
                <div class="stat-desc"><a href="aankoopgeschiedenis.php" class="link"><?= Vertalen('Overview of all bought products')?></a></div>
            </div>
        </div>
        <div class="flex">
            <div class="w-1/2 mr-3">
                <h1 class="text-2xl font-bold"><?= Vertalen('Your sales')?></h1>
                <div class="overflow-x-auto shadow rounded-lg mt-3 mb-3">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><?= Vertalen('Name')?></th>
                            <th class="text-center"><?= Vertalen('Price')?></th>
                            <th class="text-center"><?= Vertalen('Date')?></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach (getLastSales($mysqli, $_SESSION['login'], 3) as $row) {
                                    echo '
                                    <tr>
                                        <td>
                                        <div class="flex items-center space-x-3">
                                            <div class="avatar">
                                            <div class="mask mask-squircle w-12 h-12">
                                                <img src="../public/img/'.$row['foto'].'" alt="'.$row['foto'].'"/>  
                                            </div>
                                            </div>
                                            <div>
                                            <div class="font-bold">'.$row['naam_product'].'</div>
                                            <div class="text-sm opacity-50">'.$row['voornaam'].' '.$row['naam'].'</div>
                                            </div>
                                        </div>
                                        </td>
                                        <td class="text-center">€'; echo getHighestBid($mysqli, $row['productid']); echo '</td>
                                        <td class="text-center">'.$row['datum'].'</td>
                                    </tr>
                                    ';
                                }
                            ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3"><a href="verkoopgeschiedenis.php" class="link"><?= Vertalen('See all sales')?></a></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="w-1/2 ml-3">
                <h1 class="text-2xl font-bold"><?= Vertalen('Your purchases')?></h1>
                <div class="overflow-x-auto shadow rounded-lg mt-3 mb-3">
                    <table class="table">
                        <thead>
                        <tr>
                            <th><?= Vertalen('Name')?></th>
                            <th class="text-center"><?= Vertalen('Price')?></th>
                            <th class="text-center"><?= Vertalen('Date')?></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach (getLastPurchases($mysqli, $_SESSION['login'], 3) as $row) {
                                    echo '
                                    <tr>
                                        <td>
                                        <div class="flex items-center space-x-3">
                                            <div class="avatar">
                                            <div class="mask mask-squircle w-12 h-12">
                                                <img src="../public/img/'.$row['foto'].'" alt="'.$row['foto'].'"/>  
                                            </div>
                                            </div>
                                            <div>
                                            <div class="font-bold">'.$row['naam_product'].'</div>
                                            <div class="text-sm opacity-50">'.$row['voornaam'].' '.$row['naam'].'</div>
                                            </div>
                                        </div>
                                        </td>
                                        <td class="text-center">€'; echo getHighestBid($mysqli, $row['productid']); echo '</td>
                                        <td class="text-center">'.$row['datum'].'</td>
                                    </tr>
                                    ';
                                }
                            ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3"><a href="aankoopgeschiedenis.php" class="link"><?= Vertalen('See all purchases')?></a></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>