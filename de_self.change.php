<?php
session_start();
$userID = $_SESSION['userID'];
$link = mysqli_connect('localhost', 'root', '', 'SAS');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>社團企業媒合平台</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
</head>

<body>
  <!-- Header -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <ul class="nav">
              <li><a href="de.html" class="active">首頁</a></li>
              <li><a href="properties4.php">瀏覽</a></li>
              <li><a href="de_contact.html">發布</a></li>
              <li><a href="dehistory.php">發布歷史</a></li>
              <li><a href="self.de.php">個人頁面</a></li>
              <li><a href="login.html">登出</a></li>
              <li><a href="aftersearchforde.php"><i class="fa fa-calendar"></i>進階搜尋</a></li>
            </ul>
            <a class='menu-trigger'><span>Menu</span></a>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <!-- Page Heading -->
  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="#">Home</a> / My Page</span>
          <h3>系學會個人頁面</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <h2 class="mb-4">修改您的個人檔案</h2>

    <?php
    $sql = "SELECT * FROM identity WHERE userID = '$userID'";
    $result = mysqli_query($link, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
    ?>
      <div class='contact-page section' style='margin-top: 20px;'>
        <div class='row'>
          <div class='col-lg-6' style='margin:auto'>
            <form id='contact-form' action='de_edit.php' method='post' enctype='multipart/form-data'>
              <div class='mb-3'>
                <label class='form-label'><b>學校名稱</b></label>
                <p class='form-control-plaintext'><?= $row['deschool'] ?></p>
              </div>
              <div class='mb-3'>
                <label class='form-label'><b>系學會名稱</b></label>
                <p class='form-control-plaintext'><?= $row['dename'] ?></p>
              </div>
              <div class='mb-3'>
                <label class='form-label'><b>系學會規模</b></label>
                <input class='form-control' name='desize' value="<?= $row['desize'] ?>" required>
              </div>
              <div class='mb-3'>
                <label class='form-label'><b>系學會成立年份</b></label>
                <input class='form-control' name='deyear' value="<?= $row['deyear'] ?>" required>
              </div>
              <div class='mb-3'>
                <label class='form-label'><b>社群連結</b></label>
                <input class='form-control' name='deins' value="<?= $row['deins'] ?>" required>
              </div>
              <div class='mb-3'>
                <label class='form-label'><b>聯絡人電話</b></label>
                <input class='form-control' name='dephone' value="<?= $row['dephone'] ?>" required>
              </div>
              <button class='btn btn-dark w-100' type='submit'><b>儲存修改</b></button>
            </form>
          </div>
        </div>
      </div>
    <?php
    } else {
      echo "<div class='alert alert-danger'>找不到您的資料，請重新登入。</div>";
    }
    ?>
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
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>
