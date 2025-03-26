<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社團企業媒合平台</title>
    <meta http-equiv = "refresh" content = "3; url = login.html">
</head>
<?php
        $username = $_POST['username'] ??'';
        $password = $_POST['password'] ??'';
        $level = $_POST['level'] ??'';

        $link = mysqli_connect('localhost', 'root', '', 'SA');
        $sql = "select * from users where username = '$username'";
        if (mysqli_query($link, $sql)) {
            echo "帳號已存在，無法註冊";
        } else {
        $sql = "insert into users (username, password, level) VALUES ('$username', '$password', '$level')";
        if (mysqli_query($link, $sql))
            {
                echo "註冊成功";
            }
            else
            {
                echo "註冊失敗";
            }
        }

            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            
    ?>
</html>