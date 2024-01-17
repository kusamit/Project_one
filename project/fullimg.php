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
<img style="height:100%" src="<?php echo $_GET['url'];?>" alt="">
</div>


<?php
        }
    ?>
</body>
</html>