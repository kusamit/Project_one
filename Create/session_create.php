<?php
session_start();
if (isset($_SESSION['Login_session'])) 
{       
?>
    <div class="Admin">
        <?php 
            $login_id=$_SESSION['Login_session'];
            echo $login_id ;
        ?>
    </div>
    <?php
} 
else 
{
    header("location:../Credentials/login.php");
}
?>