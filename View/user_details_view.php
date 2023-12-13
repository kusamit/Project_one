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
        /* table */
        tr,th
        {
            text-align:left;
            background-color:grey;
            color:White;
            border-radius:5px;
            text-align:center;
            gap:10px;
            
        }
        th{
            padding: 10px;
            margin-bottom:50px;
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
        /* outerlayer */
        .outer_m
        {
            margin:10px;
            background-color:lightgrey;
            width:40%;
            border-radius:5px;
            height:60%;
        }
        a{
            text-decoration:none;
            color:white;
            float:right;
        }
        img
        {
            height:20px;
            width:20px;
            margin-right:5px;
        }
        p
        {
            text-align:center;
            font-size:25px;
        }
    </style>
</head>
<body>
    <div class="outer_m">
    <form action="" method="POST">
        <table>
            <?php
                if (isset($_GET['id'])) 
                {
                    $user_id = $_GET['id'];

                    $sql = "SELECT * FROM user WHERE id = '$user_id'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $user_details = mysqli_fetch_assoc($result);

                        // show user details
                        echo "<p>User Details<hr></p>";
                        echo "<tr><th>ID: " . $user_details['id'] . "</th>
                        <th>Full Name : " . $user_details['fullname'] . "</th></tr>",
                        "<tr><th>Phone No. : " . $user_details['phone'] . "</th>
                        <th>Address : " . $user_details['address'] . "</th>
                        </tr>",
                        "<tr><th>Email: " . $user_details['email'] . "</th>";?>
                        <!-- fetched department name from the department table using the 
                        foreign key department_id from the user table. -->
                        <?php
                                    $dpt="select * from department where id=". $user_details['department_id'] ."";
                                    $result2 = mysqli_query($conn, $dpt);

                                if (mysqli_num_rows($result2) > 0) 
                                {
                                    $department_details = mysqli_fetch_assoc($result2);
                                }
                        ?>

                       <?php echo "<th> Department: " . $department_details['department_name'] . "</th></tr>",
                        "<tr><th>Username: " . $user_details['username'] . "</th></tr>",
                        "<tr><th>Password: " . $user_details['password'] . "</th></tr>";
                        
                        echo "<p><a href='your_user_list_page.php'>Back to User List</a></p>";
                    } 
                    else 
                    {
                        echo "User not found.";
                    }
                } 
                else 
                {
                    echo "Invalid request. User ID not provided.";
                }
            ?>

            <!-- foreign key -->
          

        </table>
    </form>
    </div>
</body>
</html>