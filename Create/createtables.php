<?php
include '../dbconnect/dbconnect.php';
//Create Regestration Table.
$adminquery="CREATE TABLE admin_registration (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    phone INT,
    email VARCHAR(255) UNIQUE,
    username VARCHAR(255) UNIQUE,
    password VARCHAR(25),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$admintable=mysqli_query($conn,$adminquery);
if($admintable)
{
    echo 'Admin Regestration database Created.';
}
else
{
    echo 'error to create admin database';
}
//Department Creation
$departmentquery="CREATE TABLE department (
    id INT AUTO_INCREMENT PRIMARY KEY,
    department_name VARCHAR(255) NOT NULL,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$department_table=mysqli_query($conn,$departmentquery);
if($department_table)
{
    echo 'Department database Created';
}
else
{
    echo 'error to create Department database.';
}
//Project Creation
$projectquery="CREATE TABLE project (
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(255) NOT NULL,
    file VARCHAR(255),
    message VARCHAR(255),
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$projecttable=mysqli_query($conn,$projectquery);
if($projecttable)
{
    echo 'Project database Created.';
}
else
{
    echo 'error to create Project database';
}
//Create Users
$userquery="CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE,
    phone INT,
    address VARCHAR(255) NOT NULL,
    username VARCHAR(255) UNIQUE,
    password VARCHAR(25),
    department_id int, FOREIGN KEY(department_id) REFERENCES department(id),
    project_id int,
    assigned_id int,
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$usertable=mysqli_query($conn,$userquery);
if($usertable)
{
    echo 'User database Created.';
}
else
{
    echo 'error to create user database';
}
//create Assingment of work.
$workquery="CREATE TABLE assigned (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    Details VARCHAR(255) UNIQUE,
    file VARCHAR(255),
    assigned_department INT, FOREIGN KEY(assigned_department) REFERENCES department(id),
    assigned_user INT, FOREIGN KEY(assigned_user) REFERENCES user(id),
    Completed_file varchar(255),
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$worktable=mysqli_query($conn,$workquery);
if($worktable)
{
    echo 'Assignment Work database Created.';
}
else
{
    echo 'error to create uAssignment Work  database';
}
//Create Notes
$notequery="CREATE TABLE note (
    id INT AUTO_INCREMENT PRIMARY KEY,
    notes VARCHAR(255),
    user_id INT NOT NULL,
    FOREIGN KEY(user_id) REFERENCES user(id),
    created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";
$notetable=mysqli_query($conn,$notequery);
if($notetable)
{
    echo 'Note database Created.';
}
else
{
    echo 'error to create Note database';
}
?>


<!-- CREATE DATABASE project_management_system -->
