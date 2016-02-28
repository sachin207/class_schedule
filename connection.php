<?php
	$dbc=mysqli_connect("localhost","root","","class_schedule");
	if(!$dbc)
		{
		die("Database connection failed :" . mysql_error());
		}

?>