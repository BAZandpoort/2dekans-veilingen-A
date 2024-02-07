<?php
function setMaintenance($connection) {
    $sql = "UPDATE maintenance set Maintenance = 1";
    return ($connection->query($sql));
}

function unsetMaintenance($connection) {
    $sql = "UPDATE maintenance set Maintenance = 0";
    return ($connection->query($sql));
}

function getMaintenance($connection)
{
    $resultaat = $connection->query("SELECT Maintenance FROM maintenance");
    return ($resultaat->num_rows == 0) ? false : $resultaat->fetch_assoc()['Maintenance'];
}

?>