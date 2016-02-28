<?php

require_once('init_page.php');

$page_title='TimeTable';

require_once('include_header.php');

?>

<br><br><br>

<div class="row">
        <div class="panel panel-primary">
        	<center> 
                <br>
               
               <div class="panel-heading">
                <h2 class="panel-title"><strong>Time Table</strong></h2>
                 
                
            </div>
        	<div class="form-inline">
			  <div class="form-group" >
               
			    <input type="text" class="form-control" id="year_tt" placeholder="Year">
			  </div>
			  <div class="form-group">
			    <select class="form-control" id="semester_tt" placeholder="Semester">
                    <option>Fall</option>
                    <option>Spring</option>
                    
                </select>
			  </div>
			  <div class="form-group">
			    <select class="form-control" id="department_tt" name="department_tt" placeholder="Department" >
                            <option>ALL</option>
                            <option>Biomedical Engineering</option>
                            <option>Biotechnology</option>
                            <option>Chemical Engineering</option>
                            <option>Chemistry</option>
                            <option>Civil Engineering</option>
                            <option>Computer Science and Engineering</option>
                            <option>Design</option>
                            <option>Electrical Engineering</option>
                            <option>Engineering Science</option>
                            <option>Liberal Arts</option>
                            <option>Materials Science and Metallurgical Engineering</option>
                            <option>Mathematics</option>
                            <option>Mechanical Engineering</option>
                            <option>Physics</option>
                            <option>FCC</option>
                            <option>Others</option>

                </select>
            </div>
			  <button class="btn btn-default btn-success btn-search" id="submit_tt"><span class="glyphicon glyphicon-th"></span> Generate Timetable</button>
			</div>
            <br>
            </center>            	
            
            <table class="table table-bordered" id="table_tt">
                
            </table>
        </div>

<?php


require_once('include_footer.php');

?>