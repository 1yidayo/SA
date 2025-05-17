<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社團企業媒合平台</title>
</head>
<body>
<?php
session_start();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$level = $_POST['level'] ?? '';

$link = mysqli_connect('localhost', 'root', '', 'SAS');

$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($link, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    $_SESSION['userID'] = $row['userID'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['level'] = $row['level'];
    $userID = $row['userID'];

    if ($row['level'] === 'cl' || $row['level'] === 'en' || $row['level'] === 'ai' || $row['level'] === 'de') {
        $check_sql = "SELECT identityID FROM identity WHERE userID = '$userID'";
        $check_result = mysqli_query($link, $check_sql);

        if ($identity_row = mysqli_fetch_assoc($check_result)) {
            $_SESSION['identityID'] = $identity_row['identityID'];
            if ($row['level'] === 'cl') {
                header("Location: cl.php");
                exit();
            } elseif ($row['level'] === 'en') {
                header("Location: en.php");
                exit();
            } elseif ($row['level'] === 'ai') {
                header("Location: ai.html");
                exit();
            } elseif ($row['level'] === 'de') {
                header("Location: de.html");
                exit();
            }
        } else {
            if ($row['level'] === 'cl') {
                header("Location: insert.cl.html");
                exit();
            } elseif ($row['level'] === 'en') {
                header("Location: insert.en.php");
                exit();
            } elseif ($row['level'] === 'ai') {
                header("Location: insert.ai.html");
                exit();
            } elseif ($row['level'] === 'de') {
                header("Location: insert.de.html");
                exit();
            }
        }

    } elseif ($row['level'] === 'sc') {
        header("Location: sc.html");
        exit();
    } else {
        echo "<script>alert('登入失敗（帳號或密碼錯誤）！'); window.history.back();</script>";

        exit();
    }
} else {
    echo "<script>alert('登入失敗（未註冊身份）！'); window.history.back();</script>";

}
?>
</body>
</html>
