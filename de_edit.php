<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta http-equiv="refresh" content="3; url=self.de.php">
</head>
<body>
<?php
session_start();
$deschool = $_POST['deschool'];
$dename = $_POST['dename'];
$desize = $_POST['desize'];
$deyear = $_POST['deyear'];
$deins = $_POST['deins'];
$dephone = $_POST['dephone'];
$userID = $_SESSION['userID'];

$link = mysqli_connect('localhost', 'root', '', 'SAS');
$sql = "UPDATE identity 
        SET deschool = '$deschool', 
            dename = '$dename', 
            desize = '$desize', 
            deyear = '$deyear', 
            deins = '$deins', 
            dephone = '$dephone' 
        WHERE userID = '$userID'";

if (mysqli_query($link, $sql)) {
    // 成功就跳出 alert 並跳轉
    echo "<script>
        alert('更新成功');
        window.location.href = 'http://localhost/SA/self.de.php';
    </script>";
} else {
    // 失敗也用 alert 顯示錯誤
    echo "<script>
        alert('更新失敗');
        window.location.href = 'http://localhost/SA/self.de.php';
    </script>";
}
?>
    </body>
</html>
