<?php

require_once('init_page.php');

$page_title='Search';

$query = "SELECT section.id, section.course_id, semester, year, title, credits, first_name, last_name, user_id, dept_name FROM section, courses, users, department WHERE section.user_id = users.id AND section.course_id = courses.course_id AND courses.dept_id = department.dept_id";

$data = mysqli_query($dbc, $query) ;

$course = array();
if (mysqli_num_rows($data) > 0) {
while($r = mysqli_fetch_assoc($data)) {
    $course[] = $r;
}
}
require_once('include_header.php');



?>
<br><br><br>

<div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <center><h3 class="panel-title">Courses Offered</h3></center>
                 <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
                
                
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="Course ID" id="course_se" name="course_se" disabled onkeyup="search()" >
                        	<div style="position:fixed;z-index:10;background-color:white;width:200px;">
                        </div>

                        </th>
                        <th><input type="text" class="form-control" placeholder="Instructor" id="instructor_se" name="instructor_se" disabled onkeyup="search()">
                        	<div style="position:fixed;z-index:10;background-color:white;width:200px;">
                        </div>
                        </th>
                        <th><input type="text" class="form-control" placeholder="Title" id="title_se" name="title_se" disabled onkeyup="search()" >
                        	<div style="position:fixed;z-index:10;background-color:white;width:200px;">
                        </div>
                        </th>
                        <th><input type="text" class="form-control" placeholder="Department" disabled id="department_se" name="department_se" onkeyup="search()">
                        	<div style="position:fixed;z-index:10;background-color:white;width:200px;">
                        </div>
                        </th>
                        <th><input type="text" class="form-control" placeholder="Semester" disabled id="semester_se" name="semester_se" onkeyup="search()" >
        				<div style="position:fixed;z-index:10;background-color:white;width:200px;">
                        </div>
        				</th>
                        <th><input type="text" class="form-control" placeholder="Start Year" disabled id="year_se1" name="year_se1" onkeyup="search()"></th>
                        <th><input type="text" class="form-control" placeholder="End Year" disabled id="year_se2" name="year_se2" onkeyup="search()"></th>

                    </tr>
          
                </thead>

                <tbody id="search_table">

                    <?php
                	foreach ($course as $course_item) {
                		echo "<tr><td>".$course_item['course_id']."</td><td>".$course_item['first_name']." ".$course_item['last_name']."</td><td>".$course_item['title']."</td><td>".$course_item['dept_name']."</td><td>".$course_item['semester']."</td><td>".$course_item['year']."</td><td>".$course_item['year']."</td><tr>";
                	}
                		?>
                </tbody>
            </table>
        </div>

<?php


require_once('include_footer.php');

?>