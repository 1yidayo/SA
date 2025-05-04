<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
<?php
session_start();

$name = $_POST["name"];
$ainins = $_POST["ainins"];
$userID = $_SESSION['userID'];

$conn = mysqli_connect('localhost', 'root', '', 'SAS');

if (!$conn) {
    die("連線失敗：" . mysqli_connect_error());
}

$sql = "INSERT INTO identity (
    userID, enterprise, entype, code, enins, school, club, clsize,
    clyear, cltype, clins, name, ainins
) VALUES (
    $userID, '', '', '', '', '', '', '', '', '', '', '$name', '$ainins'
)";


if (mysqli_query($conn, $sql)) {
    echo "新增成功";
    echo '<script>
            setTimeout(function(){
                window.location.href = "ai.html";
            }, 2000);
          </script>';
} else {
    echo "新增失敗：" . mysqli_error($conn);
}

mysqli_close($conn);
?>
</body>
</html>
