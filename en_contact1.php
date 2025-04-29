<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社團企業媒合平台</title>
    <meta http-equiv="refresh" content="3; url=en contact.php">
</head>
<body>
    <?php
        session_start();
        $userID = $_SESSION['userID'];
        $money = $_POST['money'];
        $enterprise = $_POST['enterprise'];
        $type = $_POST['type'];
        $code = $_POST['code'];
        $ins = $_POST['ins'];
        $region = $_POST['region'];
        $date = $_POST['date'];
        $sponsorship = $_POST['sponsorship'];
        $hope = $_POST['hope'];
        $title = $_POST['title'];
        $information = $_POST['information'];

        $link = mysqli_connect('localhost', 'root', '', 'SA');
        $sql = "insert into en_requirements (money, enterprise, type, code, ins, region, date, sponsorship, hope, title, information)
        VALUES ('$money', '$enterprise', '$type', '$code', '$ins', '$region', '$date', '$sponsorship', '$hope', '$title', '$information')";
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