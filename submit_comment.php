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

// 預設名稱
$username = '匿名用戶';

// 定義 level 與對應欄位名稱
$levelFieldMap = [
    'cl' => 'club',
    'en' => 'enterprise',
    // 這裡可以擴充更多身份 → 'st' => 'student_name', 等
];

if (array_key_exists($level, $levelFieldMap)) {
    $fieldName = $levelFieldMap[$level];

    // 防止 SQL injection
    $safeIdentityID = mysqli_real_escape_string($link, $identityID);

    // 查詢語句
    if ($level == 'cl') {
        // 若是社團，查詢 school 和 club
        $sql = "SELECT `school`, `$fieldName` FROM identity WHERE identityID = '$safeIdentityID'";
    } else {
        // 若是企業，僅查詢 school 和 enterprise
        $sql = "SELECT `$fieldName` FROM identity WHERE identityID = '$safeIdentityID'";
    }

    // 執行查詢並取得結果
    $result = mysqli_query($link, $sql);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        if ($level == 'cl') {
            // 若是社團，將大學名稱和社團名稱合併
            $school = $row['school'] ?: '未提供大學名稱';
            $club = $row[$fieldName] ?: '未提供社團名稱';
            $username = $school . $club;  // 顯示 大學名稱 + 社團名稱
        } else {
            // 若是企業，僅顯示企業名稱
            $username = $row[$fieldName] ?: '名稱查詢失敗';
        }
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
