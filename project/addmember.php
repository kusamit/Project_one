<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        table,tr,th
        {
            padding:30px;
            text-align:center;
        }
        td
        {
            padding:10px;
        }
        #assign{
            border:0px;
            background-color:darkblue;
            color:white;
            border-radius:10px;
            padding:1px;
        }
    </style>
</head>
<body>


<div id=""></div>
    <form action="" method="POST">
    <table>
        <tr>
            <th>
                Username
            </th>
            <th>Department</th>
            <th>Assign</th>
        </tr>
        <?php
        include '../dbconnect/dbconnect.php';
        $sql="SELECT * FROM user INNER JOIN department ON user.department_id=department.id";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0)
        while($row=mysqli_fetch_assoc($result))
    {
        

            ?>
        <tr>
            <td> <?php echo $row['fullname'] ?></td>
            <td><?php echo $row['department_name'] ?></td>
            <td onclick="assign_member('<?php echo $row[''] ?>')">Assign<td></tr>
            <?php
    }
        ?>
    </table>

    </form>
    <script>
        function assign_member(){

        }
    </script>
</body>
</html>