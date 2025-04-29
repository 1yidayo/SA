<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社團企業媒合平台</title>
    <meta http-equiv="refresh" content="3; url=club contact.php">
</head>
<body>
    <?php
    $money = $_POST['money'];
    $people = $_POST['people'];
    $school = $_POST['school'];
    $club = $_POST['club'];
    $year = $_POST['year'];
    $type = $_POST['type'];
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
                                                                           
    $link = mysqli_connect('localhost', 'root', '', 'SA');

    $sql = "INSERT INTO club_requirements (money, people, school, club, year, type, region, event_time, support_type, upload, ins, title, information)

        VALUES 
        ('$money', '$people', '$school', '$club', '$year', '$type', '$region', '$event_time', '$support_type', '$upload', '$ins', '$title', '$information')";

    if (mysqli_query($link, $sql)) {
        echo "發布成功";
    } else {
        echo "發布失敗: " . mysqli_error($link);
    }
    
?>


</body>
</html>