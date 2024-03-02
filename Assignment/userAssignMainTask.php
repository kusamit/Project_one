<?php
include '../dbconnect/dbconnect.php';
$project_id = $_GET['p_id'];            //getting project id
?>
<div class="usersview">
        <table border="1">
    <?php
$query_users_view = "SELECT * FROM assigned_member WHERE project_id='$project_id'";
$result_view = mysqli_query($conn, $query_users_view);

if ($result_view) {
    $num_view = mysqli_num_rows($result_view);

    if ($num_view > 0) {
        ?>
        <!-- select element outside the loop -->
        <select name="user_name" id="">
            <?php
            while ($row = mysqli_fetch_assoc($result_view)) {
                $user_id = $row['user_id'];

                // Fetch user details from the users table using the foreign key from the assigned_member table.
                if ($user_id > 0) {
                    $query_user_view = "SELECT * FROM users WHERE id='$user_id'";
                    $user_result_view = mysqli_query($conn, $query_user_view);

                    if ($user_result_view) {
                        $num_user_view = mysqli_num_rows($user_result_view);

                        if ($num_user_view > 0) {
                            $user_row = mysqli_fetch_assoc($user_result_view);
                            $user_id = $user_row['id'];
                            $fullname = $user_row['fullname'];
                            ?>
                            <!-- Select option inside the loop -->
                            <option value="<?php echo $user_id; ?>"><?php echo $fullname; ?></option>
                            <?php
                        } else {
                            echo "unsuccessful to connect the user";
                        }
                    }
                }
            }
            ?>
        </select>
        <?php
    } else {
        ?><select name="" id=""><option value=""><?php echo "Assign the users to the project first.";?></option></select>
        <?php
    }
} else {
    echo "error to connect";
}
?>

</table>
</div>
