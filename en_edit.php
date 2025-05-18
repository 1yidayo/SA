<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta http-equiv="refresh" content="0; url=self_en.php">
</head>

<body>
    <?php
    session_start();

    // 收集表單資料
    $enterprise = $_POST['enterprise'];
    $entype = $_POST['entype'];
    $code = $_POST['code'];
    $enplace = $_POST['enplace'];
    $enperson = $_POST['enperson'];
    $enphone = $_POST['enphone'];
    $enins = $_POST['enins'];
    $enprefer = $_POST['enprefer'];
    $endonate = $_POST['endonate'];
    $userID = $_SESSION['userID'];

    // 連接資料庫
    $link = mysqli_connect('localhost', 'root', '', 'SAS');

    // 更新 SQL 查詢語句
    $sql = "UPDATE identity SET 
                enterprise = '$enterprise', 
                entype = '$entype', 
                code = '$code', 
                enplace = '$enplace',
                enperson = '$enperson', 
                enphone = '$enphone', 
                enins = '$enins', 
                enprefer = '$enprefer', 
                endonate = '$endonate'
            WHERE userID = '$userID'";

    // 執行 SQL 查詢
    if (mysqli_query($link, $sql)) {
        echo "<script>alert('更新成功');</script>";
    } else {
        echo "<script>alert('更新失敗'); window.history.back();</script>";
    }

    // 關閉資料庫連接
    mysqli_close($link);
    ?>
</body>

</html>
