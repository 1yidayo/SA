<?php
session_start();

// 檢查是否已登入
if (!isset($_SESSION['identityID'], $_SESSION['level'])) {
    header("Location: login.php");
    exit;
}

$link = mysqli_connect('localhost', 'root', '', 'sas');
if (!$link) {
    die("資料庫連線失敗: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 轉義並過濾輸入資料
    $id = isset($_POST['id']) ? mysqli_real_escape_string($link, $_POST['id']) : '';
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if (!in_array($action, ['accept', 'reject'], true)) {
        // 非法操作
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit;
    }

    $status = ($action === 'accept') ? '同意' : '拒絕';

    $user_identityID = $_SESSION['identityID'];
    $user_level = $_SESSION['level'];

    // 先撈出該合作申請
    $sql_check = "SELECT * FROM cooperation_requests WHERE id = '$id'";
    $result = mysqli_query($link, $sql_check);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // 權限確認：必須是接收方才能處理
        $can_edit = false;

        if ($user_level === 'en' && $user_identityID == $row['enterprise_identityID'] && $row['initiator'] === 'club') {
            $can_edit = true;
        } elseif ($user_level === 'cl' && $user_identityID == $row['club_identityID'] && $row['initiator'] === 'enterprise') {
            $can_edit = true;
        }

        if ($can_edit) {
            $update_sql = "UPDATE cooperation_requests SET status = '$status' WHERE id = '$id'";
            mysqli_query($link, $update_sql);
        }
    }
}

header("Location: {$_SERVER['HTTP_REFERER']}");
exit;
