<?php


if (!isset($_SESSION['Login_session']) && !$_SESSION['Login_session'] && !isset($_SESSION["login"])) {
    header("Location: http://localhost/projectmanagementsystem/credentials/login.php");
    exit();
}

?>
