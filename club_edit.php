<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <meta http-equiv="refresh" content="3; url=self.cl.php">
</head>
<body>
<?php
session_start();
$school = $_POST['school'];
$club = $_POST['club'];
$clsize = $_POST['clsize'];
$clyear = $_POST['clyear'];
$cltype = $_POST['cltype'];
$clins = $_POST['clins'];
$userID = $_SESSION['userID'];

$link = mysqli_connect('localhost', 'root', '', 'SA');
$sql = "UPDATE identity SET school = '$school', club = '$club', clsize = '$clsize', 
clyear = '$clyear', cltype = '$cltype', clins = '$clins' WHERE userID = '$userID'";

if (mysqli_query($link, $sql)) {
    // 成功就跳出 alert 並跳轉
    echo "<script>
        alert('更新成功');
        window.location.href = 'http://localhost/SA/self.cl.php';
    </script>";
} else {
    // 失敗也用 alert 顯示錯誤
    echo "<script>
        alert('更新失敗');
        window.location.href = 'http://localhost/SA/self.cl.php';
    </script>";
}
?>

    </body>
</html>