<?php
require_once('init_page.php');

$query = "SELECT first_name, last_name, username, email, users.dept_id, dept_name, cabin_no, phone FROM users, department WHERE id = '$user_id' AND users.dept_id = department.dept_id";
$data = mysqli_query($dbc, $query) ;
$user = mysqli_fetch_assoc($data);

$page_title='Home';

if(!$logged_in){
	redirect("login.php");
}

require_once('include_header.php');

?>
<div class="container">
      <div class="row">
      	<br><br><br>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo $user['first_name'] ." ". $user['last_name'] ?></h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="img/photo.png" class="img-circle"> </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Department:</td>
                        <td><?php echo $user['dept_name'] ?></td>
                      </tr>
                      <tr>
                        <td>Username</td>
                        <td><?php echo $user['username'] ?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><a href="mailto:<?php echo $user['email'] ?>"><?php echo $user['email'] ?></a></td>
                      </tr>
                      <tr>
                        <td>Cabin No.</td>
                        <td><?php echo $user['cabin_no'] ?></td>
                      </tr>
                      <tr>
                        <td>Phone No.</td>
                        <td><?php echo $user['phone'] ?></td>
                        </tr>
                     
                    </tbody>
                  </table>
                  
                  <a href="my_course.php" class="btn btn-primary">View My Courses</a>
                  <a href="add_section.php" class="btn btn-primary">Offer Course</a>
                  </div>
              </div>
            </div>
                 <div class="panel-footer">
                        <a href="change_password.php" data-original-title="Change Password" data-toggle="tooltip" type="button" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-lock"></i></a>
                        <span class="pull-right">
                            <a href="edit_profile.php" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>
                        </span>
                    </div>
            
          </div>
        </div>
      </div>
    </div>
<?php

require_once('include_footer.php');

?>
