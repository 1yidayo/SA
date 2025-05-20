<?php
session_start();
$userID = $_SESSION['userID'];
$link = mysqli_connect('localhost', 'root', '', 'SAS');

if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] === 0) {
    $file = $_FILES['profile_img'];
    $targetDir = 'uploads/';
    
    // 確保 uploads 資料夾存在
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    // 副檔名避免重名 加上 userID + timestamp
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newFileName = 'user_' . $userID . '_' . time() . '.' . $extension;
    $targetFile = $targetDir . $newFileName;

    // 先找出舊的圖片
    $query = "SELECT profile_img FROM identity WHERE userID = '$userID'";
    $result = mysqli_query($link, $query);
    $row = mysqli_fetch_assoc($result);
    $oldImage = $row['profile_img'];

    // 移動新圖並更新資料庫
    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        // 刪除舊圖（存在於 uploads 資料夾）
        if (!empty($oldImage) && file_exists($targetDir . $oldImage) && $oldImage !== 'default-profile.png') {
            unlink($targetDir . $oldImage);
        }

        // 更新資料庫
        $sql = "UPDATE identity SET profile_img = '$newFileName' WHERE userID = '$userID'";
        mysqli_query($link, $sql);

        echo "<script>alert('上傳成功'); window.location.href='self_cl.php';</script>";
    } else {
        echo "<script>alert('檔案儲存失敗'); history.back();</script>";
    }
} else {
    echo "<script>alert('請選擇檔案'); history.back();</script>";
}
?>
