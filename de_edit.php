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
$userID = $_SESSION['userID'];

$link = mysqli_connect('localhost', 'root', '', 'SAS');
$sql = "UPDATE identity SET deschool = '$deschool', dename = '$dename', desize = '$desize', 
deyear = '$deyear', deins = '$deins' WHERE userID = '$userID'";
if (mysqli_query($link, $sql)) {
    echo "更新成功";
} else {
    echo "更新失敗";
}
?>
    </body>
</html>
