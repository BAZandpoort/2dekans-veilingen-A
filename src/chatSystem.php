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
    if (isset($_POST["knop"])) {
      $data3 = getChatData($mysqli); 
      foreach ($data3 as $value2) { 
        $zenderVoornaam = $value2["zenderVoornaam"]; 
        $zenderAchternaam = $value2["zenderAchternaam"];
        $ontvanger = $value2["ontvanger"];
      }
      $bericht = $_POST["bericht"]; 
      InsertIntoChatTbl($mysqli, $ontvanger, $zenderVoornaam, $zenderAchternaam, $bericht); 
      
    }
    $data = getChatData($mysqli); 
    foreach ($data as $value) {
      $data2 = getZender($mysqli, $_SESSION["login"])[0]  ; 
      $zenderVoornaam = $value["zenderVoornaam"]; 
      $zenderAchternaam = $value["zenderAchternaam"];
      $ontvanger = $value["ontvanger"];
      if (($zenderVoornaam == $data2["voornaam"])&&($zenderAchternaam == $data2["naam"])) {
       
      echo '
<div class="chat chat-start">
<div class="chat-header">';
    echo $value["zenderVoornaam"]; 
  echo'
  </div>
  <div class="chat-bubble">'.$value["bericht"].'</div>
  <div class="chat-footer opacity-50">
  </div>
</div>
    ';
  } else {
    echo '
<div class="chat chat-end">
<div class="chat-header">';
    echo $value["zenderVoornaam"]; 
  echo'
  </div>
  <div class="chat-bubble">'.$value["bericht"].'</div>
  <div class="chat-footer opacity-50">
  </div>
</div>
    ';
  }
}
  echo '
  <form method="post" action="chatSystem.php">
<textarea class="textarea textarea-bordered" placeholder="write your message here" name="bericht"></textarea>
<button type="submit" class="btn" name="knop">send</button>
</form>
</div>
';

?>
</body>
</html>