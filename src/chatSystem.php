<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>title</title>
</head>
<body class="min-h-screen bg-[#F1FAEE]">
    <?php
     include "components/navbar.php";
     include "functions/chatFunctions.php";  
    ?>
    <?php
    $data = getChatData($mysqli); 
    foreach ($data as $value) {
      $data2 = getZender($mysqli, $_SESSION["login"]); 
      if (($value["zenderVoornaam"] == $data2["voornaam"])&&($value["zenderAchternaam"] == $data2["naam"])) {
       
      echo '
    <div class="flex flex-col">
<div class="chat chat-start">
  <div class="chat-bubble">'.$value["bericht"].'</div>
  <div class="chat-footer opacity-50">
  </div>s
</div>
<div class="flex flex-row">
    ';
  } else {

  }
}
  echo '
<textarea class="textarea textarea-bordered" placeholder="write here your message"></textarea>
<button class="btn">send</button>
</div>
'; 
    
?>
</body>
</html>