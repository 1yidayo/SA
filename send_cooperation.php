<?php
session_start();

// 檢查登入與身份
if (!isset($_SESSION['identityID']) || !isset($_SESSION['level'])) {
    echo json_encode(['success' => false, 'message' => '尚未登入']);
    exit;
}

$level = $_SESSION['level'];
$identityID = $_SESSION['identityID'];

// 資料庫連線
$link = new mysqli('localhost', 'root', '', 'SAS');
if ($link->connect_errno) {
    echo json_encode(['success' => false, 'message' => '資料庫連線失敗']);
    exit;
}

// 接收 POST 參數
$clrequirement_num = isset($_POST['clrequirement_num']) ? intval($_POST['clrequirement_num']) : null;
$enrequirement_num = isset($_POST['enrequirement_num']) ? intval($_POST['enrequirement_num']) : null;

// 身份與對象判斷
if ($level === 'cl') {
    $initiator = 'club';
    $club_identityID = $identityID;
    $enterprise_identityID = isset($_POST['enterprise_identityID']) ? trim($_POST['enterprise_identityID']) : null;
    if (!$enterprise_identityID) {
        echo json_encode(['success' => false, 'message' => '缺少企業 ID']);
        exit;
    }
} elseif ($level === 'en') {
    $initiator = 'enterprise';
    $enterprise_identityID = $identityID;
    $club_identityID = isset($_POST['club_identityID']) ? trim($_POST['club_identityID']) : null;
    if (!$club_identityID) {
        echo json_encode(['success' => false, 'message' => '缺少社團 ID']);
        exit;
    }
} else {
    echo json_encode(['success' => false, 'message' => '身份錯誤']);
    exit;
}

// 至少需要一個需求編號
if (!$clrequirement_num && !$enrequirement_num) {
    echo json_encode(['success' => false, 'message' => '缺少需求編號']);
    exit;
}

// 檢查是否已存在重複邀請
$sql_check = "SELECT id FROM cooperation_requests 
              WHERE club_identityID = ? AND enterprise_identityID = ? 
              AND (clrequirement_num <=> ?) AND (enrequirement_num <=> ?) 
              AND initiator = ?";

$stmt = $link->prepare($sql_check);
$stmt->bind_param("ssiis", 
    $club_identityID, 
    $enterprise_identityID, 
    $clrequirement_num, 
    $enrequirement_num, 
    $initiator
);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => '已送出過邀請，請勿重複發送']);
    $stmt->close();
    $link->close();
    exit;
}
$stmt->close();

// 寫入邀請
$sql_insert = "INSERT INTO cooperation_requests 
    (club_identityID, enterprise_identityID, clrequirement_num, enrequirement_num, status, initiator, sent_at) 
    VALUES (?, ?, ?, ?, '待處理', ?, NOW())";

$stmt = $link->prepare($sql_insert);
$stmt->bind_param("ssiis", 
    $club_identityID, 
    $enterprise_identityID, 
    $clrequirement_num, 
    $enrequirement_num, 
    $initiator
);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => '合作邀請發送成功']);
} else {
    echo json_encode(['success' => false, 'message' => '資料庫錯誤，邀請失敗']);
}
$stmt->close();
$link->close();
?>
