<?php
session_start();
$userID = $_SESSION['userID'];
$link = mysqli_connect('localhost', 'root', '', 'SA');

if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] === 0) {
    $file = $_FILES['profile_img'];
    $fileName = basename($file['name']);
    $targetDir = 'uploads/';
    $targetFile = $targetDir . $fileName;

    // 建立 uploads 資料夾（如果不存在）
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // 移動檔案並更新資料庫
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        $sql = "UPDATE identity SET profile_img = '$fileName' WHERE userID = '$userID'";
        mysqli_query($link, $sql);
        echo "<script>alert('上傳成功'); window.location.href='self.cl.php';</script>";
    } else {
        echo "<script>alert('檔案儲存失敗'); history.back();</script>";
    }
} else {
    echo "<script>alert('請選擇檔案'); history.back();</script>";
}
?>
