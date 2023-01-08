<?php 
  include_once "db/db.php";
  include_once "models/Image.php";
  include_once "header.php";

  $db = new Database();
  $conn = $db->connect();

  $image = new Image($conn);
  $images = $image->getAll();

  include_once "album.php";
?>

