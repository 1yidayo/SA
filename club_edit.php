<?php
session_start();
$school = $_POST['school'];
$club = $_POST['club'];
$clsize = $_POST['clsize'];
$clyear = $_POST['clyear'];
$cltype = $_POST['cltype'];
$clins = $_POST['clins'];
$clphone = $_POST['clphone'];
$userID = $_SESSION['userID'];

$link = mysqli_connect('localhost', 'root', '', 'SAS');
mysqli_set_charset($link, "utf8"); // 設定編碼 中文

$sql = "UPDATE identity 
        SET school = '$school', 
            club = '$club', 
            clsize = '$clsize', 
            clyear = '$clyear', 
            cltype = '$cltype', 
            clins = '$clins', 
            clphone = '$clphone' 
        WHERE userID = '$userID'";

if (mysqli_query($link, $sql)) {
    echo "<script>
        alert('更新成功');
        window.location.href = 'self_cl.php';
    </script>";
} else {
    echo "<script>
        alert('更新失敗：" . mysqli_error($link) . "');
        window.location.href = 'self_cl.php';
    </script>";
}
?>
