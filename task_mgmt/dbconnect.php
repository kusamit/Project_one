<?php
$server_name="localhost";
$_username="root";
$_password="";
$_db="PMS";
$conn=mysqli_connect($server_name,$_username,$_password,$_db);
if(!$conn) 
{
    echo "connection fail";
}
else
{
    echo "";
}

?>