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
            margin-left:10px;
            
        }
        table,tr
        {
            margin-right:10px;
            padding:10px;
            padding-left:50px;
            padding-top:1px;
            text-align:center;
            align-items:center;
            /* max-width:25rem; */
        }
        td
        {
            /* max-width:25rem; */
            margin-right:10px;
            padding:10px;
            padding-left:20px;
            padding-top:1px;
            text-align:center;
            align-items:center;
        }
        th
        {
            /* max-width:25rem; */
            padding:10px;
            padding-left:20px;
            padding-top:1px;
            text-align:center;
            align-items:center;
            margin:0px;
        }
        h4
        {
            float:right;
            margin-right:30px;
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
        .btn
        {
            border:0px;
            border-radius:5px;
            padding:2px;
            font-size:13px;
        }
        .btn_p
        {
            background-color:#ffdb4d;
            color:black;
            border:0px;
            border-radius:5px;
            padding:2px;
        }
        .btn_s
        {
            color:black;
            background-color:#ff5c33;
            border:0px;
            border-radius:5px;
            padding:2px;
        }
        .btn_c
        {
            color:black;
            border:0px;
            border-radius:5px;
            padding:2px;
            background-color:#00e600;

        }
        .control,img
        {
            height:20px;
            width:20px;
            margin:1px;
            padding:3px;
        }
        .control_img
        {
            height:17px;
            width:17px;
        }
        #file
        {
            width:9rem;

            font-size:10px;
            height:max-content;
            border:0px;
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
            <div class="insert" id="">
            
                <form action="" method="POST">
                <input type="text" name=insert placeholder="List the Tasks" required id="insert" >
                <h4><?php echo '<p><strong>'?>

<!-- For Current Time and Date -->
<div id="reloadDiv">
    <p id="timeupdate">
        <?php
        date_default_timezone_set("Asia/Kathmandu");
        $now_timestamp = strtotime(date('Y-m-d H:i:s'));
        echo date('Y-m-d H:i:s');
        ?>
    </p>
</div>

<!-- java Script for Current time -->
<script>
    function reloadDiv() {
        // Fetching updated time
        var currentDate = new Date();
        var hours = currentDate.getHours();
        var minutes = currentDate.getMinutes();
        var seconds = currentDate.getSeconds();
        var ampm = hours >= 12 ? 'PM' : 'AM';

        //12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12; 
        var formattedTime = hours + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds + ' ' + ampm;
        var updatedDate = new Date().toLocaleDateString();
        document.getElementById('timeupdate').innerHTML = "Current Date:    " + updatedDate + " <br><br>Current Time:    " + formattedTime;
    }
    setInterval(reloadDiv, 1000);    // 1-second reload
</script>

                <?php '</strong></p>'; ?></h4><br>
                
                <!-- deadline date -->
                Deadline<input type="datetime-local" name="dt" id="" >
                
                <input type="submit" value="Add" name="submit" id="add" >
                <?php
                    include 'dbconnect.php';
                    if(isset($_POST['submit']))
                    {
                        $cat_id = $_GET['id'];
                        $insert=$_POST['insert'];
                        $datetime=$_POST['dt'];
                        if(!empty($datetime) && !empty($insert)){
                        $query="INSERT INTO sub_task_mgmt (message, cat_id,end_date_time) 
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
            </div>

           <!-- task management open -->
           <form action="" method="POST" enctype="multipart/form-data">
<p><b>Tasks</b></p>
<hr>
<table border="0">
<tr>
    
</tr>
</table>
<?php
    include 'dbconnect.php';

    $cat_id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    $sql = "SELECT * FROM sub_task_mgmt WHERE cat_id = $cat_id";
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
            <th>Progress</th>
            <th>Progress Report</th>
            <th>Action</th>
            <th>Controls</th>
        </tr>
    <?php
    $count = 1; // Initialize the count variable

    // Check condition function is not already defined the date and time
    if (!function_exists('getDateTimeDiff')) {
        function getDateTimeDiff($end_date_time) {
            date_default_timezone_set("Asia/Kathmandu");
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
    $rowId = $row['Id'];
    $progress_status = $row['progress'];
    // $completed = $row['completed'];
    $completed = $row['review'];
    ?>
    <tr id="row_<?php echo $rowId; ?>">
        <td style='padding: 10px;'><?php echo $count; ?></td>
        <td style='padding: 10px; max-width:15rem;'><?php echo $msg; ?></td>
        <td><?php echo $end_time; ?></td>
        <td>
            <?php
            echo '<p> ' . getDateTimeDiff($end_time) . '</p>';
            ?>
        </td>
        <td><?php if ($completed==1)
            {echo "<p style='background-color:#00e600;' class='btn'>Submitted In-Review</p>";}
            else if($progress_status==1){ echo "<p style='background-color:#ffdb4d;' class='btn'>In-Progress</p>";}
            else if($completed ==NULL && $progress_status==NULL)
            {echo "";}
            else if($suspend=1)
            {echo "<p style='background-color:#ff5c33;' class='btn'>Progress Suspended</p>";}
            ?>
        </td>
        <td><input type="file" name="doc" id="file"></td>
        <td>
            <?php if(getDateTimeDiff($end_time) !== "expired"): ?>
                <button class="btn_p" onclick="updateStatus('<?php echo $rowId; ?>', 'progress')">Progress</button>
                <button class="btn_s" onclick="updateStatus('<?php echo $rowId; ?>', 'suspend')">Suspend</button>
                <button class="btn_c" onclick="updateStatus('<?php echo $rowId; ?>', 'completed')">Completed</button>
            <?php endif; ?>
        <hr>
        </td>
        <td>
            <!-- Edit and Delete Controls -->
            <a href='update_task.php?id=<?php echo $rowId; ?>&cat_id=<?php echo $cat_id; ?>'class="control">
            <img src='edit.png' alt='image' title='Edit'></a>
            <a href='delete.php?id=<?php echo $rowId; ?>&cat_id=<?php echo $cat_id; ?>'>
            <img src='delete.png' alt='image' title='Delete'class="control_img">
            </a>
            <hr>
        </td>
    </tr>
    <?php
    $count++;
}
?>
</table>

<!-- JavaScript code -->
<script>
    
function updateStatus(rowId, status) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            console.log(response);
            location.reload();
            if (status == 'progress') {
                var button = document.getElementById('row_' + rowId).querySelector('button');
                button.style.backgroundColor = 'yellow';
                button.innerHTML = 'In-Progress';
            }else if(status=='completed')
            {
                var buttonc = document.getElementById('row_' + rowId).querySelector('button');
                buttonc.style.backgroundColor = 'green';
                buttonc.innerHTML = 'Completed';
            }
            
        }
    };
    xhr.open('POST', "update_status.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("rowId=" + rowId + "&status=" + status);
}

</script>
<?php
} else {
    echo "No records found.";
}
?>
</form>
    </body>
</html>