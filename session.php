<?php
session_start();
if (isset($_SESSION['Login_session'])) {
          
    ?>
    <div class="Admin"><?php echo $_SESSION['Login_session'];?></div>
    <?php
} else {
    header("location:./Credentials/login.php");
}
?>