<?php
include '../dbconnect/dbconnect.php'; 
session_start();
$userType= $_SESSION["user_type"];
// echo $userType;
include '../persistLogin.php';
?>
<?php
if($userType=='admin')
{
    include 'dbconnect.php';
    $id = $_GET['id'];
    $query="DELETE FROM users where Id=$id";
    $result=mysqli_query($conn,$query);
    if($result)
        {
            header('Location: userlist.php');
        }
        else
        {
            echo "error";
        }
}
                    
?>