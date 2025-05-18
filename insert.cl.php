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
$clphone = $_POST["clphone"];
$userID = $_SESSION['userID'];

$link = mysqli_connect('localhost', 'root', '', 'SAS');

$sql = "INSERT INTO identity (school, club, clsize, clyear, cltype, clins, clphone, userID)
        VALUES ('$school', '$club', '$clsize', '$clyear', '$cltype', '$clins', '$clphone', '$userID')";


if (empty($school) || empty($club) || empty($clsize) || empty($clyear) || empty($cltype) || empty($clins)) {
    echo "<script>alert('請填寫完整所有欄位！'); window.history.back();</script>";
    exit();
}

if (mysqli_query($link, $sql)) {
    $identityID = mysqli_insert_id($link);
    $_SESSION['identityID'] = $identityID;
    echo "<script>alert('新增完成！'); window.location.href='index_cl.php';</script>";
} else {
    echo "<script>alert('新增失敗，請重新填寫！'); window.history.back();</script>";
}
?>
</body>
</html>