<?php
session_start();

$enterprise = $_POST["enterprise"] ?? '';
$entype = $_POST["entype"] ?? '';
$enplace = $_POST["enplace"] ?? '';
$code = $_POST["code"] ?? '';
$enperson = $_POST["enperson"] ?? '';
$enins = $_POST["enins"] ?? '';
$enphone = $_POST["enphone"] ?? '';
$userID = $_SESSION['userID'] ?? '';

// 多選欄位
$enprefer = isset($_POST["collab"]) ? implode(",", $_POST["collab"]) : '';
$endonate = isset($_POST["sponsor"]) ? implode(",", $_POST["sponsor"]) : '';

// 資料庫連線
$link = mysqli_connect('localhost', 'root', '', 'SAS');

if (empty($enterprise) || empty($entype) || empty($code) || empty($enins)) {
    echo "<script>alert('請填寫完整所有欄位！'); window.history.back();</script>";
    exit();
}

// SQL 寫入
$sql = "INSERT INTO identity (enterprise, entype, enplace, code, enperson, enins, enphone, userID, enprefer, endonate)
        VALUES ('$enterprise', '$entype', '$enplace', '$code', '$enperson', '$enins', '$enphone', '$userID', '$enprefer', '$endonate')";

if (mysqli_query($link, $sql)) {
    echo "<script>alert('新增成功'); location.href='index_en.php';</script>";
} else {
    echo "<script>alert('新增失敗'); window.history.back();</script>";
}
?>
