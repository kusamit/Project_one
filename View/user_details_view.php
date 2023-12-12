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
                if (isset($_GET['id'])) 
                {
                    $user_id = $_GET['id'];

                    $sql = "SELECT * FROM user WHERE id = '$user_id'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $user_details = mysqli_fetch_assoc($result);

                        // show user details
                        echo "<h2>User Details</h2>";
                        echo "<tr><th>id: " . $user_details['id'] . "</th>
                        <th>fullame: " . $user_details['fullname'] . "</th></tr>";
                        
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
        </table>
    </form>
    </div>
</body>
</html>