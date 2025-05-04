<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社團企業媒合平台</title>
    <meta http-equiv="refresh" content="3; url=login.html">
</head>
<body>
<?php

    // 獲取使用者輸入
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $level = $_POST['level'] ?? '';

    // 連接 MySQL
    $link = mysqli_connect('localhost', 'root', '', 'SAS');
    if (!$link) {
        die("資料庫連接失敗：" . mysqli_connect_error());
    }

    // 1. 檢查帳號是否已存在
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo "帳號已存在，無法註冊";
    } else {
        // 2. 插入新帳號
        $sql = "INSERT INTO users (username, password, level) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $username, $password, $level);

        if (mysqli_stmt_execute($stmt)) {
        
            echo "<script>alert('註冊成功')</script>";
        } else {
            
            echo "<script>alert('註冊失敗！'); window.history.back();</script>";
            
        }
    }
?>
</body>
</html>
