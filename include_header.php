<html>
    <head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title><?php echo $page_title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="author" content="Sachin Jaiswal" />
        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/bootstrap-theme.css" rel="stylesheet" />
        <link href="css/custom.css" rel="stylesheet" />
        
    </head>
    <body background="img/bg.jpg">
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Class Schedule</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li <?php if ($page_title=='Home') { ?>class="active"<?php } ?>><a href="index.php">Home</a></li>
            <li <?php if ($page_title=='About') { ?>class="active"<?php } ?>><a href="about.php">About</a></li>
            
            <li >
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Course <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="search.php">View Courses Offered</a></li>
                <li><a href="timetable.php">Timetable</a></li>

                <?php if ($logged_in) { if ($username =='admin') {
                ?>
                <li><a href="add_course.php">Add Course</a></li>
                <?php } ?>
                <li><a href="add_section.php">Offer Course</a></li>
                <li><a href="my_course.php">My Courses</a></li>
                <li><a href="all_courses.php">All Courses</a></li>
                <?php }?>
              </ul>
            </li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php if ($logged_in) { ?>
          <li <?php if ($page_title=='Home') { ?>class="active"<?php } ?>><a href="index.php"><?php echo "$username"; ?>'s account</a> </li>
          <li><a href="logout.php">logout</a></li>
        <?php } else { ?>
          <li <?php if ($page_title=='Registration') { ?>class="active"<?php } ?>><a href="register.php">Register</a></li>
            <li <?php if ($page_title=='Login') { ?>class="active"<?php } ?>><a href="login.php">Login</a></li>
        <?php } ?>
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
        <div class="container">
