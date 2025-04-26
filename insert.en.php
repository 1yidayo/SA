<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$enterprise = $_POST["enterprise"];
$type = $_POST["type"];
$code = $_POST["code"];
$ins = $_POST["ins"];
$userID = $_POST['userID'];

$link = mysqli_connect('localhost', 'root', '', 'SA');

$sql = "INSERT INTO en_identity(enterprise, type, code, ins, userID) VALUES
 ('$enterprise', '$type', '$code', '$ins', '$userID')";

    if (mysqli_query($link, $sql)) {
        echo "新增完成";
    } else {
        echo "新增失敗";
    }
?>
</body>
</html>