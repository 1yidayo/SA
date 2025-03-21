<?php
    session_start();
    $Account = $_POST['Account'];
    $Password = $_POST['Password'];
    $role = $_POST['role'];

    $link = mysqli_connect('localhost', 'root', '', 'test1');
    $sql = "select * from users where Account = '$Account' and Password = '$Password'";
    $result = mysqli_query($link, $sql);
    if($row = mysqli_fetch_assoc($result)){
        $_SESSION['Account'] = $row['Account'];
        $_SESSION['role'] = $row['role'];
        if($row['role'] === 'club'){
            header("Location: club.html");
            exit();
        }
        else{
            echo "<center><h1>無效的身分</h1></center>";
        }
    } else{
        echo "<h1>登入失敗！！！</h1>";
    }
?>