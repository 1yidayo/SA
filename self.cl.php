<?php
session_start();
$userID = $_SESSION['userID'];
$link = mysqli_connect('localhost', 'root', '', 'SAS');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>社團企業媒合平台</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
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
  <!-- Header -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <ul class="nav">
              <li><a href="cl.html" class="active">首頁</a></li>
              <li><a href="properties2.php">瀏覽</a></li>
              <li><a href="club contact.php">發布</a></li>
              <li><a href="clubhistory.php">發布歷史</a></li>
              <li><a href="self.cl.php">個人頁面</a></li>
              <li><a href="login.html">登出</a></li>
              <li><a href="advanced search for club.html"><i class="fa fa-calendar"></i>進階搜尋</a></li>
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

  <!-- Main Content -->
  <div class="container mt-5">
    <div class="row">
      <!-- 左側個人資料 -->
      <div class="col-lg-6">
        <h2 class="mb-4 d-flex justify-content-between align-items-center">
          我的個人檔案
          <button class="btn btn-secondary" onclick="location.href='cl_self.change.php'" type="button">
            <b>修改個人資料</b>
          </button>
        </h2>

        <?php
        $sql = "SELECT * FROM identity WHERE userID = '$userID'";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);
        echo "
        <div class='card shadow-sm p-4 mb-4'>
          <div class='mb-3'><label class='form-label text-muted'>學校名稱：</label><div class='fs-5 fw-bold'>{$row['school']}</div></div>
          <div class='mb-3'><label class='form-label text-muted'>社團名稱：</label><div class='fs-5 fw-bold'>{$row['club']}</div></div>
          <div class='mb-3'><label class='form-label text-muted'>社團成員人數：</label><div class='fs-5 fw-bold'>{$row['clsize']}</div></div>
          <div class='mb-3'><label class='form-label text-muted'>社團成立年分：</label><div class='fs-5 fw-bold'>{$row['clyear']}</div></div>
          <div class='mb-3'><label class='form-label text-muted'>社團類型：</label><div class='fs-5 fw-bold'>{$row['cltype']}</div></div>
          <div class='mb-3'><label class='form-label text-muted'>粉專或社群連結：</label><div><a class='fs-5' href='{$row['clins']}' target='_blank'>{$row['clins']}</a></div></div>
          <div class='mb-3'><label class='form-label text-muted'>聯絡人電話：</label><div class='fs-5 fw-bold'>{$row['clphone']}</div></div>
        </div>";
        ?>
      </div>

      <!-- 右側圖片與收藏 -->
      <div class="col-lg-6">
        <div class="info-table">
          <?php
          $imgPath = (!empty($row['profile_img']) && $row['profile_img'] !== 'default-profile.png')
            ? 'uploads/' . $row['profile_img']
            : 'uploads/default-profile.png';
          $isDefault = (basename($imgPath) === 'default-profile.png');
          ?>

          <div class="text-center mb-4">
          <img src="<?= $imgPath . '?t=' . time() ?>" alt="Profile" class="rounded-circle shadow"
              style="width: 150px; height: 150px; object-fit: cover;">

            <!-- 隱藏上傳表單 -->
            <form id="uploadForm" action="cluploadimg.php" method="POST" enctype="multipart/form-data"
              style="display: none;">
              <input type="file" id="fileInput" name="profile_img" accept="image/*"
                onchange="document.getElementById('uploadForm').submit();">
            </form>

            <!-- 按鈕區塊 -->
            <div class="mt-2">
              <?php if ($isDefault): ?>
                <button class="btn btn-sm btn-outline-primary"
                  onclick="document.getElementById('fileInput').click();">上傳照片</button>
              <?php else: ?>
                <button class="btn btn-sm btn-outline-primary me-2"
                  onclick="document.getElementById('fileInput').click();">更換照片</button>
                <form action="cldeleteimg.php" method="POST" style="display: inline;">
                  <button type="submit" class="btn btn-sm btn-outline-danger"
                    onclick="return confirm('確定要刪除頭像嗎？');">刪除照片</button>
                </form>
              <?php endif; ?>
            </div>
          </div>

          <!-- <h4 class="mb-3">我的收藏</h4>
          <ul class="list-group list-group-flush">
            <?php
            $fav_sql = "SELECT cr.requirement_num, cr.title, cr.information 
                        FROM user_favorites uf
                        JOIN club_requirements cr ON uf.requirement_num = cr.requirement_num
                        WHERE uf.userID = '$userID'";
            $fav_result = mysqli_query($link, $fav_sql);
            if ($fav_result && mysqli_num_rows($fav_result) > 0) {
              while ($fav_row = mysqli_fetch_assoc($fav_result)) {
                echo "<li class='list-group-item'>
                        <strong>{$fav_row['title']}</strong><br>
                        <small class='text-muted'>{$fav_row['information']}</small>
                      </li>";
              }
            } else {
              echo "<li class='list-group-item text-muted'>目前尚無收藏</li>";
            }
            ?>
          </ul> -->
        </div>
      </div>
    </div>
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