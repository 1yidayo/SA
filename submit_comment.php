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
$username = '匿名用戶';

// level 對應欄位名稱
$levelFieldMap = [
    'cl' => 'club',
    'en' => 'enterprise',
];

// 查詢使用者名稱
if (array_key_exists($level, $levelFieldMap)) {
    $fieldName = $levelFieldMap[$level];
    $safeIdentityID = mysqli_real_escape_string($link, $identityID);

    if ($level === 'cl') {
        $sql = "SELECT `school`, `$fieldName` FROM identity WHERE identityID = '$safeIdentityID'";
    } else {
        $sql = "SELECT `$fieldName` FROM identity WHERE identityID = '$safeIdentityID'";
    }

    $result = mysqli_query($link, $sql);
    if ($result && $row = mysqli_fetch_assoc($result)) {
        if ($level === 'cl') {
            $school = $row['school'] ?: '未提供大學名稱';
            $club = $row[$fieldName] ?: '未提供社團名稱';
            $username = $school . $club;
        } else {
            $username = $row[$fieldName] ?: '名稱查詢失敗';
        }
    } else {
        $username = '名稱查詢失敗';
    }
}

// 處理留言
$content = isset($_POST['content']) ? mysqli_real_escape_string($link, $_POST['content']) : '';

if (!$content) {
    echo "請填寫留言內容。";
    exit;
}

// 判斷是哪一種需求
if (isset($_POST['clrequirement_num'])) {
    $clrequirement_num = mysqli_real_escape_string($link, $_POST['clrequirement_num']);

    $insert_sql = "INSERT INTO comments (clrequirement_num, username, content, created_at)
                   VALUES ('$clrequirement_num', '$username', '$content', NOW())";

} elseif (isset($_POST['enrequirement_num'])) {
    $enrequirement_num = mysqli_real_escape_string($link, $_POST['enrequirement_num']);

    $insert_sql = "INSERT INTO comments (enrequirement_num, username, content, created_at)
                   VALUES ('$enrequirement_num', '$username', '$content', NOW())";

} else {
    echo "缺少需求參數。";
    exit;
}

// 執行 SQL
if (mysqli_query($link, $insert_sql)) {
    echo "留言已成功提交！";
} else {
    echo "留言提交失敗，請稍後再試。";
}
?>
