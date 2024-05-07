<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Viewer</title>
    <style>

        embed, img {
            height:100vh;
            width:100vw;
        }
    </style>
</head>
<body>
    <?php
    $file_url = $_GET['url'];
    $file_extension = strtolower(pathinfo($file_url, PATHINFO_EXTENSION));

    if ($file_extension == 'pdf') {
        ?>
        <embed src="<?php echo $file_url; ?>" type="application/pdf" />
        <?php
    } elseif (in_array($file_extension, array('jpg', 'jpeg', 'png', 'gif'))) {
        ?>
        <img src="<?php echo $file_url; ?>" alt="Image">
        <?php
    } else {
        ?>
        <p>Unsupported file format</p>
        <?php
    }
    ?>
</body>
</html>
