<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    if(empty($login) || empty($password)){
        header("Location: ../login.php");
        exit;
    }
    if ($login == 'admin' && $password == 'admin'){
        $_SESSION['login'] = $login;
        $_SESSION['role'] = 'admin';
        header("Location: ../admin.php");
        exit;
    }
    else{
        $_SESSION['login'] = $login;
        $_SESSION['role'] = 'user';
        header("Location: ../user.php");
        exit;
    }
}
?>
<!Doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form action="index.php" method="post">
    <input type="text" name="login">
    <input type="password" name="password">
    <button name="submit">submit</button>
</form>
</body>
</html>