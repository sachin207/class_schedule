<?php
require_once('init_page.php');

	$year = $_POST['year'];
    $department = $_POST['department'];
    $semester = $_POST['semester'];
    $semester1 = $semester . "-1";
    $semester2 = $semester . "-2";
    $semester3 = $semester . "-3";

    if($department!='ALL')
    {
    	$query = "SELECT section.course_id, section_id, title, user_id, department.dept_id, dept_name, student,start_time,end_time,day,room_no,semester,year FROM section,timeslot,department,courses WHERE (semester = '$semester' OR semester = '$semester1' OR semester = '$semester2' OR semester = '$semester3') AND dept_name = '$department' AND department.dept_id = courses.dept_id AND courses.course_id = section.course_id AND year = '$year' AND section.id = timeslot.section_id ";
	}
	else
	{
		$query = "SELECT section.course_id, section_id, title, user_id, student, start_time, end_time, day, room_no, semester, year FROM section, timeslot, courses WHERE (semester = '$semester' OR semester = '$semester1' OR semester = '$semester2' OR semester = '$semester3') AND year = '$year' AND section.id = timeslot.section_id AND courses.course_id = section.course_id ";
	}
	$data = mysqli_query($dbc, $query) ;

	$course = array();
    if (mysqli_num_rows($data) > 0) {
		while($r = mysqli_fetch_assoc($data)) {
    	$course[] = $r;
    }
    $days=array("Monday","Tuesday","Wednesday","Thrusday","Friday");
    $time=array("08:30 AM","10:00 AM","11:30 AM","01:00 PM","02:30 PM","04:00 PM","05:30 PM","07:00 PM","08:30 PM");	
    echo '<thead><tr><th>Day/Time</th><th>08:30 AM - 10:00 PM</th><th>10:00 AM - 11:30 PM</th><th>11:30 AM - 01:00 PM</th><th>02:30 PM - 04:00 PM</th><th>04:00 PM - 05:30 PM</th><th>05:30 PM - 07:00 PM</th><th>07:00 PM - 08:30 PM</th></tr></thead>';
    echo '<tbody>';
    foreach ($days as $key ) {

    echo '<tr><td><b>'.$key.'</b></td>';
    echo "<td>";
    foreach ($course as $course_offered ) {
    	if($course_offered['day']==$key){
    		
    		if($course_offered['start_time']=="08:30:00" OR $course_offered['end_time']=="10:00:00"){
    			echo '<b>'.$course_offered["course_id"].'</b><br>('.$course_offered["room_no"].'-'.$course_offered["semester"].')<br>';
    		}	
    	}
    }
    echo "</td>";
    echo "<td>";
    foreach ($course as $course_offered ) {
    	if($course_offered['day']==$key){
    		
    		if($course_offered['start_time']=="10:00:00" OR $course_offered['end_time']=="11:30:00"){
    			echo '<b>'.$course_offered["course_id"].'</b><br>('.$course_offered["room_no"].'-'.$course_offered["semester"].')<br>';
    		}	
    	}
    }
    echo "</td>";
     echo "<td>";
    foreach ($course as $course_offered ) {
    	if($course_offered['day']==$key){
    		
    		if($course_offered['start_time']=="11:30:00" OR $course_offered['end_time']=="13:00:00"){
    			echo '<b>'.$course_offered["course_id"].'</b><br>('.$course_offered["room_no"].'-'.$course_offered["semester"].')<br>';
    		}	
    	}
    }
    echo "</td>";
     echo "<td>";
    foreach ($course as $course_offered ) {
    	if($course_offered['day']==$key){
    		
    		if($course_offered['start_time']=="14:30:00" OR $course_offered['end_time']=="16:00:00"){
    			echo '<b>'.$course_offered["course_id"].'</b><br>('.$course_offered["room_no"].'-'.$course_offered["semester"].')<br>';
    		}	
    	}
    }
    echo "</td>";
     echo "<td>";
    foreach ($course as $course_offered ) {
    	if($course_offered['day']==$key){
    		
    		if($course_offered['start_time']=="16:00:00" OR $course_offered['end_time']=="17:30:00"){
    			echo '<b>'.$course_offered["course_id"].'</b><br>('.$course_offered["room_no"].'-'.$course_offered["semester"].')<br>';
    		}	
    	}
    }
    echo "</td>";
     echo "<td>";
    foreach ($course as $course_offered ) {
    	if($course_offered['day']==$key){
    		
    		if($course_offered['start_time']=="17:30:00" OR $course_offered['end_time']=="19:00:00"){
    			echo '<b>'.$course_offered["course_id"].'</b><br>('.$course_offered["room_no"].'-'.$course_offered["semester"].')<br>';
    		}	
    	}
    }
    echo "</td>";
     echo "<td>";
    foreach ($course as $course_offered ) {
    	if($course_offered['day']==$key){
    		
    		if($course_offered['start_time']=="19:00:00" OR $course_offered['end_time']=="20:30:00"){
    			echo '<b>'.$course_offered["course_id"].'</b><br>('.$course_offered["room_no"].'-'.$course_offered["semester"].')<br>';
    		}	
    	}
    }
    echo "</td>";
    echo "</tr>";
}

}
if(mysqli_num_rows($data) == 0){
	echo '<center> <b> <br>No Data to produce Time Table. <br><br> </b> </center>';
}
echo "</tbody >";
?>