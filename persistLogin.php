<?php


if (!isset($_SESSION['Login_session']) && !$_SESSION['Login_session'] && !isset($_SESSION["login"])) {
    header("Location: http://localhost/pms/credentials/login.php");
    exit();
}

?>
