<?php
session_start();
$userID = $_SESSION['userID'];
$link = mysqli_connect('localhost', 'root', '', 'SA');

$targetDir = 'uploads/';

// 找到目前使用者的頭像
$query = "SELECT profile_img FROM identity WHERE userID = '$userID'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
$currentImg = $row['profile_img'];

// 如果不是預設圖就刪除
if (!empty($currentImg) && $currentImg !== 'default-profile.png') {
    $filePath = $targetDir . $currentImg;
    if (file_exists($filePath)) {
        unlink($filePath);
    }
}

// 更新資料庫欄位（改回 default）
$update = "UPDATE identity SET profile_img = 'default-profile.png' WHERE userID = '$userID'";
mysqli_query($link, $update);

// 回到個人頁面
echo "<script>alert('已刪除照片'); window.location.href='self.cl.php';</script>";
?>
