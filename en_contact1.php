<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>社團企業媒合平台</title>
    <meta http-equiv="refresh" content="3; url=post_en.php">
</head>
<body>
    <?php
        session_start();
        $identityID = $_SESSION['identityID'];
        $money = $_POST['money'];
        $enterprise = $_POST['enterprise'];
        $type = $_POST['type'];
        $code = $_POST['code'];
        $person = $_POST['person'];
        $ins = $_POST['ins'];
        $phone = $_POST['phone'];
        $region = $_POST['region'];
        $date = $_POST['date'];
        $sponsorship = $_POST['sponsorship'];
        $hope = $_POST['hope'];
        $title = $_POST['title'];
        $information = $_POST['information'];
        $intern_number = $_POST['intern_number'];
        $others = $_POST['others'];

        $link = mysqli_connect('localhost', 'root', '', 'SAS');
        $sql = "insert into en_requirements (identityID, money, enterprise, type, code, person, ins, phone, region, date, sponsorship, hope, title, information, intern_number, others)
        VALUES ('$identityID', '$money', '$enterprise', '$type', '$code', '$person', '$ins', '$phone', '$region', '$date', '$sponsorship', '$hope', '$title', '$information', '$intern_number', '$others')";
        if (mysqli_query($link, $sql)) {
            echo "<script>
                alert('發布成功！');
                window.location.href = 'post_en.php';
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