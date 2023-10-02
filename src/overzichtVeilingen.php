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
    session_start();

    $sql = "SELECT* FROM tblproducten"; 
    $resultaat = $mysqli ->query($sql); 
    
    while ($data = $resultaat -> fetch_assoc()) {
        $huidigeTijd = date("Y-m-d H:i:s");
        $eindtijd = strtotime($data["eindtijd"]);
        $huidigeTijd = strtotime($huidigeTijd);
        $tijdsverschil = $eindtijd - $huidigeTijd;
        $tijd = date("Y-m-d H:i:s", $tijdsverschil);
   echo '<br><table>
        <tr><td>foto: '.$data["foto"].' </td></tr>
       <tr> <td>naam: '.$data["naam"].'</td>
        <td>prijs: '.$data["prijs"].'</td> </tr>
       <tr> <td>beschrijving: '.$data["beschrijving"].'</td> </tr>
        <tr> <td>categorie: '.$data["categorie"].'</td> </tr>
       <tr> <td>startdatum: '.$data["eindtijd"].'</td>
        <td>eindtijd: '.$data["eindtijd"].' </td></tr>
        <tr><td><button class="btn">Bid</button></td></tr>
    </table><br>'; 
        }
        ?>

</body>
</html>