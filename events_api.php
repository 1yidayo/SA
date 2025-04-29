
<?php
session_start();
$link = mysqli_connect('localhost', 'root', '', 'SA');
mysqli_set_charset($link, "utf8");

$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? '';
$userID = $_SESSION['userID'] ?? '';

if (!$userID) {
    echo json_encode(["error" => "未登入"]);
    exit;
}

function responseError($msg) {
    echo json_encode(["error" => $msg]);
    exit;
}

if (empty($action)) {
    responseError("無效的操作");
}

switch ($action) {
    case 'list':
        $stmt = mysqli_prepare($link, "SELECT id, title, start, end FROM events WHERE userID = ?");
        mysqli_stmt_bind_param($stmt, "s", $userID);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $events = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = [
                'id' => $row['id'],
                'title' => $row['title'],
                'start' => $row['start'],
                'end' => $row['end']
            ];
        }
        echo json_encode($events);
        break;

    case 'add':
        $title = trim($input['title'] ?? '');
        $start = trim($input['start'] ?? '');
        $end = trim($input['end'] ?? '');

        if (empty($title) || empty($start) || empty($end)) {
            responseError("資料不完整");
        }

        $stmt = mysqli_prepare($link, "INSERT INTO events (userID, title, start, end) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "ssss", $userID, $title, $start, $end);
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["success" => true]);
        } else {
            responseError("新增失敗：" . mysqli_error($link));
        }
        break;

    case 'edit':
        $id = intval($input['id'] ?? 0);
        $title = trim($input['title'] ?? '');
        $end = trim($input['end'] ?? '');

        if (empty($title) || empty($end) || !$id) {
            responseError("資料不完整");
        }

        $stmt = mysqli_prepare($link, "UPDATE events SET title = ?, end = ? WHERE id = ? AND userID = ?");
        mysqli_stmt_bind_param($stmt, "ssss", $title, $end, $id, $userID);
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["success" => true]);
        } else {
            responseError("修改失敗：" . mysqli_error($link));
        }
        break;

    case 'delete':
        $id = intval($input['id'] ?? 0);
        if (!$id) {
            responseError("無效的 ID");
        }

        $stmt = mysqli_prepare($link, "DELETE FROM events WHERE id = ? AND userID = ?");
        mysqli_stmt_bind_param($stmt, "is", $id, $userID);
        if (mysqli_stmt_execute($stmt)) {
            echo json_encode(["success" => true]);
        } else {
            responseError("刪除失敗：" . mysqli_error($link));
        }
        break;

    default:
        responseError("未知的操作");
}
