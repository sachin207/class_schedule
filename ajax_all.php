<?php
require_once('init_page.php');

	$course = $_POST['course'];
    $department = $_POST['department'];
    $title = $_POST['title'];
    $credits = $_POST['credits'];

    $query = "SELECT course_id,  title, credits, dept_name FROM  courses,department WHERE courses.dept_id = department.dept_id";
    if(strlen($course)>0)
    {
    	$query = $query." AND course_id LIKE '%{$course}%'";
    }
    if(strlen($department)>0)
    {
    	$query = $query." AND dept_name LIKE '%{$department}%'";
    }
    if(strlen($title)>0)
    {
    	$query = $query." AND title LIKE '%{$title}%'";
    }
    if(strlen($credits)>0)
    {
        $query = $query." AND credits = '$credits'";
    }
    $data = mysqli_query($dbc, $query) ;

	$course = array();

	if (mysqli_num_rows($data) > 0) {
		while($r = mysqli_fetch_assoc($data)) {
    	$course[] = $r;
	}
}
	foreach ($course as $course_item) {
                		echo "<tr><td>".$course_item['course_id']."</td><td>".$course_item['title']."</td><td>".$course_item['dept_name']."</td><td>".$course_item['credits']."</td><td>".'<a href="add_section.php?course_id='.$course_item['course_id'].' "data-original-title="Offer Course" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-plus"></i></a> '."</td><tr>";
                	}