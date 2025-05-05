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

$enterprise = $_POST["enterprise"];
$entype = $_POST["entype"];
$code = $_POST["code"];
$enins = $_POST["enins"];
$enphone = $_POST["enphone"];
$enperson = $_POST["enperson"];
$enplace = $_POST["enplace"];
$enprefer = $_POST["enprefer"];
$endonate = $_POST["endonate"];
$userID = $_SESSION['userID'];

$link = mysqli_connect('localhost', 'root', '', 'SAS');

$sql = "INSERT INTO identity(enterprise, entype, code, enins, enphone, enperson, enplace, enprefer, endonate, userID) VALUES
 ('$enterprise', '$entype', '$code', '$enins', '$enphone', '$enperson', '$enplace', '$enprefer', '$endonate', '$userID')";

if (
    !isset($enterprise) || $enterprise === '' ||
    !isset($entype) || $entype === '' ||
    !isset($code) || $code === '' ||
    !isset($enins) || $enins === '' ||
    !isset($enphone) || $enphone === ''
    !isset($enperson) || $enperson === ''
    !isset($enplace) || $enplace === ''
    !isset($enprefer) || $enprefer=== ''
    !isset($endonate) || $endonate === ''
) {
    echo "<script>alert('請填寫完整所有欄位！'); window.history.back();</script>";
    exit();
}

if (mysqli_query($link, $sql)) {
    $identityID = mysqli_insert_id($link);
    $_SESSION['identityID'] = $identityID;
    echo "<script>alert('新增完成！'); window.location.href='en.html';</script>";
} else {
    echo "<script>alert('新增失敗，請重新填寫！'); window.history.back();</script>";
}
?>
</body>
</html>