<?php
session_start();
?>
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
                <li><a href="post_cl.php" class="active">發布</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="post_en.php" class="active">發布</a></li>
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
                <li><a href="self_cl.php">個人頁面</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="self_en.php">個人頁面</a></li>
              <?php endif; ?>
              <li><a href="logout.php">登出</a></li>
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

              $link = mysqli_connect('localhost', 'root', '', 'SAS');
              $sql = "SELECT * FROM identity WHERE identityID = '" . $_SESSION['identityID'] . "'";
              $result = mysqli_query($link, $sql);
              if ($row = mysqli_fetch_assoc($result)) {
                $enterprise = $row['enterprise'];
                $entype = $row['entype'];
                $code = $row['code'];
                $enins = $row['enins'];
                $enplace = $row['enplace'];
                $enphone = $row['enphone'];
                $enperson = $row['enperson'];
              }
              ?>
              <input type="hidden" name="identityID" value="<?php echo $_SESSION['identityID']; ?>">

    <input class="form-control" type="hidden" placeholder="請輸入企業名稱" name="enterprise"
      value="<?php echo $enterprise; ?>" required readonly>

    <input class="form-control" type="hidden" placeholder="請輸入企業行業別(eg:科技業、金融業)" name="type"
      value="<?php echo $entype; ?>" required readonly>

                  <input class="form-control" type="hidden" placeholder="請輸入公司統一編號" name="code"
                    value="<?php echo $code; ?>" required>

                  <input class="form-control" type="hidden" placeholder="請輸入負責人姓名與職稱" name="person"
                    value="<?php echo $enperson; ?>" required>

                  <input class="form-control" type="hidden" placeholder="請輸入企業官方網站或社群連結" name="ins"
                    value="<?php echo $enins; ?>" required>

                  <input class="form-control" type="hidden" placeholder="請輸入企業Gmail/連絡電話" name="phone"
                    value="<?php echo $enphone; ?>" required>

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
      <option value="其他">其他</option>
    </select>
  </div><br>
</div><br>
            <div id="event_time-group">
              <div class="col-12">
                <div class="input-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>預計提供幫助日期</b></span>
                  </div>
                  <input type="date" name="date" class="form-control" required>
                </div>
              </div>
            </div>
              

              <div class="col-12">
  

              <!-- 贊助範圍（動態顯示） -->
              <div class="col-12" id="moneyRangeGroup" style="display:none; margin-top:10px;">
                <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                  <span class="ms-1"><b>贊助範圍</b></span>
                </div>
                <select class="form-select" name="money">
                  <option value="">請選擇</option>
                  <option value="$20,000以下">$20,000以下</option>
                  <option value="$20,001-$30,000">$20,001-$30,000</option>
                  <option value="$30,001-$50,000">$30,001-$50,000</option>
                  <option value="$50,001-$70,000">$50,001-$70,000</option>
                  <option value="$70,001以上">$70,001以上</option>
                </select><br>
              </div>
                <div class="col-12" id="intern-group" style="display:none;">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>預估提供的實習人數(必填)</b></span>
                  </div>
                  <input type="number" class="form-control" name="intern_number" id="intern_number"
                    placeholder="請輸入實習人數" min="1" title="必填欄位！">
                </div>
                <div class="col-12" id="others-group" style="display:none;">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>概述(必填)</b></span>
                  </div>
                  <input type="text" class="form-control" name="others" id="others"
                    placeholder="請概述可提供的贊助" title="必填欄位！">
                </div>


              <div class="col-12">
  <div id="region-group">
  <div class="input-group">
    <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
      <span class="ms-1" id="region-label"><b>贊助地區</b></span>
    </div>
    <select class="form-select" name="region" required>
      <option value="">請選擇</option>
      <option value="北部">北部</option>
      <option value="中部">中部</option>
      <option value="南部">南部</option>
      <option value="東部">東部</option>
    </select>
  </div>
  <br>
</div>
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
                    <option value="了解本企業職務">了解本企業職務</option>
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

  <!-- 贊助類型切換控制贊助範圍顯示 -->
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const sponsorshipSelect = document.getElementById('sponsorship');
    const regionLabel = document.getElementById('region-label');
    const moneyRangeGroup = document.getElementById('moneyRangeGroup');
    const internGroup = document.getElementById('intern-group');
    const internInput = document.getElementById('intern_number');
    const eventTimeGroup = document.getElementById('event_time-group');
    const eventTimeInput = eventTimeGroup.querySelector('input');
    const regionGroup = document.getElementById('region-group');
    const regionInput = regionGroup.querySelector('select');

    sponsorshipSelect.addEventListener('change', function () {
  const selectedValue = this.value;

  // Change region label
  if (selectedValue === '提供實習') {
    regionLabel.innerHTML = '<b>實習地區</b>';
  } else {
    regionLabel.innerHTML = '<b>贊助地區</b>';
  }

  // Show/hide money range
  moneyRangeGroup.style.display = (selectedValue === '金錢') ? 'block' : 'none';

  // Show/hide intern group and region
  if (selectedValue === '提供實習') {
    internGroup.style.display = 'block';
    internInput.setAttribute('required', 'required');

    regionGroup.style.display = 'none';
    regionInput.removeAttribute('required');
  } else {
    internGroup.style.display = 'none';
    internInput.removeAttribute('required');

    regionGroup.style.display = 'block';
    regionInput.setAttribute('required', 'required');
  }

  // Show/hide 'others' group
  if (selectedValue === '其他') {
    document.getElementById('others-group').style.display = 'block';
    document.getElementById('others').setAttribute('required', 'required');
  } else {
    document.getElementById('others-group').style.display = 'none';
    document.getElementById('others').removeAttribute('required');
  }
});
  });
</script>


</body>

</html>