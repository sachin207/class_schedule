<?php
require_once('init_page.php');

$page_title='About';

require_once('include_header.php');

?>
<br><br><br>


<font color = #FFF>
<table width="85%" align="center" border="0">
  <tr>
    <td align="center"><font color=green><H2 align=center><b><font color="white">About</font></b> </H2></font>
    </td>
  </tr>
</table>
	
  <table width=70% align=center border=1 cellpadding=4 cellspacing="0">
        <tr>
        	 This is a very efficient online portal which helps to view courses or edit the courses by professors of IITH. In this, firstly we have a Home Page on which the basic details of the project are given. There is a well-designed header which contains About-which gives a gist of this project. The header also contains
           <li> Courses </li>
           <li> Register </li>
            <li> Login </li>
            The Courses are further divided into a drop down with – view courses offered and Time Table.
            <br>
            <b>Register</b>- It is a form which allows the professors to register themselves with their personal information. If they have already registered, they can simply login with their userid and password.
            <br>
            <b>Login</b>- If the user has already registered, they can login as mentioned above.
            <br>
            In our design, a course can be added only by the admin but it can offered by an professor at any time.
            <br>
<UL STYLE= "list-style: circle">
   <li><u><b>Courses</b></u></li> 
   <UL STYLE= "list-style: square">
    <li>This enables to view all courses irrespective of it is being offered by a professor or not.</li>
    <li>There is a filter which enables a quick dynamic smart search.</li>
    <li>As in, when in course cs is typed, the data shown below automatically keeps updating itself giving desired results.</li>
    <li>There is no search button included-which is better as the results will be displayed dynamically and using ajax.</li>
    <br>
  </UL>
  <li><u><b>Register</b></u></li>
  <UL STYLE= "list-style: square">
    <li>In this, a user can register as a professor.</li>
    <br>
  </UL>
  <li><u><b>Login</b></u></li> 
    <UL STYLE= "list-style: square">
    <li>In this, a user can login as a professor. After he logs in, a new header appears. Also a page with all his personal details appears. These details can be edited by him after he logs in.</li>
    <li>There are two buttons at the bottom of his profile-View My courses and Offer Courses.</li>
    <li>View My Courses helps him/her  to view the courses ever offered by him/her till now.</li>
    <li>Offer Course-helps him/her to offer a course which hasn’t been offered by him in that semester. </li>
    <li>In the header we have </li>
    <UL STYLE= "list-style: lower-alpha">
      <li>View Courses Offered- Helps to view respective courses</li>
<padding-left:5em><li>TimeTable- displays the timetable in a systematic table fashion</li>
<li>Offer Courses-helps to offer courses by inputing all required fields and also dynamically adding sections. There is a timeslot option which can be added dynamically.</li>
<li>My Courses- all the courses offered can be viewed with options to delete or edit a specific course. Delete will remove the course from the list and edit helps to change the room number or timings.</li>
<li>All courses -gives a list of all courses approved by the admin with a filter in order to make search simple, it is very efficient and user-friendly with ample dynamic features. Also it has a plus button which helps the professor to add that course to be offered by him/her.</li>
<li>Logout- option to get out of the current account and go to home page.</li>
    </UL>
  </UL>
</UL>
<br>
<b>Special Features in this website:</b>
  <UL STYLE= "list-style: disc">
    <li>Dynamic data search using ajax</li>
    <li>Taken care of FCCs</li>
    <li>Ample number of filters</li>
    <li>Precise forms to register or edit data</li>
    <li>Encrypted Passwords in database for more security</li>
    <li>SQL Injection</li>
  </UL>
<u><b>E-R Diagram</b></u>
<br>
           <img src="img/er.jpg"/>
<br><br><br>
  <img src="img/er_mysql.jpg"/>
<br><br><br>

<u><b>E-R Diagram Explanation:</b></u><br>
In this there are 5 important entities. The tables department and courses are  one to many relationship with total participation from courses. The department and users have also a one to many relationship with every user being in a specific department but every department having many users. Now coming to users-section relationship, we assume that many users can be mapped to a section but each section has at a particular time can be taught by only one professor/user.  The relationship between section and courses is a week entity as section depends on course to complete itself. Lastly, for timeslot-section relationship, we know that every timeslot can contain only a particular section at a time as only one course can be taught at one time in a section.
        </table>
        <br><br><br>
        
        <table width=30% align=center border=1 cellpadding=4 cellspacing="1">
          <thead>
          <tr>
            <th><font color="#fff">Table</font></th>
            <th><font color="#fff">Primary Key</font></th>

          </tr>
          </thead>
          <tbody>
            
              <tr>
                <td><font color= #FFF>department</font></td>
                <td><font color= #FFF>dept_id</font></td>
              </tr>
              <tr>
                <td><font color= #FFF>users</font></td>
                <td><font color= #FFF>Id</font></td>
              </tr>
              <tr>
                <td><font color= #FFF>courses</font></td>
                <td><font color= #FFF>course_id</font></td>
              </tr>
              <tr>
                <td><font color= #FFF>section</font></td>
                <td><font color= #FFF>id</font></td>
              </tr>
              <tr>
                <td><font color= #FFF>timeslot</font></td>
                <td><font color= #FFF>Id</font></td>
              </tr>
          </tbody>
        </table>

        <br><br><br>
        <table width=50% align=center border=1 cellpadding=4 cellspacing="1">
          <thead>
          <tr>
            <th><font color="#fff">Table</font></th>
            <th><font color="#fff">Foreign Key</font></th>
            <th><font color="#fff">Referenced Table</font></th>
          </tr>
          </thead>
          <tbody>
            
              <tr>
                <td><font color= #FFF>department</font></td>
                <td><font color= #FFF>-</font></td>
                <td><font color= #FFF>-</font></td>
              </tr>
              <tr>
                <td><font color= #FFF>users</font></td>
                <td><font color= #FFF>dept_id</font></td>
                <td><font color= #FFF>department(dept_id)</font></td>
              </tr>
              <tr>
                <td><font color= #FFF>courses</font></td>
                <td><font color= #FFF>dept_id</font></td>
                <td><font color= #FFF>department(dept_id)</font></td>
              </tr>
              <tr>
                <td><font color= #FFF>section</font></td>
                <td><font color= #FFF>course_id,user_id</font></td>
                <td><font color= #FFF>courses(course_id),users(id)</font></td>
              </tr>
              <tr>
                <td><font color= #FFF>timeslot</font></td>
                <td><font color= #FFF>section_id</font></td>
                <td><font color= #FFF>section(id)</font></td>
              </tr>
          </tbody>
        </table>
        
        <br><br><br><br>

<u><b>Normal Forms Explanation:</b></u>
<br>
In this, we normalize the data in order to eliminate redundant data and ensure data dependencies make sense. It’s tough to handle databases without facing data loss else.
  <br><br>
  Here, we have used <b>BCNF</b> form.
  <br><br>Explanation of BCNF or 3.5NF :
  <br><br>
  It is a higher version of 3NF and deals with certain anomalies which are not handled well by 3NF as well. The 3NF table which doesn’t allow multiple overlapping candidate keys is in BCNF. There is no redundancy based on functional dependency although other types might exist. 
  <br><br>
  A relational schema R is in Boyce–Codd normal form if and only if for every one of its dependencies X → Y, at least one of the following conditions hold:
  <br><br>
  <UL>
  <li>X → Y is a trivial functional dependency (Y ⊆ X)</li>
  <li>X is a super key for schema R ( as quoted in Wikipedia)</li>
  </UL>
  <br>
  In the tables we used, let’s go one by one and check for their dependencies and redundancy. 
  <br><br>
  <UL>
  <li>In the table department, we have two attributes- dept_id and dept_name which are trivial functional dependencies.</li>
  <li>In the next table users and courses, there are multiple(9) attributes which imply superkey relations.</li>
  <li>In the latter tables as well, we observe that all functional dependencies which are either primary keys or superkey, henceforth leading to BCNF form only.</li>
  </UL>
  </table>
  <br><br>
          
       
        


<?php


require_once('include_footer.php');

?>