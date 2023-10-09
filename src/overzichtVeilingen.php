<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>title</title>
</head>

<body>
    <?php
    include "connect.php";
    include "functions/adminFunctions.php";
    session_start();

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
        <tr><td><a href="bod.php?bieden=' . $data["productid"] . '" class="btn">Bid</a></td></tr>
    </table><br>';
    }
    ?>

</body>

</html>