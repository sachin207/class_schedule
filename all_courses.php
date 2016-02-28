<?php
require_once('init_page.php');

$page_title='All Courses';



$query = "SELECT course_id,  title, credits, dept_name FROM  courses,department WHERE courses.dept_id = department.dept_id";

$data = mysqli_query($dbc, $query) ;

$course = array();
if (mysqli_num_rows($data) > 0) {
while($r = mysqli_fetch_assoc($data)) {
    $course[] = $r;
}
}
require_once('include_header.php');

if(!$logged_in){
  redirect('login.php');
}

?>
<br><br><br>

<div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <center><h3 class="panel-title">Courses</h3></center>
                 <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
               
                
            </div>
            <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="Course ID" id="course_se" name="course_se" disabled onkeyup="all_courses()" >
                        	<div style="position:fixed;z-index:10;background-color:white;width:200px;">
                        </div>

                        </th>
                        
                        <th><input type="text" class="form-control" placeholder="Title" id="title_se" name="title_se" disabled onkeyup="all_courses()" >
                        	<div style="position:fixed;z-index:10;background-color:white;width:200px;">
                        </div>
                        </th>
                        <th><input type="text" class="form-control" placeholder="Department" disabled id="department_se" name="department_se" onkeyup="all_courses()">
                        	<div style="position:fixed;z-index:10;background-color:white;width:200px;">
                        </div>
                        </th>
                        <th><input type="text" class="form-control" placeholder="Credits" disabled id="credits_se" name="credits_se" onkeyup="all_courses()">
                            
                        
                        </th>
                        <th>Offer Course</th>
                    </tr>
          
                </thead>

                <tbody id="search_table">

                    <?php
                	foreach ($course as $course_item) {
                		echo "<tr><td>".$course_item['course_id']."</td><td>".$course_item['title']."</td><td>".$course_item['dept_name']."</td><td>".$course_item['credits']."</td><td>".'<a href="add_section.php?course_id='.$course_item['course_id'].' "data-original-title="Offer Course" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-plus"></i></a> '."</td><tr>";
                	}
                		?>
                </tbody>
            </table>
        </div>

<?php


require_once('include_footer.php');

?>