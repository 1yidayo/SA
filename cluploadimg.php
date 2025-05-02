<?php
session_start();
$userID = $_SESSION['userID'];
$link = mysqli_connect('localhost', 'root', '', 'SA');

if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] == 0) {
    $targetDir = "uploads/";
    $filename = basename($_FILES["profile_img"]["name"]);
    $targetFile = $targetDir . uniqid() . "_" . $filename;
    move_uploaded_file($_FILES["profile_img"]["tmp_name"], $targetFile);

    // 存檔名到資料庫
    $imgName = basename($targetFile);
    $sql = "UPDATE identity SET profile_img = '$imgName' WHERE userID = '$userID'";
    mysqli_query($link, $sql);
}

header("Location: cl_self.php"); // 上傳完導回原頁面
exit();
