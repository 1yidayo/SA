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
                            <li><a href="en.html" class="active">首頁</a></li>
                            <li><a href="properties.php">瀏覽</a></li>
                            <li><a href="en_contact.php">發布</a></li>
                            <li><a href="enhistory.php">發布歷史</a></li>
                            <li><a href="self.en.php">個人頁面</a></li>
                            <li><a href="login.html">登出</a></li>
                            <li><a href="advanced search for enterprise.html"><i
                                        class="fa fa-calendar"></i>進階搜尋</a>
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


$link = mysqli_connect('localhost', 'root', '', 'SAS');
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
if (!isset($_SESSION['identityID'])) {
    header("Location: login.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num = intval($_POST['enrequirement_num']);

    $sql_old = "SELECT * FROM en_requirements WHERE enrequirement_num = $num AND identityID = '{$_SESSION['identityID']}'";
    $result_old = mysqli_query($link, $sql_old);
    $old = mysqli_fetch_assoc($result_old);

    if (!$old) {
        header("Location: enhistory.php");
        exit();
    }

    $title = $_POST['title'] ?? $old['title'];
    $date = $_POST['date'] ?? $old['date'];
    $hope = $_POST['hope'] ?? $old['hope'];
    $sponsorship = $_POST['sponsorship'] ?? $old['sponsorship'];
    $information = $_POST['information'] ?? $old['information']


    $title = mysqli_real_escape_string($link, $title);
    $date = mysqli_real_escape_string($link, $date);
    $hope = mysqli_real_escape_string($link, $hope);
    $sponsorship = mysqli_real_escape_string($link, $sponsorship);
    $information = mysqli_real_escape_string($link, $information);

    $sql = "UPDATE club_requirements SET 
                title = '$title',
                date = '$date',
                hope = '$hope',
                sponsorship = '$sponsorship',
                information = '$information'
            WHERE enrequirement_num = $num AND identityID = '{$_SESSION['identityID']}'";

    mysqli_query($link, $sql);
    header("Location: enhistory.php");
    exit();
} else if (isset($_GET['enrequirement_num'])) {
    $num = intval($_GET['enrequirement_num']);
    $sql = "SELECT * FROM en_requirements WHERE enrequirement_num = $num AND identityID = '{$_SESSION['identityID']}'";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    if (!$row) {
        header("Location: enhistory.php");
        exit();
    }
} else {
    header("Location: enhistory.php");
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
    <form method="POST" action="editenhistory.php">

        <input type="hidden" name="enrequirement_num" value="<?= $row['enrequirement_num'] ?>">

        <div class="mb-3">
            <label class="form-label"><b>標題</b></label>
            <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($row['title']) ?>" required>
        </div>

        <div class="mb-3" id="money-group" style="<?= $row['type'] === '金錢' ? '' : 'display: none;' ?>">
            <label class="form-label"><b>贊助範圍</b></label>
            <input type="number" class="form-control" name="money" value="<?= htmlspecialchars($row['money']) ?>">
        </div>

        <div class="mb-3">
    <label class="form-label"><b>期望社團達到目的</b></label>
    <select class="form-control" name="hope" >
        <option value="">請選擇</option>
        <option value="宣傳" <?= $row['hope'] == '宣傳' ? 'selected' : '' ?>>宣傳</option>
        <option value="表演" <?= $row['hope'] == '表演' ? 'selected' : '' ?>>表演</option>
    </select>
</div>


        <div class="mb-3">
            <label class="form-label"><b>可提供贊助類型</b></label>
            <select class="form-select" name="sponsorship" id="sponsorship" required>
                <option value="金錢" <?= $row['sponsorship'] == '金錢' ? 'selected' : '' ?>>金錢</option>
                <option value="物資" <?= $row['sponsorship'] == '物資' ? 'selected' : '' ?>>物資</option>
                <option value="場地" <?= $row['sponsorship'] == '場地' ? 'selected' : '' ?>>場地</option>
                <option value="提供實習" <?= $row['sponsorship'] == '提供實習' ? 'selected' : '' ?>>提供實習</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label"><b>內文(必填)</b></label>
            <textarea class="form-control" name="information" required><?= htmlspecialchars($row['information']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label"><b>預計活動月份</b></label>
            <input type="date" name="date" class="form-control" value="<?= htmlspecialchars($row['date']) ?>" required>
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