<html>
    <head>
    <style>
        .view{
            background-color:rgba(255, 255, 224, 0.856) ;
            border-radius:10px;
            height:100%;
            overflow: scroll;
            width:100%;
            margin:0px;
            padding:0px;
            align-items:center;
         }
         .header
         {
            width:100%;
            background-color:red ;
            border-radius:20px;
            height:100%;
            background-color: rgba(255, 255, 224, 0.486) ;
            /* overflow: visible; */
            over
            margin:20px;
            padding:0px;
         }
        
        body{
            background-color:#018CB6;
            height:100%;
        }
        input
        {
            border:3px #8a8a5c solid;
            border-radius:10px;
            padding:2px;
        }
        #add{
            border-radius:20px;
            background-color:#33ff33;
            padding:8px;
            width:5rem;
            font-style:bold;
            border:0px;
            margin-top:10px;
        }
        #insert{
            text-align:center;
            width:40%;
            align-items:left;
            
        }
        table,tr,td
        {
            margin-right:10px;
            padding:10px;
            padding-left:50px;
            padding-top:1px;
            text-align:center;
            align-items:center;
        }
        th
        {
            padding:10px;
            padding-left:50px;
            padding-top:1px;
            text-align:center;
            align-items:center;
            margin:0px;
        }
        h4
        {
            float:right;
            margin-right:20px;
        }
        h5{
            color:darkred;
            margin:0px;
            padding:0px;
        }
        p{
            text-align:center;
        }
        .taskname
        {
            text-align:center;
        }
        img
        {
            height:25px; 
            width:25px;
            padding-left:10px;
        }
    </style>

    </head>
    <body>
        <div class="header">
        <div class="taskname"> <center>
        <?php
                    include 'dbconnect.php';
                    $cat_id = $_GET['id'];
                    $sql = "SELECT * FROM todo_c";
                    $result_task = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result_task) > 0) {
                        echo "<table border='0'>
                    ";
                    $row = mysqli_fetch_assoc($result_task); 
                        echo "<tr>
                        <td style='padding: 10px;'>" . $row['name']  ."</td>
                        "
                        ?>
                       
                        <?php
                        "</td>
                        </tr>";
                    echo "</table>";
                    } else {
                    echo "No records found.";}?>
                    
                    </center></div>
            <!-- for view -->
            <div class="view">
                <!-- insert the Tasks -->
            <div class="insert">
            
                <form action="" method="POST">
                <input type="text" name=insert placeholder="List the Tasks" required id="insert" >
                <h4><?php echo '<p>Current Time is: <br> <strong>' . date('Y-m-d H:i:s') . '</strong></p>'; ?></h4><br>
                EndTime <input type="datetime-local" name="dt" id="">
                <input type="submit" value="Add" name="submit" id="add" >
                <?php
                    include 'dbconnect.php';
                    if(isset($_POST['submit']))
                    {
                        $cat_id = $_GET['id'];
                        $insert=$_POST['insert'];
                        $datetime=$_POST['dt'];
                        if(!empty($datetime) && !empty($insert)){
                        $query="INSERT INTO list_msg (message, cat_id,end_date_time) 
                        values ('$insert', '$cat_id','$datetime') ";
                        $result=mysqli_query($conn,$query);
                        if($result)
                        {
                            // echo "$insert has been saved inthe List";  
                        }
                        else
                        {
                            echo "error";
                        }
                    }
                    else
                    {
                        echo "<h5>Please Enter Task Name and  Date-Time</h5>";
                    }
                }
                    
                 ?>
                 </form>
                 <!-- insert close!!!!!!!! -->
            </div>

           <!-- task management open -->
<p><b>Tasks</b></p>
<hr>
<table border="0">
<tr>
    
</tr>
</table>
<?php
    include 'dbconnect.php';

    // Sanitize user input to prevent SQL injection
    $cat_id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM list_msg WHERE cat_id = $cat_id";
    $result = mysqli_query($conn, $sql);

    // Check for errors in the query
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    if (mysqli_num_rows($result) > 0) {
        $count = 1;?>
        <table border='0'>
        <tr>
        <th style="padding:0px;">Sn.</th>
            <th style="padding:0px;">Tasks</th>
            <th>End Time</th>
            <th>Expiry</th>
            <th>Controls</th>
        </tr>
    <?php
    $count = 1; // Initialize the count variable

    // Check condition function is not already defined the date and time
    if (!function_exists('getDateTimeDiff')) {
        function getDateTimeDiff($end_date_time) {
            $now_timestamp = strtotime(date('Y-m-d H:i:s'));
            $end_timestamp = strtotime($end_date_time);
            $diff_timestamp = $end_timestamp - $now_timestamp;

            if ($diff_timestamp < 0) {
                return 'expired';
            } elseif ($diff_timestamp < 60) {
                return 'few seconds left';
            } elseif ($diff_timestamp >= 60 && $diff_timestamp < 3600) {
                return round($diff_timestamp / 60) . ' mins left';
            } elseif ($diff_timestamp >= 3600 && $diff_timestamp < 86400) {
                return round($diff_timestamp / 3600) . ' hours left';
            } elseif ($diff_timestamp >= 86400 && $diff_timestamp < (86400 * 30)) {
                return round($diff_timestamp / (86400)) . ' days left';
            } elseif ($diff_timestamp >= (86400 * 30) && $diff_timestamp < (86400 * 365)) {
                return round($diff_timestamp / (86400 * 30)) . ' months left';
            } else {
                return round($diff_timestamp / (86400 * 365)) . ' years left';
            }
        }
    } 
//fetched from the database
    while ($row = mysqli_fetch_assoc($result)) {
        $msg = $row['message'];
        $end_time = $row['end_date_time'];
        ?>
        <tr>
            <td style='padding: 10px;'><?php echo $count; ?></td>
            <td style='padding: 10px;'><?php echo $msg; ?></td>
            <td><?php echo $end_time; ?></td>
            <td>
                <?php
                echo '<p> ' . getDateTimeDiff($end_time) . '</p>';
                ?>
            </td>
            <td>
                <!-- edit -->
                <a href='delete_l.php?id=<?php echo $row['Id']; ?>&cat_id=<?php echo $cat_id; ?>'>
                    <img src='edit.png' alt='image' title='Edit'>
                </a>
                <!-- Delete -->
            </td>
        </tr>
        <?php
        $count++;
    }
    ?>
</table>
<?php
} else {
    echo "No records found.";
}
?>
    </body>
</html>