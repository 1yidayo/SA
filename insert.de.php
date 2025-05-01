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

$deschool = $_POST["deschool"];
$dename = $_POST["dename"];
$desize = $_POST["desize"];
$deyear = $_POST["deyear"];
$deins = $_POST["deins"];
$userID = $_SESSION['userID'];

$link = mysqli_connect('localhost', 'root', '', 'SA');

$sql = "INSERT INTO identity(deschool, dename, desize, deyear, deins, userID) VALUES
 ('$deschool', '$dename', '$desize', '$deyear', '$deins', '$userID')";

if (
    !isset($deschool) || $deschool === '' ||
    !isset($dename) || $dename === '' ||
    !isset($desize) || $desize === '' ||
    !isset($deyear) || $deyear === '' ||
    !isset($deins) || $deins === ''
) {
    echo "<script>alert('請填寫完整所有欄位！'); window.history.back();</script>";
    exit();
}

if (mysqli_query($link, $sql)) {
    $identityID = mysqli_insert_id($link);
    $_SESSION['identityID'] = $identityID;
    echo "<script>alert('新增完成！'); window.location.href='de.html';</script>";
} else {
    echo "<script>alert('新增失敗，請重新填寫！'); window.history.back();</script>";
}
?>
</body>
</html>