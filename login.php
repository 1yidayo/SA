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

// 檢查帳號是否存在
$check_user_sql = "SELECT * FROM users WHERE username = '$username'";
$check_user_result = mysqli_query($link, $check_user_sql);
if (mysqli_num_rows($check_user_result) == 0) {
    echo "<script>alert('帳號未註冊，請先註冊'); window.location.href = 'register.html';</script>";
    exit();
}

$sql = "select * from users where username = '$username' and password = '$password'";
$result = mysqli_query($link, $sql);
if($row = mysqli_fetch_assoc($result)){
    $_SESSION['userID'] = $row['userID'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['level'] = $row['level'];
    $userID = $_SESSION['userID'];
    if($row['level'] === 'cl'){
        $userID = $row['userID'];

        $check_sql = "SELECT identityID FROM identity WHERE userID = '$userID'";
        $check_result = mysqli_query($link, $check_sql);

        if ($identity_row = mysqli_fetch_assoc($check_result)) {
            $_SESSION['identityID'] = $identity_row['identityID'];
            header("Location: cl.html");
            exit();
        } else {
            header("Location: insert.cl.html");
            exit();
        }
    } elseif($row['level'] === 'en') {
        $userID = $row['userID'];

        $check_sql = "SELECT identityID FROM identity WHERE userID = '$userID'";
        $check_result = mysqli_query($link, $check_sql);

        if ($identity_row = mysqli_fetch_assoc($check_result)) {
            $_SESSION['identityID'] = $identity_row['identityID'];
            header("Location: en.html");
            exit();
        } else {
            header("Location: insert.en.html");
            exit();
        }
    } elseif($row['level'] === 'ai') {
        $userID = $row['userID'];

        $check_sql = "SELECT identityID FROM identity WHERE userID = '$userID'";
        $check_result = mysqli_query($link, $check_sql);

        if ($identity_row = mysqli_fetch_assoc($check_result)) {
            $_SESSION['identityID'] = $identity_row['identityID'];
            header("Location: ai.html");
            exit();
        } else {
            header("Location: insert.ai.html");
            exit();
        }
    } elseif($row['level'] === 'de') {
        $userID = $row['userID'];

        $check_sql = "SELECT identityID FROM identity WHERE userID = '$userID'";
        $check_result = mysqli_query($link, $check_sql);

        if ($identity_row = mysqli_fetch_assoc($check_result)) {
            $_SESSION['identityID'] = $identity_row['identityID'];
            header("Location: de.html");
            exit();
        } else {
            header("Location: insert.de.html");
            exit();
        }
    } elseif($row['level'] === 'sc') {
        header("Location: sc.html");
    }
} else {
    echo "<script>alert('登入失敗！帳號或密碼錯誤'); history.back();</script>";
    exit();
}
?>



</html>