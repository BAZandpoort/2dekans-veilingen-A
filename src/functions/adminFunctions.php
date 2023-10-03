<?php 
function krijgResterendeTijd($eindtijd) {
    $huidigeTijd = date("Y-m-d H:i:s");
    $eindtijd = strtotime($eindtijd);
    $huidigeTijd = strtotime($huidigeTijd);
    $tijdsverschil = $eindtijd - $huidigeTijd;
    $tijd = date("H:i:s", $tijdsverschil);
    return $tijd;
}
?>