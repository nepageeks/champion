<?php
  header('Content-Type: image/jpeg');
  include('../../inc/classes/class.simple_image.php');
  $image = new SimpleImage();
  $image->load('../../'.urldecode($_GET['image']));
  $image->resizeToWidth(150);
  $image->output();
?>