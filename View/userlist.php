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
        }
        tr,th
        {
            text-align:left;
            background-color:grey;
            color:White;
            margin:10px;
            border-radius:5px;
            
            
        }
        table
        {
            width:85%;
            margin-left:2rem;
            align-items:center;
            text-align:center:
            
        }
        form
        {
            background-color:blue:
        }
        h2{
            margin-left:30px;
            margin-top:15px;
            font-size:15px;
            margin-bottom:10px;
        }
        h2:hover
        {
            background-color:SlateBlue;
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
            margin-left:40%;
            margin-top:50%;
        }
        .outer
        {
            margin:10px;
            background-color:lightgrey;
            width:40%;
            border-radius:5px;
        }
        a{
            text-decoration:none;
            color:white;
            float:right;
            /* height:1px;
            width:1px; */
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
               $sql = "SELECT * FROM user"; 
            //    where username='$username_email'";
               $result = mysqli_query($conn, $sql);
               if (mysqli_num_rows($result) > 0) {
                   echo "<table border='0'>
               ";
               echo "<h3>Users List <hr><h3>";
               while ($row = mysqli_fetch_assoc($result)) 
               {
                echo "<tr><th><h4>" . $row['id'] . "</h4></th>
                <th><h2>". $row['fullname'] . "</h2><a href='user_details_view.php?id=" . $row['id'] . "'><img src='eye.png'></a></th> </tr>";}
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
            