<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@3.7.4/dist/full.css" rel="stylesheet" type="text/css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>title</title>
</head>

<body class="min-h-screen" data-theme='<?php echo $_SESSION["theme"] ?>'>
  <?php
  include "components/navbar.php";
  include "functions/chatFunctions.php";
  
  if(!isset($_SESSION["login"])){
    header('location: login.php');
  }

  if(isset($_POST["leaveChat"])){
    header('location: berichten.php');
    return;
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
  
  if (getMessages($mysqli,$chatid)) {
    foreach (getMessages($mysqli,$chatid) as $value) {
      $zenderid = $value["zenderid"];
      if ($_SESSION["login"] == $zenderid) {
        echo '
          <div class="chat chat-end">
          <div class="chat-header">';
        echo getUser($mysqli,$zenderid)[0]['voornaam'];
        echo '
            </div>
            <div class="chat-bubble">' . $value["message"] . '</div>
            <div class="chat-footer opacity-50">
            </div>
          </div>
              ';
      } else {
        echo '
          <div class="chat chat-start">
          <div class="chat-header">';
        echo getUser($mysqli,$zenderid)[0]['voornaam'];
        echo '
            </div>
            <div class="chat-bubble">' . $value["message"] . '</div>
            <div class="chat-footer opacity-50">
            </div>
          </div>
      ';
      }
    }
  }
  echo '
  <div class="flex justify-end">
    <div class="flex flex-col">
      <form method="post" action="chatSystem.php" >
        <input type="hidden" value=' . $ontvangerid . ' name="ontvangerid">

        <input type="hidden" value=' . $chatid . ' name="chatid">

        <textarea class="textarea textarea-bordered w-full" placeholder="write your message here" name="bericht"></textarea>
        <div class="flex flex-row">
          <button type="submit" class="btn m-1" name="knopVerzend">'.Vertalen('Send').'</button>
          <button type="submit" name="leaveChat" class="btn m-1">'.Vertalen('Leave').'</button>
        </div>
      </form>
    </div>
  </div>
';
  ?>
</body>

</html>