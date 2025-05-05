<?php
session_start();

// 檢查是否登入與是否有必要資訊
if (!isset($_SESSION['identityID'])) {
    die("請先登入");
}

$link = mysqli_connect("localhost", "root", "", "SAS");

// 檢查連線
if (!$link) {
    die("連線失敗：" . mysqli_connect_error());
}

// 檢查是否有傳入 enrequirement_num
if (isset($_GET['enrequirement_num'])) {
    $num = intval($_GET['enrequirement_num']);
    $identityID = $_SESSION['identityID'];

    // 使用 prepared statement 避免 SQL injection
    $stmt = mysqli_prepare($link, "DELETE FROM en_requirements WHERE enrequirement_num = ? AND identityID = ?");
    mysqli_stmt_bind_param($stmt, "is", $num, $identityID);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        mysqli_close($link);
        header("Location: enhistory.php");
        exit;
    } else {
        echo "刪除失敗：" . mysqli_error($link);
    }
} else {
    echo "未提供要刪除的資料編號";
}
?>
