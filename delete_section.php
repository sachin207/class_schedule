<?php
require_once('init_page.php');

$page_title='Delete Course';

require_once('include_header.php');

if(!$logged_in){
  redirect('login.php');
}

$section_id = $_GET['section_id'];

$query = "SELECT * FROM section WHERE
                id = '$section_id' and user_id = '$user_id'";
                
$result = mysqli_query($dbc, $query) ;
      // if not, redirect
  if (mysqli_num_rows($result) == 0) {
        redirect('accessdenied.php');
      }

$section = mysqli_fetch_assoc($result);

$query1 = "DELETE FROM section WHERE id = '$section[id]'";

$result1 = mysqli_query($dbc, $query1) ;

$query = "DELETE FROM timeslot WHERE section_id = '$section[id]'";
$result = mysqli_query($dbc, $query);

?>

<br><br><br>
<h3 class="text-center" style="color:white"> The course's section <?php echo $section['course_id'] ?> is deleted Successfully.</h3>
<br><br>
</hr>
<center>
<a href="my_course.php" class="btn btn-info" role="button">View My Courses</a>
</center>

<?php


require_once('include_footer.php');

?>