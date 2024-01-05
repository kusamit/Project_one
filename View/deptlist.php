<!-- users_list -->
<?php
include '../session.php';
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
        }
        tr,th
        {
            text-align:left;
            background-color:grey;
            color:White;
            margin:10px;
            border-radius:5px;
            height:5px;
            
            
        }
        table
        {
            width:93%;
            margin-left:2rem;
            align-items:center;
            text-align:center;
            margin-bottom:2rem;
            height:5px;
            
            
        }
        form
        {
            background-color:blue:
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
            margin:10px;
            background-color:lightgrey;
            width:60%;
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
            margin-right:5px;
        }
    </style>
</head>
<body>
    <div class="outer">
    <form action="" method="POST">
        <table>
        <?php
        $log_id=$login_id;
        $id=1;   //initializing id as autoincrement.
               $sql = "SELECT * FROM department where log_id= '$log_id'"; 
               $result = mysqli_query($conn, $sql);
               if (mysqli_num_rows($result) > 0) {
                   echo "<table border='0'>
               ";
               echo "<h3>Department List <hr><h3>";
               while ($row = mysqli_fetch_assoc($result)) 
               {
                echo "<tr><a style='float:left;' href='../mainsession.php'><img src='back_button.png'></a></tr>
                <tr><th><h4>" . $id . "</h4></th>
                <th><h2>". $row['department_name'] . "<a href='user_details_view.php?id=" . $row['id'] . "'>
                <img src='delete.png' alt='Delete' title='Delete'></a>","<a href='user_details_view.php?id=" . $row['id'] . "'>
                <img src='update.png' alt='Update' title='Update'></a>","<a href='user_details_view.php?id=" . $row['id'] . "'>
                </a></h2></th> </tr>";
                $id++;
            }
               echo "</table>";
               } else {
               echo "No records found.";}
               mysqli_close($conn);
        ?>
            <tr>

            </tr>
        </table>
    </form>
               </div>
</body>
</html>
            