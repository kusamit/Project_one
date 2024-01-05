<?php
include '../session.php';
include '../dbconnect/dbconnect.php';
?>
<?php
// add_member.php

if (isset($_GET['id'])) {
    $project_id = $_GET['id'];
    echo "Project ID: " . $project_id;
} else {
    echo "No project ID provided";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>document</title>
</head>
<body>
    <form action="" method="POST">
        <table>
        Manager <select name="manager" id="">
        <option value="">Select..</option>
        <!-- //php for select option department -->
            <?php
                $log_id=$login_id;
                $sql="SELECT * from manager where log_id= '$log_id'";
                $result=mysqli_query($conn,$sql);
                $num=mysqli_num_rows($result);
                if ($num>0) 
                {
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
                    ?>
                    <option value="<?php echo $row['id']?>"><?php echo $row['fullname']?></option>;
                    <?php
                    }
                } 
                else 
                {
                    echo "<option value=''>Create User First</option>";
                }
            ?>
            </select>
            <hr>

        <!-- member1 -->
        Member: <select name="userone" id="">
        <option value="">Select..</option>
        <!-- //php for select option department -->
            <?php
                                
                $log_id=$login_id;
                $sql="SELECT * from user where log_id= '$log_id'";
                $result=mysqli_query($conn,$sql);
                $num=mysqli_num_rows($result);
                if ($num>0) 
                {
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
                    ?>
                    <option value="<?php echo $row['id']?>"><?php echo $row['fullname']?></option>;
                    <?php
                    }
                } 
                else 
                {
                    echo "<option value=''>Create User First</option>";
                }
            ?></select>
        <div id="usertwo">
        Member: <select name="usertwo" id="">
        <option value="">Select..</option>
        <!-- //php for select option department -->
            <?php
                                
                $log_id=$login_id;
                $sql="SELECT * from user where log_id= '$log_id'";
                $result=mysqli_query($conn,$sql);
                $num=mysqli_num_rows($result);
                if ($num>0) 
                {
                    while ($row = mysqli_fetch_assoc($result)) 
                    {
                    ?>
                    <option value="<?php echo $row['id']?>"><?php echo $row['fullname']?></option>;
                    <?php
                    }
                } 
                else 
                {
                    echo "<option value=''>Create User First</option>";
                }
            ?></select>
        </div>
<input type="submit" name="submit" value="Add Member">
        </table>
    </form>
    <?php
if (isset($_POST['submit'])) {
    $log_id = $login_id;
    $project_id = $_GET['id'];

    $manager = $_POST['manager'];
    $userone = $_POST['userone'];
    $usertwo = $_POST['usertwo'];

    // Check if all required fields are filled
    if (!empty($manager) && !empty($userone) || !empty($usertwo)) {
        $sqlUserOne = "INSERT INTO team_member (manager_id, user_id, project_id, log_id) VALUES ('$manager', '$userone', '$project_id', '$log_id')";
        $sqlUserTwo = "INSERT INTO team_member (manager_id, user_id, project_id, log_id) VALUES ('$manager', '$usertwo', '$project_id', '$log_id')";

        // Use a transaction to ensure both queries are executed or none
        mysqli_autocommit($conn, false);
        $error = false;

        if (!mysqli_query($conn, $sqlUserOne) || !mysqli_query($conn, $sqlUserTwo)) {
            $error = true;
        }

        if ($error) {
            mysqli_rollback($conn);
            echo "Error: " . $sqlUserOne . "<br>" . mysqli_error($conn);
            echo "Error: " . $sqlUserTwo . "<br>" . mysqli_error($conn);
        } else {
            mysqli_commit($conn);
            echo "Records inserted successfully.";
        }

        mysqli_autocommit($conn, true);
    } else {
        echo "Please select Manager, User One, and User Two.";
    }
}
?>
    
</body>
</html>