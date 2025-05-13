<?php
session_start();
$link = mysqli_connect('localhost', 'root', '', 'SAS');

// 檢查是否登入
if (!isset($_SESSION['identityID']) || !isset($_SESSION['level'])) {
    echo "請先登入後再留言。";
    exit;
}

$identityID = $_SESSION['identityID'];
$level = $_SESSION['level'];

// 根據 level 抓取使用者的「真實名稱」
if ($level === 'cl') {
    $sql = "SELECT club FROM identity WHERE identityID = '$identityID'";
} elseif ($level === 'en') {
    $sql = "SELECT enterprise FROM identity WHERE identityID = '$identityID'";
} else {
    $username = '匿名用戶';
}

if (isset($sql)) {
    $result = mysqli_query($link, $sql);
    if ($row = mysqli_fetch_assoc($result)) {
        $username = ($level === 'cl') ? $row['club_name'] : $row['enterprise_name'];
    } else {
        $username = '名稱查詢失敗';
    }
}

// 處理留言
if (isset($_POST['clrequirement_num']) && isset($_POST['content'])) {
    $clrequirement_num = $_POST['clrequirement_num'];
    $content = mysqli_real_escape_string($link, $_POST['content']);

    $insert_sql = "INSERT INTO comments (clrequirement_num, username, content, created_at) 
                   VALUES ('$clrequirement_num', '$username', '$content', NOW())";
    
    if (mysqli_query($link, $insert_sql)) {
        echo "留言已成功提交！";
    } else {
        echo "留言提交失敗，請稍後再試。";
    }
} else {
    echo "請填寫留言內容。";
}
?>
