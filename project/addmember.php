
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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



<div id=""></div>
    <form action="assigned_member.php" method="POST">
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
        $sql="SELECT * FROM user INNER JOIN department ON user.department_id=department.dpt_id";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0)
        while($row=mysqli_fetch_assoc($result))
    {
        

            ?>
        <tr>
            <td> <?php echo $row['fullname'] ?></td>
            <td><?php echo $row['department_name'] ?></td>
            <td onclick="assign_member('<?php echo $row['id'] ?>','<?php echo $row['department_name'] ?>','<?php echo $row['dpt_id']?>')">
            <?php

            $id = $row['id'];
            $sqls = "select isAssigned from assigned_member where user_id = '$id'";
            $results = mysqli_query($conn,$sqls);

                if(mysqli_num_rows($results)>0){echo "Assigned";}
                else{
                     echo "Unassigned";}
            ?>
        </td></tr>
            <?php
    }
        ?>
    </table>

    </form>
    <script>
        function assign_member(id,dname,did) {
    console.log(id);
    $.ajax({
        type: 'POST',
        url: './assigned_member.php',
        data: { id: id ,
                dname:dname,
                did:did
        },
        success: function(response) {
            console.log(response);
            if(response){
                location.reload();
            }
        }
    });
}

    </script>
