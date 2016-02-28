<?php
require_once('init_page.php');

$page_title='Section Success';

require_once('include_header.php');

if(!$logged_in){
  redirect('login.php');
}

?>
<br><br><br>
<h3 class="text-center" style="color:white"> The course's section is added Successfully.</h3>
<br><br>
</hr>
<center>
<a href="add_section.php" class="btn btn-info" role="button">Offer Another Course</a>
</center>

<?php


require_once('include_footer.php');

?>