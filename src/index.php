<?php
include "overzichtVeilingen.php";
include "connect.php";

$gebruikerid = isset($_SESSION["login"]) ?  $_SESSION["login"] : null;
$data = fetch('SELECT * FROM tblgebruikers WHERE gebruikerid = ?',[
'type' => 'i',
'value' => $gebruikerid,
]);
$theme = $data['theme']=='light' ? 'customLight' : 'dark';
$_SESSION['theme'] = $theme;
?>
<!DOCTYPE html>
<html data-theme="<?php echo $theme; ?>">

<head>
  <meta charset="UTF-8" />
  <title>2nd chance auctions</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="/public/theme.css">
</head>

<body class="h-screen " data-theme="<?php echo $theme; ?>">
  
</body>
</html>