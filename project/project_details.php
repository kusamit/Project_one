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
<style>
    #project_name{
        margin-left:20px;
        padding:10px;
        font-size:35px;
        background-color: #664d00;
        color:white;
        /* width:fit-content; */
        border-radius:3px;
    }
    #project_details
    {
        width:50%;
        margin:20px;
    }
    #details
    {
        font-size:25px;
        margin-bottom:10px;
        padding:10px;
        font-style:bold;
        background-color:#b2b266;
        color:white;
        border-radius:3px;
    }
    #msg
    {
        font-size:10px;
    }
    #attached
    {
        margin:10px;
        margin-left:0px;
        padding:10px;
    }
    #file
    {
        margin:10px;
        padding:10px;
    }
</style>
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
$fetched_file_type=$row_view['file_type'];
$fetched_file=$row_view['file'];
$fetched_project_details=$row_view['project_details'];
?>
<div id="project_name"><?php echo $row_view['project_name'] ;?></div>
<div id="project_details">
    <div id="details">
    Project Details
    </div id='msg'>
        <?php echo $fetched_project_details; ?>
    </div>
    <div id="file">
        <div id="attached"><strong>Attached File</strong></div>
        <div id="project_file"><?php if($fetched_file_type==1){ ?>
        <a href="fullimg.php?url=<?php echo $row_view['file'] ; ?>?type=<?php echo $fetched_file_type; ?>">
        <img style="height:10rem; width:7rem;" src="<?php echo $row_view['file'] ; ?>"><br>View Image
        </a>
        <?php } elseif($fetched_file_type==2){?>
        <a href="fullpdf.php?url=<?php echo $row_view['file'] ; ?>?type=<?php echo $fetched_file_type; ?>">
        <embed style="height:10rem; width:7rem;" src="<?php echo $row_view['file']; ?>" type="application/pdf" /><br>View Pdf
        </a>
        <?php }?>
    </div>
    </div>
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