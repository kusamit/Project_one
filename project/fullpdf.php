<?php
session_start();
include '../dbconnect/dbconnect.php';
$userType= $_SESSION["user_type"];
// echo $userType;
include '../persistLogin.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if($_GET['url']){
            ?>

<div style="height:100vh;width:100vw;">
<embed style="height:100%;width:100%;" src="<?php echo $_GET['url'];?>" type="application/pdf" />
</div>


<?php
        }
    ?>
</body>
</html>