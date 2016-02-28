<?php
require_once('init_page.php');
$courseid = $_POST['courseid'];
$query = "SELECT course_id, title FROM courses WHERE course_id LIKE '%{$courseid}%' OR title LIKE '%{$courseid}%'   ORDER BY course_id ASC LIMIT 10  ";
$data = mysqli_query($dbc, $query) ;
$course = array();
while($rs = mysqli_fetch_assoc($data)) {
   $course_id = str_replace($_POST['courseid'], '<b>'.$_POST['courseid'].'</b>', $rs['course_id']." - ".$rs['title']);
	// add new option
    echo '<li onclick="set_item6(\''.str_replace("'", "\'", $rs['course_id']).'\')"><a href="#">'.$rs['course_id']." - ".$rs['title'].'</a></li>';

}