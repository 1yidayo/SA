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
                            <li><a href="ai.html">首頁</a></li>
                            <li><a href="properties3.php">瀏覽</a></li>
                            <li><a href="alumni contact.php"  class="active">發布</a></li>
                            <li><a href="aihistory.php">發布歷史</a></li>
                            <li><a href="self.ai.php">個人頁面</a></li>
                            <li><a href="login.html">登出</a></li>
                            <li><a href="advanced search for ai.html"><i class="fa fa-calendar"></i>進階搜尋</a>
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
          <h3>校友發布</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-page section">
  <div class="container">
    <div class="row">
      <div class="col-lg-6" style="margin:auto">
        <form id="contact-form" action="alumni_contact1.php" method="post" enctype="multipart/form-data">


        <?php
        session_start();
        $link = mysqli_connect('localhost', 'root', '', 'SAS');
        
        $sql = "SELECT * FROM identity WHERE identityID = '" . $_SESSION['identityID'] . "'";
        $result = mysqli_query($link, $sql);

        if ($row = mysqli_fetch_assoc($result)) {
          $ainame = $row['ainame'];
          $ainins = $row['ainins'];
        }
        ?>
        <input type="hidden" name="identityID" value="<?php echo $_SESSION['identityID']; ?>">

        <div class="row g-3">
          
                

          <div class="row">
            <div class="col-12">
                <div class="input-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>校友姓名</b></span>
                  </div>
                  <input class="form-control-plaintext" type="text" name="ainame" readonly value="<?php echo $ainame; ?>">

                </div>

            <div class="col-12">
                <div class="input-group">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>聯絡方式</b></span>
                  </div>
                  <input class="form-control-plaintext" type="text" name="ainins" readonly value="<?php echo $ainins; ?>">
                </div>

            <div class="col-12">
              <div class="input-group">
                <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                  <span class="ms-1"><b>公司名稱</b></span>
                </div>
                <input class="form-control" type="text" placeholder="請輸入" aria-label="Enter a City or Airport"
                  name="title" value="" required title="必填欄位！">
                <div class="invalid-feedback">請輸入</div>
              </div>
            </div>
            
              
            </div>
            <br>
            <br>

            <div class="col-lg-12">
                  <div class="input-group">
                    <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                      <span class="ms-1"><b>公司簡介及實習職位說明</b></span>
                    </div>
                    <textarea class="form-control" name="information" id="information" placeholder="請輸入" required></textarea>
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