<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta http-equiv="refresh" content="0; url=en.html">
</head>
<body>
<?php
session_start();

$enterprise = $_POST["enterprise"];
$entype = $_POST["entype"];
$code = $_POST["code"];
$enins = $_POST["enins"];
$userID = $_SESSION['userID'];

$link = mysqli_connect('localhost', 'root', '', 'SAS');

$sql = "INSERT INTO identity(enterprise, entype, code, enins, userID) VALUES
 ('$enterprise', '$entype', '$code', '$enins', '$userID')";

if (empty($enterprise) || empty($entype) || empty($code) || empty($enins)) {
    echo "<script>alert('請填寫完整所有欄位！'); window.history.back();</script>";
    exit();
}


?>
</body>
</html>