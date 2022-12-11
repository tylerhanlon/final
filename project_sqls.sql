# SQL statements that were used in the project

# Creation of database:
CREATE DATABASE IF NOT EXISTS final;

use final;

# Creation of tables:

# users:
CREATE TABLE IF NOT EXISTS users (
    id_number INT(9) NOT NULL PRIMARY KEY, 
    fname VARCHAR(30),
    lname VARCHAR(30),
    email VARCHAR(50),
    age INT(3),
    is_student INT(1),
    INDEX idx (fname, lname));

# students:
CREATE TABLE IF NOT EXISTS students (
    id_number INT(9) NOT NULL PRIMARY KEY, 
    major VARCHAR(30),
    minor VARCHAR(30),
    focus VARCHAR(50),
    Constraint students FOREIGN KEY(id_number) REFERENCES users(id_number)
    ON DELETE CASCADE);

# professors:
CREATE TABLE IF NOT EXISTS professors (
    id_number INT(9) NOT NULL PRIMARY KEY, 
    field VARCHAR(30),
    level_of_education VARCHAR(30),
    Constraint professors FOREIGN KEY(id_number) REFERENCES users(id_number)
    ON DELETE CASCADE);

# courses:
CREATE TABLE IF NOT EXISTS courses (
    course_id VARCHAR(7) NOT NULL PRIMARY KEY, 
    course_name VARCHAR(40),
    course_subject VARCHAR(30),
    course_credits INT(1),
    CHECK (course_credits >= 1));

# enrollments:
CREATE TABLE IF NOT EXISTS enrollments (
    enrollment_id varchar(60) PRIMARY KEY, 
    semester VARCHAR(40),
    year VARCHAR(30),
    student_id INT(9),
    course_id VARCHAR(30),
    grade VARCHAR(30));

# teaches:
CREATE TABLE IF NOT EXISTS teaches (
    id_number int(9) NOT NULL, 
    course_id VARCHAR(7),
    semester VARCHAR(40),
    year VARCHAR(30),
    PRIMARY KEY(course_id, semester, year),
    Constraint teaches FOREIGN KEY(id_number) REFERENCES professors(id_number));


# if we use autopopulate and automatically input into the tables:
# these are the statements used:

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111111', 'Tyler', 'Hanlon', 'tyler_hanlon@uri.edu', '21', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111112', 'James', 'Smith', 'james_smith@uri.edu', '18', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111113', 'Robert', 'Johnson', 'robert_johnson@uri.edu', '22', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111114', 'Micheal', 'Williams', 'micheal_williams@uri.edu', '21', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111115', 'Donna', 'Fox', 'donna_fox@uri.edu', '19', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111116', 'Jennifer', 'Winters', 'jennifer_winters@uri.edu', '20', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111117', 'Megan', 'Jeremy', 'Megan_Jeremy@uri.edu', '21', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111118', 'Keith', 'Cheryl', 'Keith_Cheryl@uri.edu', '19', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111119', 'Terry', 'Smith', 'Terry_smith@uri.edu', '18', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111110', 'Ann', 'Jackson', 'Ann_jackson@uri.edu', '20', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111121', 'Joe', 'Martin', 'Joe_Martin@uri.edu', '21', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111131', 'albert', 'grace', 'albert_grace@uri.edu', '19', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111141', 'Philip', 'collins', 'Philip_collins@uri.edu', '20', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111151', 'Jean', 'collins', 'Jean_collins@uri.edu', '21', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111161', 'Jordan', 'edwards', 'Jordan_edwards@uri.edu', '19', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111171', 'Alice', 'morgan', 'Alice_morgan@uri.edu', '21', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111181', 'Wayne', 'peterson', 'Wayne_peterson@uri.edu', '18', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111191', 'Isabella', 'gray', 'Isabella_gray@uri.edu', '21', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111101', 'Diana', 'Myers', 'Diana_Myers@uri.edu', '20', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111211', 'Louis', 'long', 'Louis_long@uri.edu', '21', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111311', 'danielle', 'Butler', 'danielle_Butler@uri.edu', '21', '1');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111111411', 'lisa', 'dipippo', 'lisa_dipippo@uri.edu', '0', '0');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('111155511', 'lutz', 'hamel', 'lutz_hamel@uri.edu', '0', '0');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('177711411', 'noah', 'daniels', 'noah_daniels@uri.edu', '0', '0');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('118921411', 'michael', 'conti', 'michael_conti@uri.edu', '0', '0');

INSERT IGNORE INTO users(id_number, fname, lname, email, age, is_student)
VALUES('472611411', 'marco', 'alvarez', 'marco_alvarez@uri.edu', '0', '0');

# in order to sort users into students and professors we do these queries:
INSERT INTO students(id_number)
SELECT id_number FROM users
WHERE is_student = 1;

INSERT INTO professors(id_number)
SELECT id_number FROM users
WHERE is_student = 0;

# continuing insertion
INSERT IGNORE INTO courses(course_id, course_name, course_subject, course_credits)
VALUES('CSC411', 'Computer Organization', 'Computer Science', '4');

INSERT IGNORE INTO courses(course_id, course_name, course_subject, course_credits)
VALUES('CSC212', 'Data Structures and Algorithms', 'Computer Science', '4');

INSERT IGNORE INTO courses(course_id, course_name, course_subject, course_credits)
VALUES('CSC340', 'Applied Combinatorics', 'Computer Science', '4');

INSERT IGNORE INTO courses(course_id, course_name, course_subject, course_credits)
VALUES('CSC411', 'Computer Organization', 'Computer Science', '4');


INSERT IGNORE INTO enrollments(enrollment_id, semester, year, student_id, course_id, grade)
VALUES('FALL2021111111111CSC212', 'FALL', '2021', '111111111', 'CSC212', 'A');

INSERT IGNORE INTO enrollments(enrollment_id, semester, year, student_id, course_id, grade)
VALUES('FALL2021111111111CSC411', 'FALL', '2021', '111111111', 'CSC411', 'B');

INSERT IGNORE INTO enrollments(enrollment_id, semester, year, student_id, course_id, grade)
VALUES('SPRING2022111111111CSC212', 'SPRING', '2022', '111111111', 'CSC411', 'A');

INSERT IGNORE INTO enrollments(enrollment_id, semester, year, student_id, course_id, grade)
VALUES('SPRING2021111111181CSC411', 'SPRING', '2021', '111111181', 'CSC411', 'C');

INSERT IGNORE INTO enrollments(enrollment_id, semester, year, student_id, course_id, grade)
VALUES('SPRING2021111111181CSC212', 'SPRING', '2021', '111111181', 'CSC212', 'A');

INSERT IGNORE INTO enrollments(enrollment_id, semester, year, student_id, course_id, grade)
VALUES('SPRING2021111111181CSC340', 'SPRING', '2021', '111111181', 'CSC340', 'C');

INSERT IGNORE INTO enrollments(enrollment_id, semester, year, student_id, course_id, grade)
VALUES('SPRING2022111111101CSC340', 'SPRING', '2022', '111111101', 'CSC340', 'B');

INSERT IGNORE INTO enrollments(enrollment_id, semester, year, student_id, course_id, grade)
VALUES('SPRING2022111111101CSC212', 'SPRING', '2022', '111111101', 'CSC212', 'C');

INSERT IGNORE INTO enrollments(enrollment_id, semester, year, student_id, course_id, grade)
VALUES('FALL2022111111117CSC411', 'FALL', '2022', '111111117', 'CSC411', '');

INSERT IGNORE INTO enrollments(enrollment_id, semester, year, student_id, course_id, grade)
VALUES('FALL2022111111117CSC212', 'FALL', '2022', '111111117', 'CSC212', '');

INSERT IGNORE INTO enrollments(enrollment_id, semester, year, student_id, course_id, grade)
VALUES('FALL2022111111117CSC340', 'FALL', '2022', '111111117', 'CSC340', '');


INSERT IGNORE INTO teaches(id_number, course_id, semester, year)
VALUES('472611411', 'CSC411', 'SPRING', '2022');

INSERT IGNORE INTO teaches(id_number, course_id, semester, year)
VALUES('472611411', 'CSC411', 'FALL', '2022');

INSERT IGNORE INTO teaches(id_number, course_id, semester, year)
VALUES('472611411', 'CSC411', 'SPRING', '2021');

INSERT IGNORE INTO teaches(id_number, course_id, semester, year)
VALUES('472611411', 'CSC411', 'FALL', '2021');

INSERT IGNORE INTO teaches(id_number, course_id, semester, year)
VALUES('118921411', 'CSC212', 'SPRING', '2022');

INSERT IGNORE INTO teaches(id_number, course_id, semester, year)
VALUES('118921411', 'CSC212', 'FALL', '2022');

INSERT IGNORE INTO teaches(id_number, course_id, semester, year)
VALUES('118921411', 'CSC212', 'SPRING', '2021');

INSERT IGNORE INTO teaches(id_number, course_id, semester, year)
VALUES('118921411', 'CSC212', 'FALL', '2021');

INSERT IGNORE INTO teaches(id_number, course_id, semester, year)
VALUES('111155511', 'CSC340', 'SPRING', '2022');

INSERT IGNORE INTO teaches(id_number, course_id, semester, year)
VALUES('111155511', 'CSC340', 'FALL', '2022');

INSERT IGNORE INTO teaches(id_number, course_id, semester, year)
VALUES('111155511', 'CSC340', 'SPRING', '2021');

INSERT IGNORE INTO teaches(id_number, course_id, semester, year)
VALUES('111155511', 'CSC340', 'FALL', '2021');

# we can also update values in a table, like the students table
UPDATE students
SET major = 'Computer Science', minor = NULL, focus = NULL
WHERE id_number = 111111114;

# or professors
UPDATE professors
SET field = NULL, level_of_education = 'PhD'
WHERE id_number = 177711411;

# based on the data input into the table we can have any query 
# we want on the `query builder` page
SELECT * FROM users;

# or 
# Gets first name and course name of all students who have 
# enrolled in course w/ id 'CSC212'
SELECT fname, course_name
FROM users, students, enrollments, courses
WHERE students.id_number = enrollments.student_id AND enrollments.course_id = 'CSC212' 
AND students.id_number = users.id_number AND courses.course_id = enrollments.course_id;


# or something like: 
# Gets all professor's first and last names, along with the associated course
# who taught a 4 credit course during Fall 2021
SELECT fname, lname, courses.course_name
FROM users NATURAL JOIN teaches LEFT OUTER JOIN courses ON teaches.course_id = courses.course_id
WHERE teaches.semester = 'Fall' AND teaches.year = 2021 AND courses.course_credits = 4;

# the `premade queries` page gives us these queries and creations:
# Gets the course name and the most frequent grade associated with it
SELECT course_name, grade as most_frequent_grade 
FROM enrollments INNER JOIN courses ON enrollments.course_id = courses.course_id AND grade != '' 
GROUP BY course_name 
ORDER BY most_frequent_grade ASC;

# Creates a view on the courses table for easier access
CREATE VIEW list_classes AS SELECT course_name FROM courses;
select * from list_classes;

# Gets professors first and last names who were instructors in a course in 2022
SELECT DISTINCT CONCAT(UPPER(SUBSTRING(fname,1,1)),LOWER(SUBSTRING(fname,2))) as First_name, CONCAT(UPPER(SUBSTRING(lname,1,1)),LOWER(SUBSTRING(lname,2))) as Last_name
FROM teaches LEFT OUTER JOIN users ON teaches.id_number = users.id_number
WHERE year = 2022;

# Gets the first and last name of any student who has taken CSC340 or CSC212
SELECT fname as First_name, lname as Last_name
FROM users
WHERE id_number IN (
    SELECT id_number
    FROM students INNER JOIN enrollments ON students.id_number = enrollments.student_id
    WHERE course_id = 'CSC340'
    UNION
    SELECT id_number
    FROM students INNER JOIN enrollments ON students.id_number = enrollments.student_id
    WHERE course_id = 'CSC212');

# Gets the amount of students enrolled in each course in 2022
SELECT COUNT(enrollment_id) as num_of_students, course_name
FROM enrollments LEFT OUTER JOIN courses ON enrollments.course_id = courses.course_id
WHERE year = 2022 AND course_name <> ' '
GROUP BY course_name
ORDER BY num_of_students DESC;

# Gets the amount of grades given by a certain professor (in this case, 'Marco Alvarez')
# and states what class they were given in
SELECT grade, COUNT(grade) AS Num_given, teaches.course_id
FROM enrollments LEFT OUTER JOIN teaches on enrollments.course_id = teaches.course_id AND enrollments.semester = teaches.semester AND teaches.year = enrollments.year
WHERE grade <> '' AND id_number IN (
    SELECT users.id_number
    FROM users
    WHERE fname = 'marco' and lname = 'alvarez')
GROUP BY grade, course_id;


# on the 'Admin Tools' page we can alter or delete elements from the tables

# altering the users table to have 'address'
ALTER TABLE users ADD COLUMN address varchar(60);

# removing 'Jordan Edwards' from users and students
DELETE FROM users WHERE id_number = 111111161;

# dropping table `enrollments`
DROP TABLE IF EXISTS enrollments;
