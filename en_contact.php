<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <title>社團企業媒合平台</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
</head>

<body>
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots"><span></span><span></span><span></span></div>
    </div>
  </div>

  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <ul class="nav">
              <li><a href="en.html" class="active">首頁</a></li>
              <li><a href="properties.php">瀏覽</a></li>
              <li><a href="en_contact.php">發布</a></li>
              <li><a href="enhistory.php">發布歷史</a></li>
              <li><a href="self.en.php">個人頁面</a></li>
              <li><a href="login.html">登出</a></li>
              <li><a href="advanced search for enterprise.html"><i class="fa fa-calendar"></i>進階搜尋</a></li>
            </ul>
            <a class='menu-trigger'><span>Menu</span></a>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="#">Home</a> / Contact Us</span>
          <h3>發布企業贊助內容</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-page section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6" style="margin:auto">
          <form id="contact-form" action="en_contact1.php" method="post">
            <div class="row">
              <?php
              session_start();
              $link = mysqli_connect('localhost', 'root', '', 'SA');
              $sql = "SELECT * FROM identity WHERE identityID = '" . $_SESSION['identityID'] . "'";
              $result = mysqli_query($link, $sql);
              if ($row = mysqli_fetch_assoc($result)) {
                $enterprise = $row['enterprise'];
                $entype = $row['entype'];
                $code = $row['code'];
                $enins = $row['enins'];
              }
              ?>
              <input type="hidden" name="identityID" value="<?php echo $_SESSION['identityID']; ?>">

              <div class="col-12">
                <div class="input-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>企業名稱</b></span>
                  </div>
                  <input class="form-control" type="text" placeholder="請輸入企業名稱" name="enterprise" value="<?php echo $enterprise; ?>" required>
                </div>
              </div>

              <div class="col-12">
                <div class="input-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>企業行業別</b></span>
                  </div>
                  <input class="form-control" type="text" placeholder="請輸入企業行業別(eg:科技業、金融業)" name="type" value="<?php echo $entype; ?>" required>
                </div>
              </div>

              <div class="col-12">
                <div class="input-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>企業統一編號</b></span>
                  </div>
                  <input class="form-control" type="text" placeholder="請輸入企業統一編號" name="code" value="<?php echo $code; ?>" required>
                </div>
              </div>

              <div class="col-12">
                <div class="input-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>企業聯絡方式</b></span>
                  </div>
                  <input class="form-control" type="text" placeholder="請輸入企業聯絡方式" name="ins" value="<?php echo $enins; ?>" required>
                </div>
              </div>

              <div class="col-12">
                <div class="input-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>活動地區</b></span>
                  </div>
                  <select class="form-select" name="region" required>
                    <option value="">請選擇</option>
                    <option value="北部">北部</option>
                    <option value="中部">中部</option>
                    <option value="南部">南部</option>
                    <option value="東部">東部</option>
                  </select>
                </div><br>
              </div>

              <div class="col-12">
                <div class="input-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>預計活動月份</b></span>
                  </div>
                  <input type="date" name="date" class="form-control" required>
                </div>
              </div>

              <div class="col-12">
                <div class="input-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>可提供的贊助類型</b></span>
                  </div>
                  <select class="form-select" name="sponsorship" id="sponsorship" required>
                    <option value="">請選擇</option>
                    <option value="金錢">金錢</option>
                    <option value="物資">物資</option>
                    <option value="場地">場地</option>
                    <option value="提供實習">提供實習</option>
                  </select>
                </div><br>
              </div>

              <!-- 贊助範圍（動態顯示） -->
              <div class="col-12" id="moneyRangeGroup" style="display:none; margin-top:10px;">
                <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                  <span class="ms-1"><b>贊助範圍</b></span>
                </div>
                <select class="form-select" name="money">
                  <option value="$20,000以下">$20,000以下</option>
                  <option value="$20,001-$30,000">$20,001-$30,000</option>
                  <option value="$30,001-$50,000">$30,001-$50,000</option>
                  <option value="$50,001-$70,000">$50,001-$70,000</option>
                  <option value="$70,001以上">$70,001以上</option>
                </select><br>
              </div>

              <div class="col-12">
                <div class="input-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>希望社團達到目的</b></span>
                  </div>
                  <select class="form-select" name="hope" required>
                    <option value="">請選擇</option>
                    <option value="宣傳">宣傳</option>
                    <option value="表演">表演</option>
                  </select>
                </div><br>
              </div>

              <div class="col-12">
                <div class="input-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>內文標題</b></span>
                  </div>
                  <input class="form-control" type="text" placeholder="請輸入內文標題" name="title" required>
                </div>
              </div>

              <div class="col-12">
                <div class="input-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>內文</b></span>
                  </div>
                  <textarea name="information" placeholder="請輸入內文內容" required></textarea>
                </div>
              </div>

              <div class="col-12">
                <button class="btn btn-light w-100 py-2" type="submit"><b>發布</b></button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

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

  <!-- 贊助類型切換控制贊助範圍顯示 -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const sponsorshipSelect = document.getElementById('sponsorship');
      const moneyRangeGroup = document.getElementById('moneyRangeGroup');

      sponsorshipSelect.addEventListener('change', function () {
        moneyRangeGroup.style.display = (this.value === '金錢') ? 'block' : 'none';
      });
    });
  </script>
</body>

</html>
