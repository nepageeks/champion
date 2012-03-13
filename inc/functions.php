<?php
include('./config.php');

$action = $_GET['f'];
$todayDate = date('Y-m-d H:i:s');

switch ($action)
  {
    default:
      exit;
      break;
  }

header("Location: $URL");

include('./closedb.php');
?>