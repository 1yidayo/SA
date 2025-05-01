<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>社團企業媒合平台</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
<!--

TemplateMo 591 villa agency

https://templatemo.com/tm-591-villa-agency

-->

    <style>
        .properties-box {
      display: flex;
      flex-wrap: wrap; /* 允許換行 */
      gap: 10px; /* 設定間距 */
      justify-content: flex-start; /* 讓內容從左到右排列 */
  }

  .properties-items {
      width: 30%; /* 保持與原本大小相近 */
      min-width: 300px; /* 避免縮小過度 */
  }

  /* 讓小螢幕時調整排列 */
  @media (max-width: 992px) {
      .properties-items {
          width: 45%; /* 平板改為兩欄 */
      }
  }

  @media (max-width: 600px) {
      .properties-items {
          width: 100%; /* 手機版單欄 */
      }
  }

      /* 確保每個歷史紀錄框高度一致 */
      .uniform-box {
          min-height: 430px; /* 根據內容調整，讓每筆高度一致 */
          display: flex;
          flex-direction: column;
          justify-content: space-between;
      }

      /* 讓修改/刪除連結整齊排列 */
      .text-links {
          margin-top: 10px;
          text-align: right;
          font-size: 14px;
      }

      .text-links a {
          text-decoration: none;
          color: #333;
          margin: 0 5px;
      }

      .text-links a:hover {
          text-decoration: underline;
      }


    </style>


  </head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->


  <!-- ***** Header Area Start ***** -->
  <header class="header-area header-sticky">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="main-nav">
                    
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                            <li><a href="cl.html" class="active">首頁</a></li>
                            <li><a href="properties2.php">瀏覽</a></li>
                            <li><a href="club contact.php">發布</a></li>
                            <li><a href="clubhistory.php">發布歷史</a></li>
                            <li><a href="self.cl.php">個人頁面</a></li>
                            <li><a href="first.html">登出</a></li>
                            <li><a href="advanced search for club.html"><i class="fa fa-calendar"></i>進階搜尋</ruby></a>
                            </li>
                        </ul>
                    <a class='menu-trigger'>
                        <span>Menu</span>
                    </a>
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->
<?php


$link = mysqli_connect('localhost', 'root', '', 'SA');
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
if (!isset($_SESSION['identityID'])) {
    header("Location: first.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num = intval($_POST['clrequirement_num']);

    $sql_old = "SELECT * FROM club_requirements WHERE clrequirement_num = $num AND identityID = '{$_SESSION['identityID']}'";
    $result_old = mysqli_query($link, $sql_old);
    $old = mysqli_fetch_assoc($result_old);

    if (!$old) {
        header("Location: clubhistory.php");
        exit();
    }

    $title = $_POST['title'] ?? $old['title'];
    $money = $_POST['money'] ?? $old['money'];
    $people = $_POST['people'] ?? $old['people'];
    $type = $_POST['type'] ?? $old['type'];
    $region = $_POST['region'] ?? $old['region'];
    $event_time = $_POST['event_time'] ?? $old['event_time'];
    $information = $_POST['information'] ?? $old['information'];

    $title = mysqli_real_escape_string($link, $title);
    $money = mysqli_real_escape_string($link, $money);
    $people = mysqli_real_escape_string($link, $people);
    $type = mysqli_real_escape_string($link, $type);
    $region = mysqli_real_escape_string($link, $region);
    $event_time = mysqli_real_escape_string($link, $event_time);
    $information = mysqli_real_escape_string($link, $information);

    $sql = "UPDATE club_requirements SET 
                title = '$title',
                money = '$money',
                people = '$people',
                type = '$type',
                region = '$region',
                event_time = '$event_time',
                information = '$information'
            WHERE clrequirement_num = $num AND identityID = '{$_SESSION['identityID']}'";

    mysqli_query($link, $sql);
    header("Location: clubhistory.php");
    exit();
} else if (isset($_GET['clrequirement_num'])) {
    $num = intval($_GET['clrequirement_num']);
    $sql = "SELECT * FROM club_requirements WHERE clrequirement_num = $num AND identityID = '{$_SESSION['identityID']}'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        header("Location: clubhistory.php");
        exit();
    }
} else {
    header("Location: clubhistory.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="zh-TW">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>編輯贊助需求</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
</head>
<body>

<div class="container mt-5">
    <h3 class="mb-4">編輯贊助需求</h3>
    <form method="POST" action="editclubhistory.php">

        <input type="hidden" name="clrequirement_num" value="<?= $row['clrequirement_num'] ?>">

        <div class="mb-3">
            <label class="form-label"><b>標題</b></label>
            <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($row['title']) ?>" required>
        </div>

        <div class="mb-3" id="money-group" style="<?= $row['type'] === '金錢' ? '' : 'display: none;' ?>">
            <label class="form-label"><b>贊助金額</b></label>
            <input type="number" class="form-control" name="money" value="<?= htmlspecialchars($row['money']) ?>">
        </div>

        <div class="mb-3">
    <label class="form-label"><b>預估規模</b></label>
    <select class="form-control" name="people" >
        <option value="">請選擇</option>
        <option value="0-10人" <?= $row['people'] == '0-10人' ? 'selected' : '' ?>>0-10人</option>
        <option value="11-20人" <?= $row['people'] == '11-20人' ? 'selected' : '' ?>>11-20人</option>
        <option value="21-30人" <?= $row['people'] == '21-30人' ? 'selected' : '' ?>>21-30人</option>
        <option value="31-40人" <?= $row['people'] == '31-40人' ? 'selected' : '' ?>>31-40人</option>
        <option value="41-50人" <?= $row['people'] == '41-50人' ? 'selected' : '' ?>>41-50人</option>
        <option value="50人以上" <?= $row['people'] == '50人以上' ? 'selected' : '' ?>>50人以上</option>
    </select>
</div>


        <div class="mb-3">
            <label class="form-label"><b>贊助類型</b></label>
            <select class="form-select" name="type" id="type" required>
                <option value="金錢" <?= $row['type'] == '金錢' ? 'selected' : '' ?>>金錢</option>
                <option value="人力" <?= $row['type'] == '人力' ? 'selected' : '' ?>>人力</option>
                <option value="其他" <?= $row['type'] == '其他' ? 'selected' : '' ?>>其他</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label"><b>內文(必填)</b></label>
            <textarea class="form-control" name="information" required><?= htmlspecialchars($row['information']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label"><b>預計活動月份</b></label>
            <input type="date" name="event_time" class="form-control" value="<?= htmlspecialchars($row['event_time']) ?>" required>
        </div>

        <div class="mb-4">
            <label class="form-label"><b>活動地區</b></label>
            <select class="form-select" name="region" required>
                <option value="">請選擇</option>
                <option value="北部" <?= $row['region'] == '北部' ? 'selected' : '' ?>>北部</option>
                <option value="中部" <?= $row['region'] == '中部' ? 'selected' : '' ?>>中部</option>
                <option value="南部" <?= $row['region'] == '南部' ? 'selected' : '' ?>>南部</option>
                <option value="東部" <?= $row['region'] == '東部' ? 'selected' : '' ?>>東部</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
        <a href="clubhistory.php" class="btn btn-secondary">取消</a>
    </form>
</div>

<script>
document.getElementById('type').addEventListener('change', function () {
    const moneyGroup = document.getElementById('money-group');
    moneyGroup.style.display = this.value === '金錢' ? 'block' : 'none';
});
</script>

</body>
</html>



  <footer>
        <div class="container">
            <div class="col-lg-8">
                <p style="text-align: left; font-weight: bold;">社團企業媒合平台</p>
            </div>
        </div>
    </footer>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>

  </body>
</html>