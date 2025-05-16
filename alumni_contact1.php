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
    
    $title = $_POST['title'];
    $information = $_POST['information'];

                                                                           
    $link = mysqli_connect('localhost', 'root', '', 'SAS');

    $sql = "INSERT INTO ai_requirements (identityID,  title, information)

        VALUES 
        ('$identityID', '$title', '$information')";

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