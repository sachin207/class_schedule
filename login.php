<?php

require_once 'init_page.php';

if($logged_in){
  redirect('index.php');
}

if (isset($_POST['submit'])) {
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
    
    // Validate form data
    $form_errors = array();
    $login_error = '<ul><li>Your username and password didn\'t match.</li></ul>';
    
    if (empty($username) or (empty($password))) {
      $form_errors['login'] = $login_error;
    } else {
      $query = "SELECT id, username FROM users WHERE
                username = '$username' AND password = SHA('$password')";
                
      $data = mysqli_query($dbc, $query);

      if (mysqli_num_rows($data) == 1) {

        $row = mysqli_fetch_array($data);

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        redirect('index.php');
      } else {
        $form_errors['login'] = $login_error;
      }
    }
  }
$page_title='Login';

require_once('include_header.php');

?>
<br><br><br><br><br><br>
<div class="row  pad-top">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>   Login Yourself </strong>  
            </div>
            <div class="panel-body">
                <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"  ></i></span>
                        <input type="text" class="form-control" name="username" id="username"  value="<?php if (!empty($username)) echo $username; ?>" placeholder="Your Username" />
                    </div>
                    
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"  ></i></span>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" />
                    </div>
                    <small style="color:red;">  <?php 
                     if(isset($form_errors['login']))
                      echo $form_errors['login']; 
                    ?></small>
                    <input type="submit" value="Login" id="submit" name="submit" class="btn btn-success "/>
                    <hr />
                    Not Registered ?  <a href="register.php" >Register here</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
  // Display footer
  require_once('include_footer.php');
  
?>