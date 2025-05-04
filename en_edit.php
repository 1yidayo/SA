<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta http-equiv="refresh" content="0; url=self.en.php">
</head>
<body>
<?php
session_start();
$enterprise = $_POST['enterprise'];
$entype = $_POST['entype'];
$code = $_POST['code'];
$enins = $_POST['enins'];
$userID = $_SESSION['userID'];

$link = mysqli_connect('localhost', 'root', '', 'SAS');
$sql = "UPDATE identity SET enterprise = '$enterprise', entype = '$entype', code = '$code', enins = '$enins' WHERE userID = '$userID'";
if (mysqli_query($link, $sql)) {
   
    echo "<script>alert('更新成功'); self.en.php();</script>";
} else {
    echo "<script>alert('更新失敗'); window.history.back();</script>";
}
?>
    </body>
</html>