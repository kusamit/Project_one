<?php
include 'session.php';
?>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="./css/creation.css">
    </head>
    <body>
        <div class="head">
            <h1>Project Management System</h1>
        </div>
        <div class="nav">

        </div>
        <div class="main">
        <div class="list">
        <h2><a href="./Create/ceate_department.php">Create Department</a></h2>
        <h2><a href="./Create/create_user.php">Create Users</a></h2>
        <h2><a href="./Create/create_project.php">Create Project</a></h2>
        <h2><a href="./view/userlist.php">Users</a></h2>
        <h2><a href="./view/deptlist.php">Department</a></h2>
        <h2><a href="#1"></a></h2>
        </div>
        <div class="view">
            <iframe src="./project/view_project.php" frameborder="0" id="frame"style="height:100%;
            width: 100%;"></iframe>
        </div>
        </div>
    </body>
</html>
