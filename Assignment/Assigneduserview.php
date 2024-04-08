<?php
if (!empty($project_id)) 
{
    $query_assigned_view = "SELECT * from assigned_member where project_id='$project_id'";
    $result_assigned = mysqli_query($conn, $query_assigned_view);
    $user_assigned = mysqli_num_rows($result_assigned);
    $assigned_name = ''; // Initialize supervised_name for each project
    if ($user_assigned > 0) {
        ?>
<b>Assigned User</b>
<hr>
<?php
        while ($assigned_row = mysqli_fetch_assoc($result_assigned)) {
            $assigned_user_id = $assigned_row['user_id'];
            if (!($assigned_user_id == '0')) {
                $query_user_view = "SELECT * from users where id='$assigned_user_id'";
                $result_view = mysqli_query($conn, $query_user_view);
                $num_view = mysqli_num_rows($result_view);
                if ($num_view > 0) {
                    while ($user_row = mysqli_fetch_assoc($result_view)) {
                        $user_id = $user_row['id'];
                        $users_name = $user_row['fullname'];
                        echo $users_name; 
                        ?>
                        <br>
                        <?php
                    }
                } else {
                    echo "No Assigned Member yet.";
                }
            }
        }
    } 
}
?>
