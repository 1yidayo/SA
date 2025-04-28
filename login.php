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
            }
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