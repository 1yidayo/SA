<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>
<body>
<?php
session_start();

$school = $_POST["school"];
$club = $_POST["club"];
$clsize = $_POST["clsize"];
$clyear = $_POST["clyear"];
$cltype = $_POST["cltype"];
$clins = $_POST["clins"];
$userID = $_SESSION['userID'];

$link = mysqli_connect('localhost', 'root', '', 'SA');

$sql = "INSERT INTO identity(school, club, clsize, clyear, cltype, clins, userID) VALUES
 ('$school', '$club', '$clsize', '$clyear', '$cltype', '$clins', '$userID')";

if (empty($school) || empty($club) || empty($clsize) || empty($clyear) || empty($cltype) || empty($clins)) {
    echo "<script>alert('請填寫完整所有欄位！'); window.history.back();</script>";
    exit();
}

$sql = "INSERT INTO identity(school, club, clsize, clyear, cltype, clins, userID) 
        VALUES ('$school', '$club', '$clsize', '$clyear', '$cltype', '$clins', '$userID')";

if (mysqli_query($link, $sql)) {
    echo "<script>alert('新增完成！將自動返回首頁'); window.location.href='cl.html';</script>";
} else {
    echo "<script>alert('新增失敗，請重新填寫！'); window.history.back();</script>";
}
?>
</body>
</html>