<?php
// 連接資料庫
$link = mysqli_connect('localhost', 'root', '', 'SAS');

// 檢查是否有傳入活動編號
if (isset($_GET['clrequirement_num'])) {
    $clrequirement_num = $_GET['clrequirement_num'];

    // 查詢留言資料
    $sql = "SELECT * FROM comments WHERE clrequirement_num = '$clrequirement_num' ORDER BY created_at DESC";
    $result = mysqli_query($link, $sql);

    // 顯示留言
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='comment'>
                <p><strong>" . htmlspecialchars($row['username']) . ":</strong> " . nl2br(htmlspecialchars($row['content'])) . "</p>
                <p><small>留言時間：" . $row['created_at'] . "</small></p>
              </div>";
    }
} else {
    echo "無法載入留言";
}
?>
