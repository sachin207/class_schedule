<?php
require_once('init_page.php');
$titleid = $_POST['titleid'];
$query = "SELECT title FROM courses WHERE title LIKE '%{$titleid}%' ORDER BY title ASC LIMIT 10  ";
$data = mysqli_query($dbc, $query) ;
$course = array();
while($rs = mysqli_fetch_assoc($data)) {
   $course_id = str_replace($_POST['titleid'], '<b>'.$_POST['titleid'].'</b>', $rs['title']);
	// add new option
    echo '<li onclick="set_item2(\''.str_replace("'", "\'", $rs['title']).'\')"><a href="#">'.$rs['title'].'</a></li>';

}