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
  
  if(!isset($_SESSION["login"])){
    header('location: login.php');
  }

  if (isset($_POST["knopVerzend"])) {
    $ontvangerid = $_POST["ontvangerid"];
    $chatid = $_POST["chatid"];
    $message = $_POST["bericht"];
    createMessage($mysqli,$chatid,$_SESSION["login"],$ontvangerid,$message);
  }
  
  if (isset($_GET["user"])) {
    $ontvangerid = $_GET["user"];
  }
  
  if (isset($_GET["chatid"])) {
    $chatid = $_GET["chatid"];
  }
  
  $data = getChatData($mysqli, $chatid);
  if ($data) {
    foreach ($data as $value) {
      $data2 = getZender($mysqli, $_SESSION["login"])[0];
      $zenderVoornaam = $value["zenderVoornaam"];
      $zenderAchternaam = $value["zenderAchternaam"];
      if (($zenderVoornaam == $data2["voornaam"]) && ($zenderAchternaam == $data2["naam"])) {
        echo '
          <div class="chat chat-end">
          <div class="chat-header">';
        echo $value["zenderVoornaam"];
        echo '
            </div>
            <div class="chat-bubble">' . $value["bericht"] . '</div>
            <div class="chat-footer opacity-50">
            </div>
          </div>
              ';
      } else {
        echo '
          <div class="chat chat-start">
          <div class="chat-header">';
        echo $value["zenderVoornaam"];
        echo '
            </div>
            <div class="chat-bubble">' . $value["bericht"] . '</div>
            <div class="chat-footer opacity-50">
            </div>
          </div>
      ';
      }
    }
  }
  echo '
  <form method="post" action="chatSystem.php">
  <input type="hidden" value=' . $ontvangerid . ' name="ontvangerid">
  
  <input type="hidden" value=' . $chatid . ' name="chatid">
<div class="flex justify-end flex-col">
  <textarea class="textarea textarea-bordered w-1/4" placeholder="write your message here" name="bericht"></textarea>
  <div class="flex flex-row">
    <button type="submit" class="btn m-1" name="knopVerzend">verzenden</button>
  </div>
</div>
</form>
</div>
';
  ?>
</body>

</html>