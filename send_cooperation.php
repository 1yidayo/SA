<?php
session_start();
$link = new mysqli('localhost', 'root', '', 'SAS');

if ($link->connect_error) {
    die("資料庫連線失敗");
}

$initiator = $_POST['initiator'] ?? null;
$enrequirement_num = $_POST['enrequirement_num'] ?? null;
$clrequirement_num = $_POST['clrequirement_num'] ?? null;
$club_id = null;
$enterprise_id = null;

if ($initiator === 'club') {
    $club_id = $_POST['club_identityID'] ?? null;
    $enterprise_id = $_POST['enterprise_identityID'] ?? null;
} elseif ($initiator === 'enterprise') {
    $enterprise_id = $_POST['enterprise_identityID'] ?? null;
    $club_id = $_POST['club_identityID'] ?? null;
}

if (!$initiator || !$club_id || !$enterprise_id || (!$enrequirement_num && !$clrequirement_num)) {
    die("缺少必要參數");
}

// 檢查是否已申請
$check_sql = "SELECT COUNT(*) FROM cooperation_requests WHERE initiator = ? AND club_identityID = ? AND enterprise_identityID = ? AND ";
if ($initiator === 'club') {
    $check_sql .= "enrequirement_num = ?";
    $check_stmt = $link->prepare($check_sql);
    $check_stmt->bind_param("siii", $initiator, $club_id, $enterprise_id, $enrequirement_num);
} else {
    $check_sql .= "clrequirement_num = ?";
    $check_stmt = $link->prepare($check_sql);
    $check_stmt->bind_param("siii", $initiator, $club_id, $enterprise_id, $clrequirement_num);
}
$check_stmt->execute();
$check_stmt->bind_result($count);
$check_stmt->fetch();
$check_stmt->close();

if ($count > 0) {
    if ($initiator === 'club') {
        header("Location: history.details_en.php?enrequirement_num=" . urlencode($enrequirement_num));
    } else {
        header("Location: history.details_cl.php?clrequirement_num=" . urlencode($clrequirement_num));
    }
    exit;
}

// 新增合作申請
$insert_sql = "INSERT INTO cooperation_requests (initiator, club_identityID, enterprise_identityID, enrequirement_num, clrequirement_num, status) VALUES (?, ?, ?, ?, ?, '待處理')";
$stmt = $link->prepare($insert_sql);
$stmt->bind_param("siiii", $initiator, $club_id, $enterprise_id, $enrequirement_num, $clrequirement_num);

if ($stmt->execute()) {
    if ($initiator === 'club') {
        header("Location: history.details_en.php?enrequirement_num=" . urlencode($enrequirement_num));
    } else {
        header("Location: history.details_cl.php?clrequirement_num=" . urlencode($clrequirement_num));
    }
} else {
    echo "申請失敗，請稍後再試。";
}

$stmt->close();
$link->close();
