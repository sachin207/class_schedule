<?php
require_once('init_page.php');

	$course = $_POST['course'];
    $year = $_POST['year'];
    $title = $_POST['title'];
    $semester = $_POST['semester'];
    $credits = $_POST['credits'];

    $query = "SELECT id, section.course_id, semester, year, title, credits FROM section, courses WHERE user_id = '$user_id' AND section.course_id=courses.course_id";

    if(strlen($course)>0)
    {
    	$query = $query." AND section.course_id LIKE '%{$course}%'";
    }
    if(strlen($semester)>0)
    {
    	$query = $query." AND semester LIKE '%{$semester}%'";
    }
    if(strlen($title)>0)
    {
    	$query = $query." AND title LIKE '%{$title}%'";
    }
    if(strlen($credits)>0)
    {
        $query = $query." AND credits = '$credits'";
    }
    if(strlen($year)>0)
    {
        $query = $query." AND year LIKE '%{$year}%'";
    }
    $data = mysqli_query($dbc, $query) ;

	$course = array();

	if (mysqli_num_rows($data) > 0) {
		while($r = mysqli_fetch_assoc($data)) {
    	$course[] = $r;
	}
}
	foreach ($course as $course_item) {
                		echo "<tr><td>".$course_item['course_id']."</td><td>".$course_item['title']."</td><td>".$course_item['credits']."</td><td>".$course_item['semester']."</td><td>".$course_item['year']."</td><td>".'<a href="edit_section.php?section_id='.$course_item['id'].'"data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-pencil"></i></a> '.'</td><td><a href="delete_section.php?section_id='.$course_item['id'].'"data-original-title="Remove Course" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a></td></tr>'."</td><tr>";
                	}