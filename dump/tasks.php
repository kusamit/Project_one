<html>
    <head>
    <link rel="stylesheet" href="choosed.css">
    <style>
        .insert{
            margin:80px;
            padding:50px;
            /* border:5px solid green; */
            border-radius:10px;
            text-align:center;
            height:100px;
            width:30%;
            background-color: rgba(255, 255, 224, 0.486) ;
        }
        .view{
            background-color:rgba(255, 255, 224, 0.856) ;
            
            border:5px solid  rgba(255, 255, 224, 0.829) ;
            text-align:center;
            width:40%;
            border-radius:30px;
            font-size:40px;
             /* Set the desired width */
            height: 30rem; /* Set the desired height */
            overflow: auto;
                    }
        tr,td{
            font-size:30px;
            margin:10px;
            
        }
        
        button,a{
            padding:10px;
            text-decoration: none;
            margin-left:10px;
            font-size:15px;
            background-color:blue;
            color:white;
            border:0;
            border-radius:5px;
        }

    </style>
    </head>
    <body>
        <div class="header">
            
            <h3>
                
    <?php
        include 'dbconnect.php';
        $cat_id = $_GET["id"];
        $todo_sql = "SELECT name FROM todo_c where Id=$cat_id";
        $todo_result = mysqli_query($conn, $todo_sql);
        $todo_row = mysqli_fetch_assoc($todo_result);
        echo "<center>List Name<center>";
        echo "<center>".$todo_row["name"]. "</center>";
        ?>   
        </div>
        </h3>

        <!-- insert and view -->
        <button>
                <a href="Main_session_after_login.php">Home</a>
            </button>
        <div class="container">

        <!-- for insert -->

            <div class="insert">
                
                <form action="" method="POST">
                <input type="text" name=insert placeholder="Enter your Message" required style="width:100%;"><br><br>
                <input type="submit" value="Add" name="submit" >
                <?php
                    include 'dbconnect.php';
                    if(isset($_POST['submit']))
                    {
                        $cat_id = $_GET['id'];
                        $insert=$_POST['insert'];
                        $query="INSERT INTO list_msg (message, cat_id) values ('$insert', '$cat_id') ";
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
                 ?>
                 </form>
            </div>

            <!-- for view -->

            <div class="view">
                <center><b>ToDo List Live...</b> <hr>
                <?php
                    include 'dbconnect.php';
                    $cat_id = $_GET['id'];
                    $sql = "SELECT * FROM list_msg where cat_id=$cat_id";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $count = 1;
                        echo "<table border='0'>
                    ";
                    while ($row = mysqli_fetch_assoc($result)) { 
                        echo "<tr>
                        <td style='padding: 10px;'>" . $count  .".</td>
                        <td style='padding: 10px;'>" . $row['message'] . "</td>
                        <td> <a href='delete_l.php?id=".$row['Id']."&cat_id=".$cat_id."' style='background-color:white;'>
                        <img src='Delete.png'alt='image' height='15px' width='15px' ></a></td>

                        </tr>";
                        $count++;
                    }
                    echo "</table>";
                    } else {
                    echo "No records found.";}
                    mysqli_close($conn);



                    // delete item
                    "<map name='delete'>
                    
                    </map>
                    "
                ?>
                </center>
            </div>
        </div>
    </body>
</html>

