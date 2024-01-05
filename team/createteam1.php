<?php
include '../session.php';
include '../dbconnect/dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team creation</title>
</head>
<body>
    <form action="" method="POST">
        <table>
           Manager: <select name="user" id="">
                            <option value="">Select..</option>
                            <!-- //php for select option department -->
                            <?php
                                include '../dbconnect/dbconnect.php';
                                $log_id=$login_id;
                                $sql="SELECT * from user where log_id= '$log_id'";
                                $result=mysqli_query($conn,$sql);
                                var_dump($result);
                                if($result)
                                {
                                    echo "success";
                                }else
                                {
                                    echo "error to select user";
                                }
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
            <tr>
                <th>Manager</th>
                <th></th>
            </tr>
        </table>
    </form>
</body>
</html>