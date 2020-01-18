<?php
  session_start();

  // echo $_SESSION['userId'];

  if(!isset($_SESSION['userId'])) {
    header('location: index.php');
  } 
?>