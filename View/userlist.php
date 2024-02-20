<!-- users_list -->
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
    <link rel="stylesheet" href="../css/userlist.css">
</head>
<body>
    <div class="outer">
    <form action="" method="POST">
        <table>
        <?php
        $id=1;   //initializing id as autoincrement.
               $sql = "SELECT * FROM users"; 
               $result = mysqli_query($conn, $sql);
               if (mysqli_num_rows($result) > 0) {
                echo "<table border='0'>";
                //    Check for Back botton
                    if($userType== "admin")
                    {
                        echo "<a style='float:left;' href='../interface.php'/>";
                        echo "<img style='height:30px; width:30px;' src='../view/back_button.png'></a>";
                    }
                    else if ($userType == "foreman") {
                        echo "<a style='float:left;' href='../interface.php'/>";
                        echo "<img style='height:30px; width:30px;' src='../view/back_button.png'></a>";
                    } else if ($userType == "user") {
                        echo "<a style='float:left;' href='../interface.php'/>";
                        echo "<img style='height:30px; width:30px;' src='../view/back_button.png'></a>";
                    }
                    echo "<h3>User List <hr><h3>";
               while ($row = mysqli_fetch_assoc($result)) 
               {
                echo "
                <tr><th><h4>" . $id . "</h4></th>
                <th><h2>". $row['fullname'] . "<a href='user_details_view.php?id=" . $row['id'] . "'>
                <img src='delete.png' alt='Delete' title='Delete'></a>","<a href='user_details_view.php?id=" . $row['id'] . "'>
                <img src='update.png' alt='Update' title='Update'></a>","<a href='user_details_view.php?id=" . $row['id'] . "'>
                <img src='eye.png' alt='View' title='View'></a></h2></th> </tr>";
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
            