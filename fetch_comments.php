<?php
$link = mysqli_connect('localhost', 'root', '', 'SAS');

if (isset($_GET['enrequirement_num'])) {
    $enrequirement_num = $_GET['enrequirement_num'];

    $sql = "SELECT * FROM comments WHERE enrequirement_num = '$enrequirement_num' ORDER BY created_at DESC";
    $result = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='comment'>
                <p><strong>" . htmlspecialchars($row['username']) . ":</strong> " . nl2br(htmlspecialchars($row['content'])) . "</p>
                <p><small>留言時間：" . $row['created_at'] . "</small></p>
              </div>";
    }

} elseif (isset($_GET['clrequirement_num'])) {
    $clrequirement_num = $_GET['clrequirement_num'];

    $sql = "SELECT * FROM comments WHERE clrequirement_num = '$clrequirement_num' ORDER BY created_at DESC";
    $result = mysqli_query($link, $sql);

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
