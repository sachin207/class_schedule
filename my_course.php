<?php
require_once('init_page.php');

$query = "SELECT id, section.course_id, semester, year, title, credits FROM section, courses WHERE user_id = '$user_id' AND section.course_id=courses.course_id";
$data = mysqli_query($dbc, $query) ;
$course = array();
while($r = mysqli_fetch_assoc($data)) {
    $course[] = $r;
}


$page_title='My Courses';
?>
<br><br><br>
<div class="container">
    <div class="row">
        <div class="panel panel-primary filterable">
            <div class="panel-heading">
                <center><h3 class="panel-title">Course Details</h3></center>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filter</button>
                </div>
            </div>
            <table class="table">
                <table class="table">
                <thead>
                    <tr class="filters">
                        <th><input type="text" class="form-control" placeholder="Course ID" id="course_me" name="course_me" disabled onkeyup="my_search()" >
                            <div style="position:fixed;z-index:10;background-color:white;width:200px;">
                        </div>

                        </th>
                        
                        <th><input type="text" class="form-control" placeholder="Title" id="title_me" name="title_me" disabled onkeyup="my_search()" >
                            <div style="position:fixed;z-index:10;background-color:white;width:200px;">
                        </div>
                        </th>
                        <th><input type="text" class="form-control" placeholder="Credits" disabled id="credits_me" name="credits_me" onkeyup="my_search()">
                        </th>
                        
                        <th><input type="text" class="form-control" placeholder="Semester" disabled id="semester_me" name="semester_me" onkeyup="my_search()" >
                        <div style="position:fixed;z-index:10;background-color:white;width:200px;">
                        </div>
                        </th>
                        <th><input type="text" class="form-control" placeholder="Start Year" disabled id="year_me" name="year_me" onkeyup="my_search()"></th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
          
                </thead>
                <tbody id="my_table">
                	<?php
                	foreach ($course as $course_item) {
                            
                		echo "<tr><td>".$course_item['course_id']."</td><td>".$course_item['title']."</td><td>".$course_item['credits']."</td><td>".$course_item['semester']."</td><td>".$course_item['year']."</td><td>".'<a href="edit_section.php?section_id='.$course_item['id'].' "data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-pencil"></i></a> '.'</td><td><a href="delete_section.php?section_id='.$course_item['id'].'"data-original-title="Remove Course" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i></a></td></tr>';
                	}
                	?>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php

require_once('include_header.php');

require_once('include_footer.php');

?>