<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PMS</title>
</head>
<body>
    <h1>Login | PMS</h1>
    <form action="loginFunc.php">
    <label for="">Username</label><br>
       <label for=""><input type="text" name="username" id=""></label><br>
        <label for="">Password</label><br>
        <label for=""><input type="password" name="password" id=""></label><br>
        <select name="authentication" id="">
            <option value="1" >Admin</option>
            <option value="2">Foreman</option>
            <option value="3">User</option>
            <label for=""><input type="submit" value="login" name="login"></label>
        </select>
    </form>
</body>
</html>