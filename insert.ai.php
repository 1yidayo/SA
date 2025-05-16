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


$ainame = $_POST["ainame"];

$ainins = $_POST["ainins"];

$userID = $_SESSION['userID'];

$link = mysqli_connect('localhost', 'root', '', 'SAS');

$sql = "INSERT INTO identity( ainame,  ainins,  userID) VALUES
 ('$ainame',  '$ainins',  '$userID')";

if (
    !isset($ainame) || $ainame === '' ||
    !isset($ainins) || $ainins === '' 
) {
    echo "<script>alert('請填寫完整所有欄位！'); window.history.back();</script>";
    exit();
}


if (mysqli_query($link, $sql)) {
    $identityID = mysqli_insert_id($link);
    $_SESSION['identityID'] = $identityID;
    echo "<script>alert('新增完成！'); window.location.href='ai.html';</script>";
} else {
    echo "<script>alert('新增失敗，請重新填寫！'); window.history.back();</script>";
}
?>
</body>
</html>