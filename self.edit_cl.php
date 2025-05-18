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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
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
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="index_cl.php">首頁</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="index_en.php">首頁</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="browse_cl.php">瀏覽</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="browse_en.php">瀏覽</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="post_cl.php">發布</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="post_en.php">發布</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="post.history_cl.php">發布歷史</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="post.history_en.php">發布歷史</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="cooperations_cl.php">我的合作</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="cooperations_en.php">我的合作</a></li>
              <?php endif; ?>
              <?php if ($_SESSION['level'] === 'cl'): ?>
                <li><a href="self_cl.php" class="active">個人頁面</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="self_en.php" class="active">個人頁面</a></li>
              <?php endif; ?>
              <li><a href="logout.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登出</a></li>
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
          <h3>社團個人頁面</h3>
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
            <form id='contact-form' action='club_edit.php' method='post' enctype='multipart/form-data'>
              <div class='mb-3'>
                <label class='form-label'><b>學校名稱</b></label>
                <input class='form-control' name='school' value="<?= $row['school'] ?>" readonly>
              </div>
              <div class='mb-3'>
                <label class='form-label'><b>社團名稱</b></label>
                <input class='form-control' name='club' value="<?= $row['club'] ?>" readonly>
              </div>

              <div class='mb-3'>
                <label class='form-label'><b>社團規模</b></label>
                <input class='form-control' name='clsize' value="<?= $row['clsize'] ?>" required>
              </div>
              <div class='mb-3'>
                <label class='form-label'><b>社團成立年份</b></label>
                <input class='form-control' name='clyear' value="<?= $row['clyear'] ?>" required>
              </div>
              <div class='mb-3'>
                <label class='form-label'><b>社團類型</b></label>
                <input class='form-control' name='cltype' value="<?= $row['cltype'] ?>" required>
              </div>
              <div class='mb-3'>
                <label class='form-label'><b>社群連結</b></label>
                <input class='form-control' name='clins' value="<?= $row['clins'] ?>" required>
              </div>
              <div class='mb-3'>
                <label class='form-label'><b>聯絡人電話</b></label>
                <input class='form-control' name='clphone' value="<?= $row['clphone'] ?>" required>
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
  <footer>
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