
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
            <th>Status</th>
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
            <td data-id="<?php echo $row['id']; ?>" onclick="assign_member('<?php echo $row['id'] ?>','<?php echo $row['department_name'] ?>','<?php echo $row['dpt_id']?>')">
    <?php
      $id = $row['id'];
            $sqls = "select Id,isAssigned from assigned_member where user_id = '$id'";
            $results = mysqli_query($conn,$sqls);
            $rows= mysqli_fetch_array($results);

            if ($rows['isAssigned'] == 1) {
                echo "Assigned";
            } elseif ($rows['isAssigned'] == 0) {
                echo "Unassigned";
            }
    ?>
</td>

            <!-- <td onclick="
            
            assign_member('<?php //echo $row['id'] ?>','<?php //echo $row['department_name'] ?>','<?php //echo $row['dpt_id']?>')"
            
            > -->
            <?php

            // $id = $row['id'];
            // $sqls = "select Id,isAssigned from assigned_member where user_id = '$id'";
            // $results = mysqli_query($conn,$sqls);
            // $rows= mysqli_fetch_array($results);

            // initial its should be unAssignned if isAssigned = 0,
            // when clicked on this it should say Assigned
            // When clicked on unAssigned (yes), it convert the it unAssigned
            // Again when clicked on Unassigned, it convert to Assigned.


            // if($rows['isAssigned'] == 1){
            //     echo "Assigned";
            // }else if ($rows['isAssigned'] == 0){
            //     echo "Unassigned";

            // }
           

                // if($rows['isAssigned'] == 1 ){echo "Assigned";}
                // elseif($rows['isAssigned'] == 0 ){
                //      echo "Unassigned";}
            ?>
        </td>
            <td onclick="unassign('<?php echo $row['id'] ?>')" style="cursor:pointer">Change</td>
    </tr>
            <?php
    }
        ?>
    </table>

    </form>
    <script>
      
        function assign_member(id,dname,did) {     
    console.log(id);
    if(isClicked == 0){
       
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
                console.log(response)
                location.reload();
            }
        }
        
    });
    

    }
} 
// }
function unassign(id) {
    console.log(id);
    $.ajax({
        type: 'POST',
        url: './unassign.php',
        data: { id: id },
        success: function (response) {
            console.log(response);
            if (response) {
                console.log(response);
                // Toggle between "Assigned" and "Unassigned"
                var cell = $('td[data-id="' + id + '"]');
                var currentState = cell.text().trim();
                var newState = currentState === "Assigned" ? "Unassigned" : "Assigned";
                cell.text(newState);
            }
        }
    });
}


// function unassign(id){
//     console.log(id)
//     $.ajax({
//         type: 'POST',
//         url: './unassign.php',
//         data: { id: id},
//         success: function(response) {
//             console.log(response);
//             if(response){
//                 console.log(response)
//                 location.reload();
//             }
//         }
//     });
   
// }


     </script>
