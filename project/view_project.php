<!-- users_list -->
<?php

include '../dbconnect/dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../css/creation.css"> -->
    <style>
        body
        {
            align-items:center;
            background-color:lightgrey;
            margin:10px;
            margin-left:3rem;
        }
        tr,th
        {
            text-align:left;
            background-color:grey;
            color:White;
            border-radius:5px;
            height:5px;margin-bottom:20px;
            
        }
        table
        {
            width:60%;
            margin-left:20%;
            margin-bottom:2rem;
            margin-top:2px;
            align-items:center;
            text-align:center;
            height:5px;
            box-shadow: inset;
        }
        form
        {
            width:100%;
        }

        h2{
            margin-left:30px;
            margin-top:15px;
            font-size:20px;
            margin-bottom:10px;
        }
        img:hover
        {
            background-color:whitesmoke;
            font-size:max-content;
            padding:2px;
            border-radius:5px;
            width:Max-content;
        }
        h3
        {
            text-align:center;
            font-size:20px;
            color:SlateBlue;
            margin:0px;
            background-color:#003399;
            color:white;
            font-style:bold;
        }
        h4
        {
            text-align:center;
            margin-top:15px;
            font-size:20px;
            margin-bottom:10px;
        }
        .outer
        {
            margin:0px;
            /* background-color:lightgrey; */
            background-color:white;
            width:100%;
            border-radius:5px;
            border-radius:5px;
        }
        a{
            text-decoration:none;
            color:white;
            float:right;
            style-type:inline;
            
        }
        img
        {
            height:20px;
            width:20px;
            
        }
    </style>
</head>
<body>
    <div class="outer">
    <form action="" method="POST">
        <table border="0">
        <?php
        // $log_id=$login_id;
        $id=1;   //initializing id as autoincrement.
               $sql = "SELECT * FROM project"; 
               $result = mysqli_query($conn, $sql);
               if (mysqli_num_rows($result) > 0) {
                echo "<h3>Projects <hr><h3>";
                   echo "<table border='0'>
               ";
               while ($row = mysqli_fetch_assoc($result)) 
               {
                echo "<tr><th><h4>" . $id . "</h4></th>
                <th><h2>". $row['project_name'] . "<a href='project_details.php?id=" . $row['id'] . "'>
                <img src='../view/update.png' alt='update' title='Delete'></a>","<a href='project_details.php?id=" . $row['id'] . "'>
                <img src='../view/eye.png' alt='View' title='View'></a></h2></th> </tr>";
                $id++;
            }
               echo "</table>";
               } else {
               echo "No records found.";}
               mysqli_close($conn);
           
        ?>
        </table>
    </form>
               </div>
</body>
</html>
            