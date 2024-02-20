<?php
session_start();
include '../dbconnect/dbconnect.php';
$userType= $_SESSION["user_type"];
echo $userType;
include '../persistLogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/user_details_view.css">
</head>
<body>
    <div class="outer_m">
    <form action="" method="POST">
        <table>
            <?php
                if (isset($_GET['id'])) 
                {
                    $user_id = $_GET['id'];

                    $sql = "SELECT * FROM users WHERE id = '$user_id'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        $user_details = mysqli_fetch_assoc($result);
                        $user_department=$user_details['department_id'];
                        // show user details
                        echo "<h5>User Details<hr></h5>";
                        echo "<tr><th>ID: " . $user_details['id'] . "</th>
                        <th>Full Name : " . $user_details['fullname'] . "</th></tr>",
                        "<tr><th>Phone No. : " . $user_details['phone'] . "</th>
                        <th>Address : " . $user_details['address'] . "</th>
                        </tr>",
                        "<tr><th>Email: " . $user_details['email'] . "</th>";?>
                        <!-- fetched department name from the department table using the 
                        foreign key department_id from the user table. -->
                        <?php
                                    $dpt="SELECT * from department where dpt_id ='$user_department'";
                                    $result2 = mysqli_query($conn, $dpt);

                                if (mysqli_num_rows($result2) > 0) 
                                {
                                    $department_details = mysqli_fetch_assoc($result2);
                                }
                        ?>

                       <?php echo "<th> Department: " . $department_details['department_name'] . "</th></tr>",
                        "<th>Username: " . $user_details['username'] . "</th></tr>";
                        
                        echo "<p><a href='userlist.php'><img src='back_button.png'></a></p>";
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