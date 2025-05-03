<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <title>社團企業媒合平台</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

  <style>
    #calendar {
      background-color: white;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      font-family: serif;
    }
  </style>
</head>

<body>

  <!-- ***** Header ***** -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
          <ul class="nav">
                            <li><a href="en.html" class="active">首頁</a></li>
                            <li><a href="properties2.php">瀏覽</a></li>
                            <li><a href="cl_contact.php">發布</a></li>
                            <li><a href="clhistory.php">發布歷史</a></li>
                            <li><a href="self.cl.php">個人頁面</a></li>
                            <li><a href="login.html">登出</a></li>
                            <li><a href="advanced search for club.html"><i class="fa fa-calendar"></i>進階搜尋</ruby></a>
                            </li>
                        </ul>
            <a class='menu-trigger'><span>Menu</span></a>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <!-- ***** Page Heading ***** -->
  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="#">Home</a> / My Page</span>
          <h3>查看作者個人頁面</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Main Content ***** -->
  <div class="container mt-5">
    <div class="row">
      <!-- 左邊表單 -->
      <div class="col-lg-6">
        <h2 class="mb-4">作者個人頁面
        </h2>
        <?php
// 連接資料庫
$link = mysqli_connect("localhost", "root", "", "SA");
mysqli_set_charset($link, "utf8");

// 確認有接到 enrequirement_num
if (isset($_GET['enrequirement_num'])) {
    $enrequirement_num = $_GET['enrequirement_num'];

    // 查詢文章作者的 identityID
    $sql_identity = "SELECT identityID FROM en_requirements WHERE enrequirement_num = '$enrequirement_num'";
    $result_identity = mysqli_query($link, $sql_identity);

    if ($result_identity && mysqli_num_rows($result_identity) > 0) {
        $row_identity = mysqli_fetch_assoc($result_identity);
        $identityID = $row_identity['identityID'];

        // 查詢該作者的詳細資訊
        $sql_user = "SELECT * FROM identity WHERE identityID = '$identityID'";
        $result_user = mysqli_query($link, $sql_user);

        if ($result_user && mysqli_num_rows($result_user) > 0) {
            $user = mysqli_fetch_assoc($result_user);
            // 顯示作者資料
        }
    }
}
?>

            <!-- 顯示作者資料 -->
            <form id="contact-form" method="post">
              <div class="mb-3">
                <label class="form-label"><b>企業名稱：</b></label><br>
                <b><?= htmlspecialchars($user['enterprise']) ?></b>
              </div>
              <div class="mb-3">
                <label class="form-label"><b>行業別：</b></label><br>
                <b><?= htmlspecialchars($user['entype']) ?></b>
              </div>
              <div class="mb-3">
                <label class="form-label"><b>統一編號：</b></label><br>
                <b><?= htmlspecialchars($user['code']) ?></b>
              </div>
              <div class="mb-3">
                <label class="form-label"><b>聯絡方式：</b></label><br>
                <a href="<?= htmlspecialchars($user['enins']) ?>" target="_blank"><?= htmlspecialchars($user['enins']) ?></a>
              </div>





  <!-- Footer -->
  <footer class="mt-5">
    <div class="container">
      <div class="col-lg-8">
        <p style="text-align: left; font-weight: bold;">社團企業媒合平台</p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>

</body>
</html>
