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
    $name = $_POST['name'];
    $ainins = $_POST['ainins'];
    $region = $_POST['region'];
    $event_time = $_POST['event_time'];
    $support_type = $_POST['support_type'];
    $hope = $_POST['hope'];
    $title = $_POST['title'];
    $information = $_POST['information'];

                                                                           
    $link = mysqli_connect('localhost', 'root', '', 'SAS');

    $sql = "INSERT INTO ai_requirements (identityID, money, name, ainins, region, event_time, support_type, hope, title, information)

        VALUES 
        ('$identityID', '$money', '$name', '$ainins', '$region', '$event_time', '$support_type', '$hope', '$title', '$information')";

    if (mysqli_query($link, $sql)) {
        echo "<script>
            alert('發布成功！');
            window.location.href = 'alumni contact.php';
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