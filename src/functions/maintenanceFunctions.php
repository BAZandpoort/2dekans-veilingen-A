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

<<<<<<< Updated upstream
=======
function showMaintenance($connection) {
    ?>
    <!DOCTYPE html>

    <html lang="en">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Maintenance...</title>
    <style type="text/css">
        
    * {
      box-sizing: border-box;
    }
    html, body {
    height: 100%;
    margin: 0;
    }
    main {
    height: 100%;
    margin: 0 auto;
    max-width: 700px;
    padding: 30px;
    display: table;
    text-align: center;
    }
    main > * {
    display: table-cell;
    vertical-align: middle;
    }
    
    body
    {
    font: 20px Helvetica, sans-serif; color: #333;
    }
    @keyframes blink {50% { color: transparent }}
    .dot { animation: 1s blink infinite }
    .dot:nth-child(2) { animation-delay: 250ms }
    .dot:nth-child(3) { animation-delay: 500ms }
    </style>
    </head>
    <body>
    <main>
    <div>
    <h1>Maintenance in progress<span class="dot">.</span><span class="dot">.</span><span class="dot">.</span></h1>
    <p>Sorry for the inconvenience but we're performing some maintenance right now. Please check back later.</p>
    </div>
    </main>
    </body>
    </html>
    <?php
    return;
    }

>>>>>>> Stashed changes
?>