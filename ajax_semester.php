<?php
require_once('init_page.php');
$semesterid = $_POST['semesterid'];
$query = "SELECT semester FROM section WHERE semester LIKE '%{$semesterid}%' ORDER BY semester ASC LIMIT 1  ";
$data = mysqli_query($dbc, $query) ;
$course = array();
while($rs = mysqli_fetch_assoc($data)) {
   $semester_id = str_replace($_POST['semesterid'], '<b>'.$_POST['semesterid'].'</b>', $rs['semester']);
	// add new option
    echo '<li onclick="set_item4(\''.str_replace("'", "\'", $rs['semester']).'\')"><a href="#">'.$rs['semester'].'</a></li>';

}