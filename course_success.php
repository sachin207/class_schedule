<?php
require_once('init_page.php');

$page_title='Course Success';

require_once('include_header.php');

if(!$logged_in){
  redirect('login.php');
}

?>
<br><br><br>
<h3 class="text-center" style="color:white"> The course is added Successfully.</h3>
<br><br>
</hr>
<center>
<a href="add_course.php" class="btn btn-info" role="button">Add New Course</a>
</center>