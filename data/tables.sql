DROP TABLE IF EXISTS `department`;
CREATE TABLE `department` (
  `dept_id` int(2) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  PRIMARY KEY (`dept_id`)
);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `username` varchar(20) UNIQUE NOT NULL,
  `email` varchar(50) NOT NULL,
  `cabin_no` varchar(25) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `dept_id` int(2) REFERENCES department(dept_id),
  PRIMARY KEY (`id`)
);


DROP TABLE IF EXISTS `courses`;
CREATE TABLE `courses`(
`course_id` char(25) NOT NULL, 
`title` varchar(100) NOT NULL,
`credits` float(5) NOT NULL,
`dept_id` int(2) REFERENCES department(dept_id), 
PRIMARY KEY (`course_id`)
);

DROP TABLE IF EXISTS `section`;
CREATE TABLE `section`(
`id` int(11) NOT NULL AUTO_INCREMENT,
`course_id` char(6) NOT NULL REFERENCES courses(course_id),
`user_id` int(11) NOT NULL REFERENCES users(id),
`student` int(5) NOT NULL,
`semester` varchar(25) NOT NULL,
`year` int(4) NOT NULL,
PRIMARY KEY (`id`)
);

DROP TABLE IF EXISTS `timeslot`;
CREATE TABLE `timeslot`(
`id` int(11) NOT NULL AUTO_INCREMENT,
`section_id` char(6) NOT NULL REFERENCES section(id),
`start_time` time ,
`end_time` time ,
`day` varchar(15) NOT NULL,
`room_no` varchar(10) NOT NULL,
PRIMARY KEY (`id`)
);

INSERT INTO department(dept_id,dept_name) VALUES
(1, 'Biomedical Engineering'),
(2, 'Biotechnology'),
(3,'Chemical Engineering'),
(4, 'Chemistry'),
(5, 'Civil Engineering'),
(6, 'Computer Science and Engineering'),
(7, 'Design'),
(8, 'Electrical Engineering'),
(9, 'Engineering Science'),
(10, 'Liberal Arts'),
(11, 'Materials Science and Metallurgical Engineering'),
(12, 'Mathematics'),
(13, 'Mechanical Engineering'),
(14, 'Physics'),
(15, 'FCC'),
(16, 'Other');


INSERT INTO users (first_name, last_name, username, email, cabin_no, phone, password, dept_id) VALUES 
('Admin', 'Admin', 'admin', 'admin_class_schedule@iith.ac.in', '001', '500-500-500', SHA('adminclass'), 0);
