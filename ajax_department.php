<?php
require_once('init_page.php');
$departmentid = $_POST['departmentid'];
$query = "SELECT dept_name FROM department WHERE dept_name LIKE '%{$departmentid}%' ORDER BY dept_name ASC LIMIT 10  ";
$data = mysqli_query($dbc, $query) ;
$course = array();
while($rs = mysqli_fetch_assoc($data)) {
   $department_id = str_replace($_POST['departmentid'], '<b>'.$_POST['departmentid'].'</b>', $rs['dept_name']);
	// add new option
    echo '<li onclick="set_item3(\''.str_replace("'", "\'", $rs['dept_name']).'\')"><a href="#">'.$rs['dept_name'].'</a></li>';

}