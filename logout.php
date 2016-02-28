<?php
  
  require_once('function.php');
  
  
  session_start();
  if (isset($_SESSION['user_id'])) {
    
    $_SESSION = array();

    if (isset($_COOKIE[session_name()])) {
      setcookie(session_name(), '', time() - 3600);
    }

    session_destroy();
  }

  redirect('index.php');
?>