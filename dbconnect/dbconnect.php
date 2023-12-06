<?php
$_SERVER="localhost";
$_username="root";
$_password="";
$_db="project_management_system";
$conn=mysqli_connect($_SERVER,$_username,$_password,$_db);
if(!$conn)
{
    echo "connection fail";
}
else
{
    echo "";
}

?>