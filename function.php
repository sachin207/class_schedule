<?php


function redirect($script_name) {
    $redirect_url = 'http://' . $_SERVER['HTTP_HOST'] .
                    dirname($_SERVER['PHP_SELF']) . '/' .
                    $script_name;
    header('Location: ' . $redirect_url);
    //
    //echo "<META HTTP-EQUIV=\"Refresh\" Content=\"0; URL=$script_name\">";    
    //exit;  
  }
?>