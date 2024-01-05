<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
  if (isset($_GET['id'])) {
    $project_id = $_GET['id'];
    echo $project_id;
}
?>

<a href="add_member.php?id=<?php echo $project_id; ?>">
    <button>+</button>
</a>

    
</body>
</html>