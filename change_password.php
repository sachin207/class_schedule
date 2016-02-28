<?php
require_once('init_page.php');

if(!$logged_in){
	redirect("login.php");
}

$page_title='Change Password';

$query = "SELECT username, password FROM users WHERE id = '$user_id'";

$result = mysqli_query($dbc, $query) ;
      // if not, redirect
  if (mysqli_num_rows($result) == 0) {
        redirect('accessdenied.php');
      }

$user = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
	$password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
    $password3 = mysqli_real_escape_string($dbc, trim($_POST['password3']));
    
    $form_errors = array();
    $field_required_string = '<ul><li>This field is required.</li></ul>';

    if (empty($password1)) {
      $form_errors['password1'] = $field_required_string;
    }
    
    else{
    	$query = "SELECT username, password FROM users WHERE id = '$user_id' AND password = SHA('$password1')";
    	
		$result = mysqli_query($dbc, $query) ;
      // if not, redirect
  		if (mysqli_num_rows($result) == 0) {
        	$form_errors['password1'] = '<ul><li>Current Password is not correct</li></ul>';
      	}
    }
    if (empty($password2)) {
      $form_errors['password2'] = $field_required_string;
    }
    else if(strlen($password1)<8){
      $form_errors['password2'] = '<ul><li>Password should have atleast 8 characters.</li></ul>';
    }
    else{
    if($password2 == $password1){
      		$form_errors['password2'] = '<ul><li>Password is same as current.</li></ul>';
    	}
    }
    if (empty($password3)) {
      $form_errors['password3'] = $field_required_string;
    } 
    else {
      if ($password2 != $password3) {
        $form_errors['password3'] = '<ul><li>Passwords do not match.</li></ul>';
      }
    }
    if (empty($form_errors)) {
    	
        $query = "UPDATE users SET password = SHA('$password2') WHERE id ='$user_id'";
        $data = mysqli_query($dbc, $query);
        redirect('index.php');
      }
    }

require_once('include_header.php');

?>

<br><br><br>
<div class="row  pad-top">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>   Change Password </strong>  
            </div>
            <div class="panel-body">
                <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"  ></i></span>
                            <input type="password" name="password1" id="password1" class="form-control" placeholder="Enter Current Password" />
                    </div>
                    <small style="color:red;"><?php 
                     if(isset($form_errors['password1']))
                      echo $form_errors['password1']; 
                    ?></small>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-check"  ></i></span>
                            <input type="password" name="password2" id="password2" class="form-control" placeholder="Enter New Password" />
                    </div>
                    <small style="color:red;"><?php 
                     if(isset($form_errors['password2']))
                      echo $form_errors['password2']; 
                    ?></small>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"  ></i></span>
                            <input type="password" name="password3" id="password3" class="form-control" placeholder="Renter New Password" />
                    </div>
                    <small style="color:red;"><?php 
                     if(isset($form_errors['password3']))
                      echo $form_errors['password3']; 
                    ?></small>                
                    <input type="submit" value="Change Password" id="submit" name="submit" class="btn btn-success "/>
                    
                </form>
            </div>                           
        </div>
    </div>
</div>

<?php
  // Display footer
  require_once('include_footer.php');
  
?>
