<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社團企業媒合平台</title>
    <meta http-equiv="refresh" content="3; url=club contact.html">
</head>
<body>
    <?php
        $money = $_POST['money'];
        $people = $_POST['people'];
        $school = $_POST['school'];
        $club = $_POST['club'];
        $year = $_POST['year'];
        $type = $_POST['type'];
        $upload = $_POST['upload'];
        $ins = $_POST['ins'];
        $title = $_POST['title'];
        $information = $_POST['information'];

        $link = mysqli_connect('localhost', 'root', '', 'SA');
        $sql = "insert into club_requirements (money, people, school, club, year, type, upload, ins, title, information) 
        VALUES ('$money', '$people', '$school', '$club', '$year', '$type', '$upload', '$ins', '$title', '$information')";
        if (mysqli_query($link, $sql))
            {
                echo "發布成功";
            }
            else
            {
                echo "發布失敗";
            }

            ini_set('display_errors', 1);
            error_reporting(E_ALL);
    ?>
</body>
</html>