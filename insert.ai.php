<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta http-equiv="refresh" content="3; url=ai.html">
</head>
<body>
<?php
session_start();

$name = $_POST["name"];
$ainins = $_POST["ainins"];
$userID = $_SESSION['userID'];

$link = mysqli_connect('localhost', 'root', '', 'SA');

$sql = "INSERT INTO identity(name, ainins, userID) VALUES
 ('$name', '$ainins', '$userID')";

if (empty($name) || empty($ainins)) {
    echo "<script>alert('請填寫完整所有欄位！'); window.history.back();</script>";
    exit();
}

if (mysqli_query($link, $sql)) {
    $identityID = mysqli_insert_id($link);
    $_SESSION['identityID'] = $identityID;
    echo "新增完成";
    } else {
        echo "新增失敗";
    }
?>
</body>
</html>