<?php
require_once('init_page.php');

if($username != 'admin')
{
  redirect("accessdenied.php");
}

if (isset($_POST['submit'])) {
    // Grab the data from the POST
    
    $courseid = mysqli_real_escape_string($dbc, trim($_POST['courseid']));
    $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
    $credits = mysqli_real_escape_string($dbc, trim($_POST['credits']));
    $department = mysqli_real_escape_string($dbc, trim($_POST['department']));

    $form_errors = array();
    
    if (empty($courseid)) {
      $form_errors['courseid'] = '<ul><li>Please fill the Coures ID</li></ul>';
    }
    else {
      $query = "SELECT * FROM courses WHERE course_id = '$courseid'";
      $data = mysqli_query($dbc, $query) ;
      if (mysqli_num_rows($data) > 0) {
        $form_errors['courseid'] = '<ul><li>The course is already present.</li></ul>';
      }
    }
    if (empty($title)) {
      $form_errors['title'] = '<ul><li>Please fill the Course Title</li></ul>';
    }
    if (empty($credits)) {
      $form_errors['credits'] = '<ul><li>Please fill the Credits</li></ul>';
    } 
    if (empty($form_errors)) {
      $query1 = "SELECT dept_id FROM department WHERE
                dept_name = '$department'";
      $data = mysqli_query($dbc, $query1);
      if (mysqli_num_rows($data) == 1) {
        $row = mysqli_fetch_array($data);
        $query = "INSERT INTO courses
                (course_id, title, credits, dept_id)
                VALUES
                ('$courseid', '$title', '$credits', '$row[dept_id]')";
        $result = mysqli_query($dbc, $query);
        redirect('course_success.php');
      }
    }
}

$page_title='Add Course';

require_once('include_header.php');

if(!$logged_in){
  redirect('login.php');
}

?>
<br><br><br>
<br><br><br>


<div class="row  pad-top">
    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong> <center>  Add Course </center> </strong>  
            </div>
            <div class="panel-body">
            	<form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Course ID</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="courseid" name="courseid" placeholder="Course ID" value="<?php if (!empty($courseid)) echo $courseid; ?>">
    </div>
    <small style="color:red;"><br><?php 
    if(isset($form_errors['courseid']))
      echo $form_errors['courseid']; 
  ?></small>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Course Title</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php if (!empty($title)) echo $title; ?>">
    </div>
    <small style="color:red;"><br><?php 
    if(isset($form_errors['title']))
      echo $form_errors['title']; 
  ?></small>
  </div>
  
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Credits</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="credits" name="credits" placeholder="Credits" value="<?php if (!empty($credits)) echo $credits; ?>">
    </div>
    <small style="color:red;"><br><?php 
    if(isset($form_errors['credits']))
      echo $form_errors['credits']; 
  ?></small>
  </div>
  
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Department</label>
    <div class="col-sm-6">
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
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
    	<input type="submit" value="Add Course" id="submit" name="submit" class="btn btn-success "/>                 
    </div>
  </div>
</form>
            </div>
        </div>
    </div>
</div>
<?php


require_once('include_footer.php');

?>