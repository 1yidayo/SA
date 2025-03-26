<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社團企業媒合平台</title>
</head>
<?php
    session_start();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $link = mysqli_connect('localhost', 'root', '', 'SA');
    $sql = "select * from users where username = '$username' and password = '$password'";
    $result = mysqli_query($link, $sql);
    if($row = mysqli_fetch_assoc($result)){
        $_SESSION['username'] = $row['username'];
        $_SESSION['level'] = $row['level'];
        if($row['level'] === 'cl'){
            header("Location: cl.html");
            exit();
        } elseif($row['level'] === 'en') {
            header("Location: en.html");
            exit();
        } elseif($row['level'] === 'ai') {
            header("Location: ai.html");
            exit();
        } elseif($row['level'] === 'de') {
            header("Location: de.html");
            exit();
        } elseif($row['level'] === 'sc') {
            header("Location: sc.html");
        }
        else{
            echo "<center><h1>無效的身分</h1></center>";
        }
    } else{
        echo "<h1>登入失敗！！！</h1>";
    }
?>
</html>