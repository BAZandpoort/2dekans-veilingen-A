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
  if (isset($_POST["knopVerwijder"])) {
    $chatid = $_POST["chatid"];
    delectechat($mysqli, $chatid);
    header("Location: overzichtVeilingen.php");
  }
  if (isset($_POST["knopVerzend"])) {
    $data3 = getZender($mysqli, $_SESSION["login"])[0];
    $zenderVoornaam = $data3["voornaam"];
    $zenderAchternaam = $data3["naam"];
    $ontvanger = $_POST["user"];
    $chatid = $_POST["chatid"];
    $ontvangerNaam = getOntvanger($mysqli, $ontvanger);
    $bericht = $_POST["bericht"];

    InsertIntoChatTbl($mysqli, $ontvangerNaam, $zenderVoornaam, $zenderAchternaam, $bericht, $chatid);
  }
  if (!empty($_GET["user"])) {
    $ontvanger = $_GET["user"];
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
      } else {
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
      }
    }
  }

  echo '
  <form method="post" action="chatSystem.php">
  <input type="hidden" value="' . $ontvanger . '" name="user">
  
  <input type="hidden" value=' . $chatid . ' name="chatid">
<div class="flex flex-col">
  <textarea class="textarea textarea-bordered w-1/4" placeholder="write your message here" name="bericht"></textarea>
  <div class="flex flex-row">
    <button type="submit" class="btn m-1" name="knopVerzend">verzenden</button>
    <button type="submit" class="btn m-1" name="knopVerwijder">chat verwijderen</button>
  </div>
</div>
</form>
</div>
';
  ?>
</body>

</html>