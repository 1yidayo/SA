<?php
session_start();

$link = mysqli_connect("localhost", "root", "", "SAS");

// 檢查是否有傳入 clrequirement_num
if (isset($_GET['clrequirement_num'])) {
    $num = intval($_GET['clrequirement_num']);
    $identityID = $_SESSION['identityID'];
    $sql = "DELETE FROM club_requirements WHERE clrequirement_num = $num AND identityID = '$identityID'";

    if (mysqli_query($link, $sql)) {
        header("Location: post.history_cl.php");
        exit;
    } else {
        die("刪除失敗：" . mysqli_error($link));
    }
} else {
    die("未提供要刪除的資料編號");
}
?>
