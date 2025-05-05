<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社團企業媒合平台</title>
</head>
<body>
    <?php
    session_start();
    $identityID = $_SESSION['identityID'];
    $money = $_POST['money'];
    $people = $_POST['people'];

    $club = $_SESSION['username'];
    
    
    $region = $_POST['region'];
    $event_time = $_POST['event_time'];
    $support_type = $_POST['support_type'];
    $ins = $_POST['ins'];
    $title = $_POST['title'];
    $information = $_POST['information'];

   
    $uploadDir = 'uploads/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $uploadFile = $uploadDir . basename($_FILES['upload']['name']);

    if (move_uploaded_file($_FILES['upload']['tmp_name'], $uploadFile)) {
        $upload = $uploadFile; 
    } else {
        $upload = ''; 
    }
                                                                           
    $link = mysqli_connect('localhost', 'root', '', 'SAS');

    $sql = "INSERT INTO club_requirements (identityID, money, people,  club,   region, event_time, support_type, upload, ins, title, information)

        VALUES 
        ('$identityID', '$money', '$people',  '$club',   '$region', '$event_time', '$support_type', '$upload', '$ins', '$title', '$information')";

    if (mysqli_query($link, $sql)) {
        echo "<script>
            alert('發布成功！');
            window.location.href = 'de_contact.php';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('發布失敗：" . mysqli_error($link) . "');
            window.history.back();
        </script>";
}

    
?>


</body>
</html>