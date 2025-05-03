<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <title>社團企業媒合平台</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">


  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
  
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
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav">
                            <li><a href="de.html" class="active">首頁</a></li>
                            <li><a href="properties4.php">瀏覽</a></li>
                            <li><a href="de_contact.php">發布</a></li>
                            <li><a href="dehistory.php">發布歷史</a></li>
                            <li><a href="self.de.php">個人頁面</a></li>
                            <li><a href="login.html">登出</a></li>
                            <li><a href="advanced search for department society.html"><i class="fa fa-calendar"></i>進階搜尋</ruby></a>
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

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="#">Home</a> / Contact Us</span>
          <h3>系學會發布贊助需求</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-page section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6" style="margin:auto">
        <form id="contact-form" action="de_contact1.php" method="post" enctype="multipart/form-data">


        <?php
        session_start();
        $link = mysqli_connect('localhost', 'root', '', 'SA');
        
        $sql = "SELECT * FROM identity WHERE identityID = '" . $_SESSION['identityID'] . "'";
        $result = mysqli_query($link, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
          $deschool = $row['deschool'];
          $dename = $row['dename'];
          $deyear = $row['deyear'];
          $deins = $row['deins'];
        }
        ?>
        <input type="hidden" name="identityID" value="<?php echo $_SESSION['identityID']; ?>">
          <div class="row">
            <div class="col-12">
                <div class="input-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>學校名稱</b></span>
                  </div>
                  <input class="form-control" type="text" placeholder="請輸入學校名稱(請輸入學校全名eg:輔仁大學)" aria-label="請輸入學校全名"
                    name="deschool" required value="<?php echo $deschool; ?>" >
                </div>
            <div class="input-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>系學會名稱</b></span>
                  </div>
                  <input class="form-control" type="text" placeholder="請輸入社團名稱" aria-label="請輸社團名稱" name="dename"
                  required value="<?php echo $dename; ?>" >
                </div>
                <div class="col-12">
                  <div class="input-group">
                    <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                      <span class="ms-1"><b>社團成立年份</b></span>
                    </div>
                    <input class="form-control" type="text" placeholder="請輸入年份" aria-label="請輸入年份" name="deyear"
                     value="<?php echo $deyear; ?>" >
                  </div>
                </div>

            <div class="col-12">
              <div class="input-group">
                <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                  <span class="ms-1"><b>內文標題(必填)</b></span>
                </div>
                <input class="form-control" type="text" placeholder="請輸入內文標題" aria-label="Enter a City or Airport"
                  name="title" value="" required title="必填欄位！">
                <div class="invalid-feedback">請填寫內文標題</div>
              </div>
            </div>
            <div class="col-12">
                <div class="input-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>需要的贊助類型(必填)</b></span>
                  </div>
                  <select class="form-select" name="support_type" id="support_type" required>
                    <option value="">請選擇</option>
                    <option value="金錢">金錢</option>
                    <option value="物資">物資</option>
                    <option value="場地">場地</option>
                    <option value="提供實習">提供實習</option>
                  </select>
                </div>
              </div>
              
            </div>
            <br>
            <br>

            <div class="row g-3">
              <div class="col-12">
                <div class="col-12" id="money-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>預算範圍</b></span>
                  </div>
                  <select class="form-select" aria-label="Default select example" name="money" id="money" title="必填欄位！">
                    <option value="">請選擇</option>
                    <option value="$20,000以下">$20,000以下</option>
                    <option value="$20,001-$30,000">$20,001-$30,000</option>
                    <option value="$30,001-$50,000">$30,001-$50,000</option>
                    <option value="$50,001-$70,000">$50,001-$70,000</option>
                    <option value="$70,001以上">$70,001以上</option>
                  </select>
                </div>


              
                <div class="input-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>預估規模(必填)</b></span>
                  </div>
                  <select class="form-control" type="text" placeholder="選擇預估規模人數" aria-label="請輸入學校全名" name="people"
                    required>
                    <option value="">請選擇</option>
                    <option value="0-10人">0-10人</option>
                    <option value="11-20人">11-20人</option>
                    <option value="21-30人">21-30人</option>
                    <option value="31-40人">31-40人</option>
                    <option value="41-50人">41-50人</option>
                    <option value="50人人以上">50人以上</option>
                  </select>
                </div>
                <br>
                
                <div class="col-12">
                  <div class="input-group">
                    <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                      <span class="ms-1"><b>活動地區(必填)</b></span>
                    </div>
                    <select class="form-select" name="region" id="region" required title="必填欄位！">
                      <option value="">請選擇</option>
                      <option value="北部">北部</option>
                      <option value="中部">中部</option>
                      <option value="南部">南部</option>
                      <option value="東部">東部</option>
                    </select>
                  </div>
                </div>

                <br>
                <div class="col-12">
                  <div class="input-group">
                    <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                      <span class="ms-1"><b>預計活動月份(必填)</b></span>
                    </div>
                    <input type="date" name="event_time" id="event_time" class="form-control" required>
                  </div>
                </div>

                

                <div class="col-15">
                  <div class="input-group">
                    <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                      <span class="ms-2"><b>企劃書上傳(必填)</b></span>
                    </div>
                    <input class="form-control" type="file" name="upload" accept=".pdf,.doc,.docx,.jpg,.png" required>
                  </div>
                </div>

                <div class="col-12">
                  <div class="input-group">
                    <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                      <span class="ms-1"><b>社群連結</b></span>
                    </div>
                    <input class="form-control" type="text" placeholder="請輸入相關社群連結"
                       name="ins" value="<?php echo $deins; ?>" >
                  </div>
                </div>

                <div class="col-lg-12">
                  <div class="input-group">
                    <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                      <span class="ms-1"><b>內文(必填)</b></span>
                    </div>
                    <textarea class="form-control" name="information" id="information" placeholder="請輸入內文內容" required></textarea>
                  </div>
                </div>

                <div class="col-12">
                  <button class="btn btn-light w-100 py-2" type="submit"><b>發布</b></button>

                </div>
              </div>
            </div>
        </form>
      </div>
      <script>
        (function () {
          'use strict';

          const form = document.querySelector('#contact-form');
          const supportTypeSelect = document.getElementById('support_type');
          const moneyGroup = document.getElementById('money-group');
          const moneySelect = document.getElementById('money');

          // 切換預算欄位顯示與必填狀態
          function toggleMoneyField() {
            if (supportTypeSelect.value === '金錢') {
              moneyGroup.style.display = 'block';
              moneySelect.setAttribute('required', 'required');
            } else {
              moneyGroup.style.display = 'none';
              moneySelect.removeAttribute('required');
              moneySelect.value = ""; // 清除選項
            }
          }

          // 初始設定
          toggleMoneyField();

          // 綁定事件
          supportTypeSelect.addEventListener('change', toggleMoneyField);

          // 原本的 Bootstrap 驗證功能
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        })();
      </script>

      
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
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>

</body>

</html>