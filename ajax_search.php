<?php
require_once('init_page.php');

	$course = $_POST['course'];
    $department = $_POST['department'];
    $semester = $_POST['semester'];
    $instructor = $_POST['instructor'];
    if(strlen($instructor)>0)
    {
    	$instructor = split(" ", $instructor);
    	$first_name = $instructor[0];
    	$last_name = $instructor[1];	
    }
    else
    {
    	$first_name = '';
    	$last_name = '';
    }
    
    $title = $_POST['title'];
    $year1 = $_POST['year1'];
    $year2 = $_POST['year2'];    

    $query = "SELECT section.id, section.course_id, semester, year, title, credits, first_name, last_name, user_id, dept_name FROM section, courses, users, department WHERE section.user_id = users.id AND section.course_id = courses.course_id AND courses.dept_id = department.dept_id";

    if(strlen($course)>0)
    {
    	$query = $query." AND section.course_id LIKE '%{$course}%'";
    }
    if(strlen($department)>0)
    {
    	$query = $query." AND dept_name LIKE '%{$department}%'";
    }
    if(strlen($semester)>0)
    {
    	$query = $query." AND semester LIKE '%{$semester}%'";
    }
    if(strlen($first_name)>0)
    {
    	$query = $query." AND first_name LIKE '%{$first_name}%'";
    }
    if(strlen($last_name)>0)
    {
    	$query = $query." AND last_name LIKE '%{$last_name}%'";
    }
    if(strlen($title)>0)
    {
    	$query = $query." AND title LIKE '%{$title}%'";
    }
    if(strlen($year1)>0)
    {
    	$query = $query." AND year >= '$year1' ";
    }
    
    if(strlen($year2)>0)
    {
        $query = $query." AND year <= '$year2' ";
    }

	$data = mysqli_query($dbc, $query) ;

	$course = array();
    if (mysqli_num_rows($data) > 0) {
		while($r = mysqli_fetch_assoc($data)) {
    	$course[] = $r;
	}
}
	foreach ($course as $course_item) {
                		echo "<tr><td>".$course_item['course_id']."</td><td>".$course_item['first_name']." ".$course_item['last_name']."</td><td>".$course_item['title']."</td><td>".$course_item['dept_name']."</td><td>".$course_item['semester']."</td><td>".$course_item['year']."</td><td>".$course_item['year']."</td><tr>";
                	}