<?php
require_once('init_page.php');

$page_title='Edit Course';

if(!$logged_in){
  redirect('login.php');
}

if (isset($_POST['submit'])) {
    $section_id = $_SESSION['section_id'];
  } else {
    $section_id = $_GET['section_id'];
  }

$query = "SELECT * FROM section WHERE
                id = '$section_id' and user_id = '$user_id'";
              

$result = mysqli_query($dbc, $query) ;
      // if not, redirect
  if (mysqli_num_rows($result) == 0) {
        redirect('accessdenied.php');
      }

$section = mysqli_fetch_assoc($result);

$query = "SELECT * FROM timeslot WHERE section_id = '$section_id' ";

$data = mysqli_query($dbc, $query);
$i=1;
if (mysqli_num_rows($data) > 0) {
    while($r = mysqli_fetch_assoc($data)) {
      ${"timeslot" . $i}='on';
      ${"room" . $i}=$r['room_no'];
      ${"start" . $i}=$r['start_time'];
      ${"end" . $i}=$r['end_time'];
      ${"day" . $i}=$r['day'];
      $i++;
  }
}

if (isset($_POST['submit'])) {
    // Grab the data from the POST
  
  $courseid = mysqli_real_escape_string($dbc, trim($_POST['course_se']));
  $semester = mysqli_real_escape_string($dbc, trim($_POST['semester']));
  $query = "SELECT * FROM courses WHERE (dept_id = '15' OR dept_id = '16') AND course_id = '$courseid'";
  $data = mysqli_query($dbc, $query) ;
  if(mysqli_num_rows($data) == 0)
  {
  $query = "SELECT * FROM courses,users WHERE courses.dept_id = users.dept_id AND course_id = '$courseid' AND id = '$user_id' ";
  $data = mysqli_query($dbc, $query) ;
  if (mysqli_num_rows($data) == 0) {
        redirect('course_access.php');
        exit();
      }
    }
  if ($semester == "Spring-1" || $semester == "Spring-2" || $semester == "Spring-3")
  {
    $sem = 1;
  }
  if ($semester == "Fall-1" || $semester == "Fall-2" || $semester == "Fall-3" )
  {
    $sem = 2;
  }
  if ($semester == "Spring")
  {
    $sem = 3;
  }
  if ($semester == "Fall")
  {
    $sem = 4;
  }

  $year = mysqli_real_escape_string($dbc, trim($_POST['year']));
  $student = mysqli_real_escape_string($dbc, trim($_POST['student']));


  $form_errors = array();
    
    if(empty($courseid)){
      $form_errors['courseid']= '<ul style="margin-left:130px"><li>Please fill the Course Id</li></ul>';
    } 
    else {
      $query = "SELECT * FROM courses WHERE course_id = '$courseid'";
      $data = mysqli_query($dbc, $query) ;
      if (mysqli_num_rows($data) != 1) {
        $form_errors['courseid'] = '<ul style="margin-left:130px"><li>The course is not present to be offered.</li></ul>';
      }
      $query = "SELECT * FROM section WHERE id != '$section_id' AND course_id = '$courseid' AND semester = '$semester' AND year ='$year' ";
      $data = mysqli_query($dbc, $query) ;
      if (mysqli_num_rows($data) > 0) {
        $form_errors['courseid'] = '<ul style="margin-left:130px"><li>The course is already offered.</li></ul>';
      }
    }
    if (empty($year)) {
      $form_errors['year'] = '<ul style="margin-left:130px"><li>Please fill the year</li></ul>';
    }
    if(empty($student)){
      $form_errors['student'] = '<ul style="margin-left:130px"><li>Please fill the year</li></ul>';
    }
    if(isset($_POST['timeslot1'])){ 
    $timeslot1 = 'on';   
    $room1 = mysqli_real_escape_string($dbc, trim($_POST['room1']));
    $day1 = mysqli_real_escape_string($dbc, trim($_POST['day1']));
    $start1 = mysqli_real_escape_string($dbc, trim($_POST['start1']));
    $end1 = mysqli_real_escape_string($dbc, trim($_POST['end1']));
    $start1 = date('H:i:s', strtotime($start1));
    $end1 = date('H:i:s', strtotime($end1));
    if(empty($room1))
    {
      $form_errors['timeslot1'] = '<ul style="margin-left:130px"><li>Please fill details of Time Slot 1</li></ul>';
    }
    if($start1 == $end1)
    {
      $form_errors['timeslot1'] = '<ul style="margin-left:130px"><li>Start and End Time are same.</li></ul>';

    }
    if(($start1 > $end1) )
    {
      $form_errors['timeslot1'] = '<ul style="margin-left:130px"><li>Start and End Time are not proper.</li></ul>';
    }
    if($sem==1)
    {
    $query = "SELECT * FROM timeslot,section WHERE section.id =timeslot.section_id AND year='$year' AND (semester='$semester' OR semester='Spring') AND section_id!='$section_id' AND day='$day1' AND room_no='$room1' AND (start_time='$start1' OR end_time='$end1')";

    $data = mysqli_query($dbc, $query) ;
      if (mysqli_num_rows($data) > 0) {
        $form_errors['timeslot1'] = '<ul style="margin-left:130px"><li>Time Slot 1 conflit with other courses.</li></ul>';
      }
    }
    else if($sem==2)
    {
      $query = "SELECT * FROM timeslot,section WHERE section.id =timeslot.section_id AND year='$year' AND (semester='$semester' OR semester='Fall') AND section_id!='$section_id' AND day='$day1' AND room_no='$room1' AND (start_time='$start1' OR end_time='$end1')";

    $data = mysqli_query($dbc, $query) ;
      if (mysqli_num_rows($data) > 0) {
        $form_errors['timeslot1'] = '<ul style="margin-left:130px"><li>Time Slot 1 conflit with other courses.</li></ul>';
      }
    }
    else if($sem == 3)
    {
      $query = "SELECT * FROM timeslot,section WHERE section.id =timeslot.section_id AND year='$year' AND (semester='$semester' OR semester='Spring-1' OR semester='Spring-2' OR semester ='Spring-3') AND section_id!='$section_id' AND day='$day1' AND room_no='$room1' AND (start_time='$start1' OR end_time='$end1')";

    $data = mysqli_query($dbc, $query) ;
      if (mysqli_num_rows($data) > 0) {
        $form_errors['timeslot1'] = '<ul style="margin-left:130px"><li>Time Slot 1 conflit with other courses.</li></ul>';
      }
    }
    else
    {
      $query = "SELECT * FROM timeslot,section WHERE section.id =timeslot.section_id AND year='$year' AND (semester='$semester' OR semester='Fall-1' OR semester='Fall-2' OR semester ='Fall-3') AND section_id!='$section_id' AND day='$day1' AND room_no='$room1' AND (start_time='$start1' OR end_time='$end1')";

    $data = mysqli_query($dbc, $query) ;
      if (mysqli_num_rows($data) > 0) {
        $form_errors['timeslot1'] = '<ul style="margin-left:130px"><li>Time Slot 1 conflit with other courses.</li></ul>';
      }
    }
  }
  if(isset($_POST['timeslot2'])){
    $timeslot2 = 'on';
    $room2 = mysqli_real_escape_string($dbc, trim($_POST['room2']));
    $day2 = mysqli_real_escape_string($dbc, trim($_POST['day2']));
    $start2 = mysqli_real_escape_string($dbc, trim($_POST['start2']));
    $end2 = mysqli_real_escape_string($dbc, trim($_POST['end2']));
    $start2 = date('H:i:s', strtotime($start2));
    $end2 = date('H:i:s', strtotime($end2));

    if(empty($room2))
    {
      $form_errors['timeslot2'] = '<ul style="margin-left:130px"><li>Please fill details of Time Slot 2</li></ul>';
    }
    if($start2 == $end2)
    {
      $form_errors['timeslot2'] = '<ul style="margin-left:130px"><li>Start and End Time are same.</li></ul>';
    }
    if(($start2 > $end2))
    {
      $form_errors['timeslot2'] = '<ul style="margin-left:130px"><li>Start and End Time are not proper.</li></ul>';
    }
    if ($day2==$day1 && (($start2==$start1 || $end2==$end1) || ($start1<$end2 AND $end1>$start2))) {
      $form_errors['timeslot2'] = '<ul style="margin-left:130px"><li>The Time Slot 2 conflicts with other Time Slots .</li></ul>';
    }
    if($sem==1){
    $query = "SELECT * FROM timeslot,section WHERE section.id =timeslot.section_id AND year='$year' AND (semester='$semester' OR semester='Spring') AND section_id!='$section_id' AND day='$day2' AND room_no='$room2' AND (start_time='$start2' OR end_time='$end2')";
    $data = mysqli_query($dbc, $query) ;
      if (mysqli_num_rows($data) > 0) {
        $form_errors['timeslot2'] = '<ul style="margin-left:130px"><li>Time Slot 2 conflit with other courses.</li></ul>';
      }
    }
    else if($sem==2){
      $query = "SELECT * FROM timeslot,section WHERE section.id =timeslot.section_id AND year='$year' AND (semester='$semester' OR semester='Fall') AND section_id!='$section_id' AND day='$day2' AND room_no='$room2' AND (start_time='$start2' OR end_time='$end2')";
    $data = mysqli_query($dbc, $query) ;
      if (mysqli_num_rows($data) > 0) {
        $form_errors['timeslot2'] = '<ul style="margin-left:130px"><li>Time Slot 2 conflit with other courses.</li></ul>';
      }
    }
    else if($sem==3){
      $query = "SELECT * FROM timeslot,section WHERE section.id =timeslot.section_id AND year='$year' AND (semester='$semester' OR semester='Spring-1' OR semester='Spring-2' OR semester ='Spring-3') AND section_id!='$section_id' AND day='$day2' AND room_no='$room2' AND (start_time='$start2' OR end_time='$end2')";
    $data = mysqli_query($dbc, $query) ;
      if (mysqli_num_rows($data) > 0) {
        $form_errors['timeslot2'] = '<ul style="margin-left:130px"><li>Time Slot 2 conflit with other courses.</li></ul>';
      }
    }
    else {
      $query = "SELECT * FROM timeslot,section WHERE section.id =timeslot.section_id AND year='$year' AND (semester='$semester' OR semester='Fall-1' OR semester='Fall-2' OR semester ='Fall-3') AND section_id!='$section_id' AND day='$day2' AND room_no='$room2' AND (start_time='$start2' OR end_time='$end2')";
    $data = mysqli_query($dbc, $query) ;
      if (mysqli_num_rows($data) > 0) {
        $form_errors['timeslot2'] = '<ul style="margin-left:130px"><li>Time Slot 2 conflit with other courses.</li></ul>';
      }
    }

  }
  if(isset($_POST['timeslot3'])){
    $timeslot3 = 'on';
    $room3 = mysqli_real_escape_string($dbc, trim($_POST['room3']));
    $day3 = mysqli_real_escape_string($dbc, trim($_POST['day3']));
    $start3 = mysqli_real_escape_string($dbc, trim($_POST['start3']));
    $end3 = mysqli_real_escape_string($dbc, trim($_POST['end3']));
    $start3 = date('H:i:s', strtotime($start3));
    $end3 = date('H:i:s', strtotime($end3));
    if(empty($room3))
    {
      $form_errors['timeslot3'] = '<ul style="margin-left:130px"><li>Please fill details of Time Slot 3</li></ul>';
    }
    if($start3 == $end3)
    {
      $form_errors['timeslot3'] = '<ul style="margin-left:130px"><li>Start and End Time are same.</li></ul>';
    }
if(($start3 > $end3))
    {
      $form_errors['timeslot3'] = '<ul style="margin-left:130px"><li>Start and End Time are not proper.</li></ul>';
    }
    if (($day3==$day1 && (($start3==$start1 || $end3==$end1)|| ($start1<$end3 AND $end1>$start3)))||($day3==$day1 && (($start3==$start1 || $end3==$end1) || ($start2<$end3 AND $end2>$start3)))) {
      $form_errors['timeslot3'] = '<ul style="margin-left:130px"><li>The Time Slot 3 conflicts with other Time Slot .</li></ul>';
    }
    if($sem==1){
    $query = "SELECT * FROM timeslot,section WHERE section.id =timeslot.section_id AND year='$year' AND (semester='$semester' OR semester='Spring') AND section_id != '$section_id' AND day ='$day3' room_no='$room3' AND (start_time='$start3' OR end_time='$end3')";
    $data = mysqli_query($dbc, $query) ;
      if (mysqli_num_rows($data) > 0) {
        $form_errors['timeslot3'] = '<ul style="margin-left:130px"><li>Time Slot 3 conflit with other courses.</li></ul>';
      }
    }
    else if($sem==2){
    $query = "SELECT * FROM timeslot,section WHERE section.id =timeslot.section_id AND year='$year' AND (semester='$semester' OR semester='Fall') AND section_id != '$section_id' AND day ='$day3' room_no='$room3' AND (start_time='$start3' OR end_time='$end3')";
    $data = mysqli_query($dbc, $query) ;
      if (mysqli_num_rows($data) > 0) {
        $form_errors['timeslot3'] = '<ul style="margin-left:130px"><li>Time Slot 3 conflit with other courses.</li></ul>';
      }
    }
    else if($sem==3){
    $query = "SELECT * FROM timeslot,section WHERE section.id =timeslot.section_id AND year='$year' AND (semester='$semester' OR semester='Spring-1' OR semester='Spring-2' OR semester='Spring-3') AND section_id != '$section_id' AND day ='$day3' room_no='$room3' AND (start_time='$start3' OR end_time='$end3')";
    $data = mysqli_query($dbc, $query) ;
      if (mysqli_num_rows($data) > 0) {
        $form_errors['timeslot3'] = '<ul style="margin-left:130px"><li>Time Slot 3 conflit with other courses.</li></ul>';
      }
    }
    else{
    $query = "SELECT * FROM timeslot,section WHERE section.id =timeslot.section_id AND year='$year' AND (semester='$semester' OR semester='Fall-1' OR semester='Fall-2' OR semester='Fall-3') AND section_id != '$section_id' AND day ='$day3' room_no='$room3' AND (start_time='$start3' OR end_time='$end3')";
    $data = mysqli_query($dbc, $query) ;
      if (mysqli_num_rows($data) > 0) {
        $form_errors['timeslot3'] = '<ul style="margin-left:130px"><li>Time Slot 3 conflit with other courses.</li></ul>';
      }
    }
  }
    if (empty($form_errors)) {
      $query = "UPDATE section SET
                course_id = '$courseid', semester = '$semester', year = '$year', student = '$student'
                WHERE id= '$section_id' ";
      
      $result = mysqli_query($dbc, $query);
      $query = "DELETE FROM timeslot WHERE section_id = '$section_id'";
      $result = mysqli_query($dbc, $query);

      if(isset($timeslot1)){
        $query = "INSERT INTO timeslot 
                (section_id, start_time, end_time, room_no, day)
                VALUES
                ('$section_id','$start1','$end1','$room1','$day1') ";
        $result = mysqli_query($dbc, $query);

      }
      if(isset($timeslot2)){
        $query = "INSERT INTO timeslot 
                (section_id, start_time, end_time, room_no, day)
                VALUES
                ('$section_id','$start2','$end2','$room2','$day2') ";
      $result = mysqli_query($dbc, $query);
      }
      if(isset($timeslot3)){
        $query = "INSERT INTO timeslot 
                (section_id, start_time, end_time, room_no, day)
                VALUES
                ('$section_id','$start3','$end3','$room3','$day3') ";
      $result = mysqli_query($dbc, $query);
      }
      $_SESSION['section_id'] = $section_id;
      redirect('edit_success.php');
    }
}

else{

  $courseid = $section['course_id'];
  $semester = $section['semester'];
  $year = $section['year'];
  $student = $section['student'];
  $_SESSION['section_id'] = $section_id;

}

require_once('include_header.php');

?>
<br><br><br>
<br><br><br>


<div class="row  pad-top">
    <div class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong> <center>  Edit Course Offered </center> </strong>  
            </div>
            <div class="panel-body">
              <form class="form-horizontal" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Course ID</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="course_title_se" name="course_se" placeholder="Course ID" value="<?php if (!empty($courseid)) echo $courseid; ?>" onkeyup="course_title()">
      <div style="position:fixed;z-index:10;background-color:white;">
      <ul id="course_title_list_id"></ul>
    </div>
    </div>
  </div>
  <strong style="color:red;margin-left:130px;"><br><?php 
    if(isset($form_errors['courseid']))
      echo $form_errors['courseid']; 
  ?></strong>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Semester</label>
    <div class="col-sm-6">
      <select class="form-control" id="semester" name="semester" placeholder="Semester" value="<?php if (!empty($semester)) echo $semester; ?>">
        <option <?php if (!empty($semester)){if($semester=='Spring'){?>selected="selected"<?php }} ?>>Spring</option>
        <option <?php if (!empty($semester)){if($semester=='Spring-1'){?>selected="selected"<?php }} ?>>Spring-1</option>
        <option <?php if (!empty($semester)){if($semester=='Spring-2'){?>selected="selected"<?php }} ?>>Spring-2</option>
        <option <?php if (!empty($semester)){if($semester=='Spring-3'){?>selected="selected"<?php }} ?>>Spring-3</option>
        <option <?php if (!empty($semester)){if($semester=='Fall'){?>selected="selected"<?php }} ?>>Fall</option>
        <option <?php if (!empty($semester)){if($semester=='Fall-1'){?>selected="selected"<?php }} ?>>Fall-1</option>
        <option <?php if (!empty($semester)){if($semester=='Fall-2'){?>selected="selected"<?php }} ?>>Fall-2</option>
        <option <?php if (!empty($semester)){if($semester=='Fall-3'){?>selected="selected"<?php }} ?>>Fall-3</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Year</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="year" name="year" placeholder="Year" value="<?php if (!empty($year)) echo $year; ?>">
    </div>
    
  </div>
  <strong style="color:red;margin-left:130px;"><br><?php 
    if(isset($form_errors['year']))
      echo $form_errors['year']; 
  ?></strong>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Student En-roll</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="student" name="student" placeholder="Student En-roll" value="<?php if (!empty($student)) echo $student; ?>" >
    </div>
    
  </div>
  <strong style="color:red;margin-left:130px;"><br><?php 
    if(isset($form_errors['student']))
      echo $form_errors['student']; 
  ?></strong>
  <div class="form-group" id="timeslot_1">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" id="timeslot1" name="timeslot1" class="timeslot1" value="<?php if (!empty($timeslot1)) echo $timeslot1; ?>" <?php if (!empty($timeslot1)){if($timeslot1=='on'){?>checked="checked"<?php }} ?>> Time Slot 1
        </label>
      </div>
    </div>
  </div>
  <strong style="color:red;margin-left:130px;"><br><?php 
    if(isset($form_errors['timeslot1']))
      echo $form_errors['timeslot1']; 
  ?></strong>

  <div class="form-group" id="room_1" style="display:none">
    <label for="inputPassword3" class="col-sm-2 control-label">Room No.</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="room1" name="room1" placeholder="Room No." value="<?php if (!empty($room1)) echo $room1; ?>">
    </div>
    </div>
  <div class="form-group" id="day_1" style="display:none">
    <label for="inputPassword3" class="col-sm-2 control-label">Day</label>
    <div class="col-sm-6">
      <select class="form-control" id="day1" name="day1" placeholder="Day" value="<?php if (!empty($day1)) echo $day1; ?>">
        <option <?php if (!empty($day1)){if($day1=='Monday'){?>selected="selected"<?php }} ?>>Monday</option>
        <option <?php if (!empty($day1)){if($day1=='Tuesday'){?>selected="selected"<?php }} ?>>Tuesday</option>
        <option <?php if (!empty($day1)){if($day1=='Wednesday'){?>selected="selected"<?php }} ?>>Wednesday</option>
        <option <?php if (!empty($day1)){if($day1=='Thrusday'){?>selected="selected"<?php }} ?>>Thrusday</option>
        <option <?php if (!empty($day1)){if($day1=='Friday'){?>selected="selected"<?php }} ?>>Friday</option>
      </select>
    </div>
  </div>
  <div class="form-group" id="start_1" style="display:none">
    <label for="inputPassword3" class="col-sm-2 control-label">Start Time</label>
    <div class="col-sm-6">
      <select class="form-control" id="start1" name="start1" placeholder="Start Time" value="<?php if (!empty($start1)) echo $start1; ?>">
        <option <?php if (!empty($start1)){if($start1=='08:30:00'){?>selected="selected"<?php }} ?>>08:30 AM</option>
        <option <?php if (!empty($start1)){if($start1=='10:00:00'){?>selected="selected"<?php }} ?>>10:00 AM</option>
        <option <?php if (!empty($start1)){if($start1=='11:30:00'){?>selected="selected"<?php }} ?>>11:30 AM</option>
        <option <?php if (!empty($start1)){if($start1=='14:30:00'){?>selected="selected"<?php }} ?>>02:30 PM</option>
        <option <?php if (!empty($start1)){if($start1=='16:00:00'){?>selected="selected"<?php }} ?>>04:00 PM</option>
        <option <?php if (!empty($start1)){if($start1=='17:30:00'){?>selected="selected"<?php }} ?>>05:30 PM</option>
        <option <?php if (!empty($start1)){if($start1=='19:00:00'){?>selected="selected"<?php }} ?>>07:00 PM</option>
      </select>
    </div>
  </div>
  <div class="form-group" id="end_1" style="display:none">
    <label for="inputPassword3" class="col-sm-2 control-label">End Time</label>
    <div class="col-sm-6">
      <select class="form-control" id="end1" name="end1" placeholder="End Time" value="<?php if (!empty($end1)) echo $end1; ?>" >
        <option <?php if (!empty($end1)){if($end1=='10:00:00'){?>selected="selected"<?php }} ?>>10:00 AM</option>
        <option <?php if (!empty($end1)){if($end1=='11:30:00'){?>selected="selected"<?php }} ?>>11:30 AM</option>
        <option <?php if (!empty($end1)){if($end1=='13:00:00'){?>selected="selected"<?php }} ?>>01:00 PM</option>
        <option <?php if (!empty($end1)){if($end1=='16:00:00'){?>selected="selected"<?php }} ?>>04:00 PM</option>
        <option <?php if (!empty($end1)){if($end1=='17:30:00'){?>selected="selected"<?php }} ?>>05:30 PM</option>
        <option <?php if (!empty($end1)){if($end1=='19:00:00'){?>selected="selected"<?php }} ?>>07:00 PM</option>
        <option <?php if (!empty($end1)){if($end1=='20:30:00'){?>selected="selected"<?php }} ?>>08:30 PM</option>
      </select>
    </div>
  </div>

  <div class="form-group" id="timeslot_2" style="display:none">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" id="timeslot2" name="timeslot2" class="timeslot2" value="<?php if (!empty($timeslot2)) echo $timeslot2; ?>" <?php if (!empty($timeslot2)){if($timeslot2=='on'){?>checked="checked"<?php }} ?>> Time Slot 2
        </label>
      </div>
    </div>
  </div>
  <strong style="color:red;margin-left:130px;"><br><?php 
    if(isset($form_errors['timeslot2']))
      echo $form_errors['timeslot2']; 
  ?></strong>

  <div class="form-group" id="room_2" style="display:none">
    <label for="inputPassword3" class="col-sm-2 control-label">Room No.</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="room2" name="room2" placeholder="Room No." value="<?php if (!empty($room2)) echo $room2; ?>">
    </div>
    </div>
  <div class="form-group" id="day_2" style="display:none">
    <label for="inputPassword3" class="col-sm-2 control-label">Day</label>
    <div class="col-sm-6">
      <select class="form-control" id="day2" name="day2" placeholder="Day" value="<?php if (!empty($day2)) echo $day2; ?>">
        <option <?php if (!empty($day2)){if($day2=='Monday'){?>selected="selected"<?php }} ?>>Monday</option>
        <option <?php if (!empty($day2)){if($day2=='Tuesday'){?>selected="selected"<?php }} ?>>Tuesday</option>
        <option <?php if (!empty($day2)){if($day2=='Wednesday'){?>selected="selected"<?php }} ?>>Wednesday</option>
        <option <?php if (!empty($day2)){if($day2=='Thrusday'){?>selected="selected"<?php }} ?>>Thrusday</option>
        <option <?php if (!empty($day2)){if($day2=='Friday'){?>selected="selected"<?php }} ?>>Friday</option>
      </select>
    </div>
  </div>
  <div class="form-group" id="start_2" style="display:none">
    <label for="inputPassword3" class="col-sm-2 control-label">Start Time</label>
    <div class="col-sm-6">
      <select class="form-control" id="start2" name="start2" placeholder="Start Time" value="<?php if (!empty($start2)) echo $start2; ?>">
        <option <?php if (!empty($start2)){if($start2=='08:30:00'){?>selected="selected"<?php }} ?>>08:30 AM</option>
        <option <?php if (!empty($start2)){if($start2=='10:00:00'){?>selected="selected"<?php }} ?>>10:00 AM</option>
        <option <?php if (!empty($start2)){if($start2=='11:30:00'){?>selected="selected"<?php }} ?>>11:30 AM</option>
        <option <?php if (!empty($start2)){if($start2=='14:30:00'){?>selected="selected"<?php }} ?>>02:30 PM</option>
        <option <?php if (!empty($start2)){if($start2=='16:00:00'){?>selected="selected"<?php }} ?>>04:00 PM</option>
        <option <?php if (!empty($start2)){if($start2=='17:30:00'){?>selected="selected"<?php }} ?>>05:30 PM</option>
        <option <?php if (!empty($start2)){if($start2=='19:00:00'){?>selected="selected"<?php }} ?>>07:00 PM</option>
      </select>
    </div>
  </div>
  <div class="form-group" id="end_2" style="display:none">
    <label for="inputPassword3" class="col-sm-2 control-label">End Time</label>
    <div class="col-sm-6">
      <select class="form-control" id="end2" name="end2" placeholder="End Time" value="<?php if (!empty($end2)) echo $end2; ?>">
        <option <?php if (!empty($end2)){if($end2=='10:00:00'){?>selected="selected"<?php }} ?>>10:00 AM</option>
        <option <?php if (!empty($end2)){if($end2=='11:30:00'){?>selected="selected"<?php }} ?>>11:30 AM</option>
        <option <?php if (!empty($end2)){if($end2=='13:00:00'){?>selected="selected"<?php }} ?>>01:00 PM</option>
        <option <?php if (!empty($end2)){if($end2=='16:00:00'){?>selected="selected"<?php }} ?>>04:00 PM</option>
        <option <?php if (!empty($end2)){if($end2=='17:30:00'){?>selected="selected"<?php }} ?>>05:30 PM</option>
        <option <?php if (!empty($end2)){if($end2=='19:00:00'){?>selected="selected"<?php }} ?>>07:00 PM</option>
        <option <?php if (!empty($end2)){if($end2=='20:30:00'){?>selected="selected"<?php }} ?>>08:30 PM</option>
      </select>
    </div>
  </div>
  <div class="form-group" id="timeslot_3" style="display:none">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox" id="timeslot3" name="timeslot3" class="timeslot3" value="<?php if (!empty($timeslot3)) echo $timeslot3; ?>" <?php if (!empty($timeslot3)){if($timeslot3=='on'){?>checked="checked"<?php }} ?>> Time Slot 3
        </label>
      </div>
    </div>
  </div>
  <strong style="color:red;margin-left:130px;"><br><?php 
    if(isset($form_errors['timeslot3']))
      echo $form_errors['timeslot3']; 
  ?></strong>
  <div class="form-group" id="room_3" style="display:none">
    <label for="inputPassword3" class="col-sm-2 control-label">Room No.</label>
    <div class="col-sm-6">
      <input type="text" class="form-control" id="room3" name="room3" placeholder="Room No." value="<?php if (!empty($room3)) echo $room3; ?>">
    </div>
    </div>
  <div class="form-group" id="day_3" style="display:none">
    <label for="inputPassword3" class="col-sm-2 control-label">Day</label>
    <div class="col-sm-6">
      <select class="form-control" id="day3" name="day3" placeholder="Day" value="<?php if (!empty($day3)) echo $day3; ?>" >
        <option <?php if (!empty($day3)){if($day3=='Monday'){?>selected="selected"<?php }} ?>>Monday</option>
        <option <?php if (!empty($day3)){if($day3=='Tuesday'){?>selected="selected"<?php }} ?>>Tuesday</option>
        <option <?php if (!empty($day3)){if($day3=='Wednesday'){?>selected="selected"<?php }} ?>>Wednesday</option>
        <option <?php if (!empty($day3)){if($day3=='Thrusday'){?>selected="selected"<?php }} ?>>Thrusday</option>
        <option <?php if (!empty($day3)){if($day3=='Friday'){?>selected="selected"<?php }} ?>>Friday</option>
      </select>
    </div>
  </div>
  <div class="form-group" id="start_3" style="display:none">
    <label for="inputPassword3" class="col-sm-2 control-label">Start Time</label>
    <div class="col-sm-6">
      <select class="form-control" id="start3" name="start3" placeholder="Start Time" value="<?php if (!empty($start3)) echo $start3; ?>" >
        <option <?php if (!empty($start3)){if($start3=='08:30:00'){?>selected="selected"<?php }} ?>>08:30 AM</option>
        <option <?php if (!empty($start3)){if($start3=='10:00:00'){?>selected="selected"<?php }} ?>>10:00 AM</option>
        <option <?php if (!empty($start3)){if($start3=='11:30:00'){?>selected="selected"<?php }} ?>>11:30 AM</option>
        <option <?php if (!empty($start3)){if($start3=='14:30:00'){?>selected="selected"<?php }} ?>>02:30 PM</option>
        <option <?php if (!empty($start3)){if($start3=='16:00:00'){?>selected="selected"<?php }} ?>>04:00 PM</option>
        <option <?php if (!empty($start3)){if($start3=='17:30:00'){?>selected="selected"<?php }} ?>>05:30 PM</option>
        <option <?php if (!empty($start3)){if($start3=='19:00:00'){?>selected="selected"<?php }} ?>>07:00 PM</option>
      </select>
    </div>
  </div>
  <div class="form-group" id="end_3" style="display:none">
    <label for="inputPassword3" class="col-sm-2 control-label">End Time</label>
    <div class="col-sm-6">
      <select class="form-control" id="end3" name="end3" placeholder="End Time" value="<?php if (!empty($end3)) echo $end3; ?>">
        <option <?php if (!empty($end3)){if($end3=='10:00:00'){?>selected="selected"<?php }} ?>>10:00 AM</option>
        <option <?php if (!empty($end3)){if($end3=='11:30:00'){?>selected="selected"<?php }} ?>>11:30 AM</option>
        <option <?php if (!empty($end3)){if($end3=='13:00:00'){?>selected="selected"<?php }} ?>>01:00 PM</option>
        <option <?php if (!empty($end3)){if($end3=='16:00:00'){?>selected="selected"<?php }} ?>>04:00 PM</option>
        <option <?php if (!empty($end3)){if($end3=='17:30:00'){?>selected="selected"<?php }} ?>>05:30 PM</option>
        <option <?php if (!empty($end3)){if($end3=='19:00:00'){?>selected="selected"<?php }} ?>>07:00 PM</option>
        <option <?php if (!empty($end3)){if($end3=='20:30:00'){?>selected="selected"<?php }} ?>>08:30 PM</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" value="Edit Section" id="submit" name="submit" class="btn btn-success "/>                 
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