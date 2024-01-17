<?php
// include '../session.php';
include '../dbconnect/dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="1">
<div class="project_info">
    <?php
    if (isset($_GET['id'])) {
        $project_id = $_GET['id'];
    ?>
<?php
$sql="select * from project where id=$project_id" ;
$result_view=mysqli_query($conn,$sql);
if($result_view)
{
    echo "";
}
else
{
    echo "error database connection";
}
$num_view=mysqli_num_rows($result_view);
$row_view=mysqli_fetch_assoc($result_view);
$fetched_file=$row_view['file'];
?>
<tr>
    <th><?php echo $row_view['project_name'] ;?></th>
</tr>
<tr><th> <a href="fullimg.php?url=<?php echo $row_view['file'] ; ?>">
<img style="height:30rem" src="<?php echo $row_view['file'] ; ?>">
</a>
</th>
    </tr>
<?php
    }
    ?>
</div>

</table>

<!-- Button -->
    <?php
  if (isset($_GET['id'])) {
    $project_id = $_GET['id'];
    echo $project_id;
    echo $project_id;
}
?>
<a href="add_member.php?id=<?php echo $project_id; ?>">
    <button>+</button>
</a>

    
</body>
</html>