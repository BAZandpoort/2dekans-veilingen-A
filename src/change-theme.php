<?php
session_start();
include "./connect.php";
require_once '../src/components/util.php';

if (isset($_SESSION["login"])) {
  handleTheme($_SESSION);
  return;
}

header('Location: index.php');
exit();

function handleTheme($data) {
  $gebruiker = $data['login'];

  $change_theme = fetch("SELECT * from tblgebruikers Where gebruikerid = ?",
  ['type' => 'i', 'value' => $_SESSION["login"]]);
  
  $theme = $change_theme['theme'] === 'dark' ? 'retro' : 'dark';
 
  $change_theme = insert(
    'UPDATE tblgebruikers SET theme = ? WHERE gebruikerid = ?',
    ['type' => 's', 'value' => $theme],
    ['type' => 'i', 'value' => $gebruiker],
  );
  
  var_dump($change_theme);
  $_SESSION['gebruiker']['theme'] = $theme;
  
  header('Location: index.php');
}?>