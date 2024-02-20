<?php
session_start();
if(isset($_GET['id'])) 
{
    session_destroy();
    header("Location:login.php");
    exit();
} else 
{
    header("Location:login.php");
    exit();
}
?>
