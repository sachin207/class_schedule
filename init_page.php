<?php
  // DB connection
  require_once('function.php');
  require_once('connection.php');
  error_reporting(0);
   
  // Utility 
  //TODO
  //require_once('utils.php');
 
  // Session management
  session_start();
  
  
  $logged_in = isset($_SESSION['user_id']);
  if ($logged_in) {
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
  }
?>