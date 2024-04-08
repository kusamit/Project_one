<?php 
// Output Assigned name if assigned
if (!empty($project_id)) 
{
    $query_assigned_view = "SELECT * from assigned_member where project_id='$project_id'";
    $result_assigned = mysqli_query($conn, $query_assigned_view);
    $foreman_assigned = mysqli_num_rows($result_assigned);
    $supervised_name = ''; // Initialize supervised_name for each project
    if ($foreman_assigned > 0) {
        while ($assigned_row = mysqli_fetch_assoc($result_assigned)) {
            $assigned_foreman_id = $assigned_row['foreman_id'];
            if (!($assigned_foreman_id == '0')) {
                $query_foreman_view = "SELECT * from users where id='$assigned_foreman_id'";
                $result_view = mysqli_query($conn, $query_foreman_view);
                $num_view = mysqli_num_rows($result_view);
                if ($num_view > 0) {
                    while ($user_row = mysqli_fetch_assoc($result_view)) {
                        $assigned_foreman_id = $user_row['id'];
                        $supervised_name = $user_row['fullname'];
                    }
                }
            }
        }
    } 
}
?>