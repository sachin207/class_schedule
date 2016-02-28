<?php
require_once('init_page.php');
$name = $_POST['name'];
$query = "SELECT first_name, last_name FROM users WHERE first_name LIKE '%{$name}%' OR last_name LIKE '{$name}%' ORDER BY first_name ASC LIMIT 10  ";
$data = mysqli_query($dbc, $query) ;
$instructor = array();
while($rs = mysqli_fetch_assoc($data)) {
   $instructor_name = str_replace($_POST['name'], '<b>'.$_POST['name'].'</b>', $rs['first_name'].$rs['last_name']);
	// add new option
    echo '<li onclick="set_item1(\''.str_replace("'", "\'", $rs['first_name']." ".$rs['last_name']).'   \')"><a href="#">'.$rs['first_name']." ".$rs['last_name'].'</a></li>';

}