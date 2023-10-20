<?php
include "components/navbar.php";
if (!isset($_SESSION["dark"])) {
  $_SESSION["dark"] = "light";
}else{
  $_SESSION["dark"]= "black";
}
?>
<!DOCTYPE html>
<html <? echo'class="'.$_SESSION["darkmode"].'"';?>>

<head >
  <meta charset="UTF-8" />
  <title>2nd chance auctions</title>
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="h-screen bg-[#F1FAEE]">
</body>
</html>