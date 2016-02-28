<?php

require_once('init_page.php');

if($logged_in){
  redirect('index.php');
}

if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    
    $first_name = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
    $last_name = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    $department = mysqli_real_escape_string($dbc, trim($_POST['department']));
    $cabin_no = mysqli_real_escape_string($dbc, trim($_POST['cabin_no']));
    $phone = mysqli_real_escape_string($dbc, trim($_POST['phone']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
    
    $form_errors = array();
    $field_required_string = '<ul><li>This field is required.</li></ul>';
    
    if (empty($first_name)) {
      $form_errors['first_name'] = $field_required_string;
    }
    if (empty($last_name)) {
      $form_errors['last_name'] = $field_required_string;
    }
    if (empty($username)) {
      $form_errors['username'] = $field_required_string;
    } 
    else {
      $query = "SELECT * FROM users WHERE username = '$username'";
      $data = mysqli_query($dbc, $query) ;
      if (mysqli_num_rows($data) > 0) {
        $form_errors['username'] =
          '<ul><li>Username is already taken.</li></ul>';
      }
    }
    if (empty($email)) {
      $form_errors['email'] = $field_required_string;
    }
    if (empty($department)) {
      $form_errors['department'] = $field_required_string;
    } 
    else if (!preg_match('/^[a-zA-Z0-9][a-zA-Z0-9\._\-&!?=#]*@/', $email)) {
        $form_errors['email'] = '<ul><li>Enter a valid e-mail address.</li></ul>';
    }
    else {
      $query = "SELECT * FROM users WHERE email = '$email'";
      $data = mysqli_query($dbc, $query) ;
      if (mysqli_num_rows($data) > 0) {
        $form_errors['email'] =
          '<ul><li>Email is already registered.</li></ul>';
      } 
    }
    if (empty($password1)) {
      $form_errors['password1'] = $field_required_string;
    }
    else if(strlen($password1)<8){
      $form_errors['password1'] = '<ul><li>Password should have atleast 8 characters.</li></ul>';
    }
    if (empty($password2)) {
      $form_errors['password2'] = $field_required_string;
    } else {
      if ($password1 != $password2) {
        $form_errors['password2'] = '<ul><li>Passwords do not match.</li></ul>';
      }
    }
    if (empty($form_errors)) {
      $query1 = "SELECT dept_id FROM department WHERE
                dept_name = '$department'";
      $data = mysqli_query($dbc, $query1);

      if (mysqli_num_rows($data) == 1) {
        $row = mysqli_fetch_array($data);
        $query = "INSERT INTO users
                (first_name, last_name, username, email, password, dept_id, cabin_no, phone)
                VALUES
                ('$first_name', '$last_name', '$username', '$email',
                 SHA('$password1'), '$row[dept_id]', '$cabin_no', '$phone')";
        $result = mysqli_query($dbc, $query);

      // Log in the newly-registered user
        $_SESSION['user_id'] = mysqli_insert_id($dbc);
        $_SESSION['username'] = $username;
   
      // Redirect to 'registration successful' page
        redirect('index.php');
      }
    }
}

$page_title='Registration';

require_once('include_header.php');


?>
<br><br><br>
<div class="row  pad-top">
    <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>   Register Yourself </strong>  
            </div>
            <div class="panel-body">
                <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="form-group input-group">

                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"  ></i></span>
                            <input type="text" class="form-control" id="first_name" name="first_name"placeholder="First Name" value="<?php if (!empty($first_name)) echo $first_name; ?>" />
                    </div>
                    <small style="color:red;"><?php 
                     if(isset($form_errors['first_name']))
                      echo $form_errors['first_name']; 
                    ?></small>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"  ></i></span>
                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?php if (!empty($last_name)) echo $last_name; ?>" />
                    </div>
                    <small style="color:red;"><?php 
                     if(isset($form_errors['last_name']))
                      echo $form_errors['last_name']; 
                    ?></small>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-tag"  ></i></span>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Desired Username" value="<?php if (!empty($username)) echo $username; ?>" />
                    </div>
                    <small style="color:red;"><?php 
                     if(isset($form_errors['username']))
                      echo $form_errors['username']; 
                    ?></small>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"  ></i></span>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Your Email" value="<?php if (!empty($email)) echo $email; ?>" />
                    </div>
                    <small style="color:red;">  <?php 
                     if(isset($form_errors['email']))
                      echo $form_errors['email']; 
                    ?></small>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-info-sign"  ></i></span>
                            <select class="form-control" id="department" name="department" placeholder="Department" value="<?php if (!empty($department)) echo $department; ?>" >
                            <option <?php if (!empty($department)){if($department=='Biomedical Engineering'){?>selected="selected"<?php }} ?>>Biomedical Engineering</option>
                            <option <?php if (!empty($department)){if($department=='Biotechnology'){?>selected="selected"<?php }} ?>>Biotechnology</option>
                            <option <?php if (!empty($department)){if($department=='Chemical Engineering'){?>selected="selected"<?php }} ?>>Chemical Engineering</option>
                            <option <?php if (!empty($department)){if($department=='Chemistry'){?>selected="selected"<?php }} ?>>Chemistry</option>
                            <option <?php if (!empty($department)){if($department=='Civil Engineering'){?>selected="selected"<?php }} ?>>Civil Engineering</option>
                            <option <?php if (!empty($department)){if($department=='Computer Science and Engineering'){?>selected="selected"<?php }} ?>>Computer Science and Engineering</option>
                            <option <?php if (!empty($department)){if($department=='Design'){?>selected="selected"<?php }} ?>>Design</option>
                            <option <?php if (!empty($department)){if($department=='Electrical Engineering'){?>selected="selected"<?php }} ?>>Electrical Engineering</option>
                            <option <?php if (!empty($department)){if($department=='Engineering Science'){?>selected="selected"<?php }} ?>>Engineering Science</option>
                            <option <?php if (!empty($department)){if($department=='Liberal Arts'){?>selected="selected"<?php }} ?>>Liberal Arts</option>
                            <option <?php if (!empty($department)){if($department=='Materials Science and Metallurgical Engineering'){?>selected="selected"<?php }} ?>>Materials Science and Metallurgical Engineering</option>
                            <option <?php if (!empty($department)){if($department=='Mathematics'){?>selected="selected"<?php }} ?>>Mathematics</option>
                            <option <?php if (!empty($department)){if($department=='Mechanical Engineering'){?>selected="selected"<?php }} ?>>Mechanical Engineering</option>
                            <option <?php if (!empty($department)){if($department=='Physics'){?>selected="selected"<?php }} ?>>Physics</option>
                            <option <?php if (!empty($department)){if($department=='FCC'){?>selected="selected"<?php }} ?>>FCC</option>
                            <option <?php if (!empty($department)){if($department=='Others'){?>selected="selected"<?php }} ?>>Others</option>

                          </select>
                    </div>
                    <small style="color:red;">  <?php 
                     if(isset($form_errors['department']))
                      echo $form_errors['department']; 
                    ?></small>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-home"  ></i></span>
                            <input type="text" class="form-control" id="cabin_no" name="cabin_no" placeholder="Cabin No" value="<?php if (!empty($cabin_no)) echo $cabin_no; ?>" />
                    </div>
                    
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"  ></i></span>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" value="<?php if (!empty($phone)) echo $phone; ?>" />
                    </div>
                    
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"  ></i></span>
                            <input type="password" name="password1" id="password1" class="form-control" placeholder="Enter Password" />
                    </div>
                    <small style="color:red;"><?php 
                     if(isset($form_errors['password1']))
                      echo $form_errors['password1']; 
                    ?></small>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-check"  ></i></span>
                            <input type="password" name="password2" id="password2" class="form-control" placeholder="Retype Password" />
                    </div>
                    <small style="color:red;"><?php 
                     if(isset($form_errors['password2']))
                      echo $form_errors['password2']; 
                    ?></small>                
                    <input type="submit" value="Register" id="submit" name="submit" class="btn btn-success "/>
                    <hr />
                    Already Registered ?  <a href="login.php" >Login here</a>
                </form>
            </div>                           
        </div>
    </div>
</div>

<?php
  // Display footer
  require_once('include_footer.php');
  
?>