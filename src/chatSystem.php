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
     include "connect.php"; 
     include "components/navbar.php";
    ?>
    <?php
    
    echo '
    <div class="flex flex-col">
<div class="chat chat-start">
  <div class="chat-bubble">Welcome to our live chat.</div>
  <div class="chat-footer opacity-50">
  </div>
</div>
<div class="chat chat-end">
  <div class="chat-bubble">Hi I have a question</div>
  <div class="chat-footer opacity-50">
  </div>
</div>
</div>
<div class="flex flex-row">
<textarea class="textarea textarea-bordered" placeholder="write here your message"></textarea>
<button class="btn">send</button>
</div>
'; 
?>
</body>
</html>