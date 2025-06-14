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
                            <li><a href="ai.html">首頁</a></li>
                            <li><a href="properties3.php">瀏覽</a></li>
                            <li><a href="alumni contact.php">發布</a></li>
                            <li><a href="aihistory.php">發布歷史</a></li>
                            <li><a href="self.ai.php"  class="active">個人頁面</a></li>
                            <li><a href="login.html">登出</a></li>
                            <li><a href="advanced search for ai.html"><i class="fa fa-calendar"></i>進階搜尋</a>
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
          <h3>校友個人頁面</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Main Content ***** -->
  <div class="container mt-5">
    <div class="row">
      <!-- 左邊表單 -->
      <div class="col-lg-6">
        <h2 class="mb-4">您的個人檔案
          <button class="btn btn-secondary" onclick="location.href='ai_self.change.php'" type="button">
            <b>修改個人資料</b>
          </button>
        </h2>
        <?php
        session_start();
        $userID = $_SESSION['userID'];
        $link = mysqli_connect('localhost', 'root', '', 'SAS');

        $sql = "SELECT * FROM identity WHERE userID = '$userID'";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<form id='contact-form' action='' method='' enctype='multipart/form-data'>
          <div class='mb-3'>
            <label class='form-label'><b>姓名：</b></label><br><b>" . $row['ainame'] . "</b>
          </div>
          <div class='mb-3'>
            <label class='form-label'><b>聯絡資訊：</b></label><br><b>" . $row['ainins'] . "</b>
          </div>
        </form>";
        }
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
            <form id="uploadForm" action="aiuploadimg.php" method="POST" enctype="multipart/form-data"
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
                <form action="aideleteimg.php" method="POST" style="display: inline;">
                  <button type="submit" class="btn btn-sm btn-outline-danger"
                    onclick="return confirm('確定要刪除頭像嗎？');">刪除照片</button>
                </form>
              <?php endif; ?>
            </div>
          </div>


          </ul>
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