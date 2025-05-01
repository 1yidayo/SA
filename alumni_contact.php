<?php
session_start();

// 顯示錯誤訊息以方便除錯
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 檢查欄位是否都填寫
if (
    empty($_POST['name']) ||
    empty($_POST['ainins']) ||
    empty($_POST['money']) ||
    empty($_POST['region']) ||
    empty($_POST['event_time']) ||
    empty($_POST['support_type']) ||
    empty($_POST['hope']) ||
    empty($_POST['title']) ||
    empty($_POST['information'])
) {
    echo "<script>alert('請填寫所有欄位'); history.back();</script>";
    exit();
}

// 檢查登入身分
$identityID = $_SESSION['identityID'] ?? null;
if (!$identityID) {
    echo "<script>alert('尚未登入或身份未確認'); window.location.href='first.html';</script>";
    exit();
}

// 取得 POST 值
$money = $_POST['money'];
$name = $_POST['name'];
$ainins = $_POST['ainins'];
$region = $_POST['region'];
$event_time = $_POST['event_time'];
$support_type = $_POST['support_type'];
$hope = $_POST['hope'];
$title = $_POST['title'];
$information = $_POST['information'];

// 建立資料庫連線
$link = mysqli_connect('localhost', 'root', '', 'SA');
if (!$link) {
    die("資料庫連線失敗：" . mysqli_connect_error());
}

// 預備 SQL 語句
$sql = "INSERT INTO ai_requirements 
(identityID, money, name, ainins, region, event_time, support_type, hope, title, information)
VALUES VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);

$stmt = mysqli_prepare($link, $sql);
if (!$stmt) {
    die("預備 SQL 發生錯誤：" . mysqli_error($link));
}

// 綁定參數 (i: integer, s: string)
mysqli_stmt_bind_param($stmt, "isssssssss", $identityID, $money, $name, $ainins, $region, $event_time, $support_type, $hope, $title, $information);

// 執行語句
if (mysqli_stmt_execute($stmt)) {
    echo "<script>
        alert('發布成功！');
        window.location.href = 'alumni contact.html';
    </script>";
} else {
    echo "<script>
        alert('發布失敗：" . mysqli_error($link) . "');
        history.back();
    </script>";
}

// 關閉連線
mysqli_stmt_close($stmt);
mysqli_close($link);
?>
