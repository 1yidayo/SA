<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta http-equiv="refresh" content="3; url=cl.html">
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

if (mysqli_query($link, $sql)) {
    echo "新增完成";
} else {
    echo "新增失敗";
}
?>
</body>
</html>