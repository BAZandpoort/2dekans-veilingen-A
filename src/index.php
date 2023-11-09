<?php
include "overzichtVeilingen.php";
include "connect.php";

$gebruikerid = isset($_SESSION["login"]) ?  $_SESSION["login"] : null;
if ($gebruikerid) {
$data = fetch('SELECT * FROM tblgebruikers WHERE gebruikerid = ?',[
'type' => 'i',
'value' => $gebruikerid,
]);
$theme = $data["theme"]=='retro' ? 'retro' : 'dark';
$_SESSION['theme'] = $theme;
}
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <title>2nd chance auctions</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen" data-theme="<?php echo $_SESSION['theme'] ?>">
  
</body>
</html>