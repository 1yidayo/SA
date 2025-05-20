<?php
session_start();

$userID = $_SESSION['userID'];

$code = $_POST['code'] ?? '';
$enplace = $_POST['enplace'] ?? '';
$enperson = $_POST['enperson'] ?? '';
$enphone = $_POST['enphone'] ?? '';
$enins = $_POST['enins'] ?? '';
$endonate = $_POST['endonate'] ?? '';

// 處理合作偏好多選
$collab = '';
if (isset($_POST['collab']) && is_array($_POST['collab'])) {
    $collab = implode(',', $_POST['collab']);
}

$link = mysqli_connect('localhost', 'root', '', 'SAS');

if (!$link) {
    die("連接資料庫失敗：" . mysqli_connect_error());
}

$sql = "UPDATE identity SET 
            code = '$code',
            enplace = '$enplace',
            enperson = '$enperson',
            enphone = '$enphone',
            enins = '$enins',
            enprefer = '$collab',
            endonate = '$endonate'
        WHERE userID = '$userID'";

if (mysqli_query($link, $sql)) {
    // 更新成功跳回編輯頁（無 alert避免 header 衝突）
    header("Location: self_en.php");
    exit();
} else {
    echo "<script>alert('更新失敗'); window.history.back();</script>";
}

mysqli_close($link);
?>
