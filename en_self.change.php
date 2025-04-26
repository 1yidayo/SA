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
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

  <style>
    #calendar {
      background-color: white;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
  </style>
</head>

<body>
  <!-- ***** Preloader Start ***** -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span><span></span><span></span>
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
            <ul class="nav">
              <li><a href="cl.html" class="active">首頁</a></li>
              <li><a href="properties2.php">瀏覽</a></li>
              <li><a href="club contact.html">發布</a></li>
              <li><a href="clubhistory.php">發布歷史</a></li>
              <li><a href="self.cl.php">個人頁面</a></li>
              <li><a href="first.html">登出</a></li>
              <li><a href="advanced search for club.html"><i class="fa fa-calendar"></i>進階搜尋</a></li>
            </ul>
            <a class='menu-trigger'>
              <span>Menu</span>
            </a>
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
          <span class="breadcrumb"><a href="#">Home</a> / My Page</span>
          <h3>企業個人頁面</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row">
      <!-- 左邊表單 -->
      <div class="col-lg-6">
        <h2 class="mb-4">修改您的個人檔案</h2>
        <form id="contact-form" action="club_contact.php" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="school" class="form-label"><b>企業名稱</b></label>
            <input type="text" class="form-control" name="school" id="school" placeholder="請輸入企業全名">
          </div>
          <div class="mb-3">
            <label for="club_name" class="form-label"><b>行業別</b></label>
            <input type="text" class="form-control" name="club_name" id="club_name" placeholder="請輸入行業別">
          </div>
          <div class="mb-3">
            <label for="club_size" class="form-label"><b>統一編號</b></label>
            <input type="text" class="form-control" name="club_size" id="club_size" placeholder="請輸入統一編號">
          </div>
          <div class="mb-3">
            <label for="established_year" class="form-label"><b>聯絡方式</b></label>
            <input type="text" class="form-control" name="established_year" id="established_year" placeholder="請輸入聯絡方式">
          </div>
          <button class="btn btn-dark w-100" type="submit"><b>儲存修改</b></button>
        </form>
      </div>

      <!-- 右邊行事曆 -->
      <div class="col-lg-6">
        <h2 class="mb-4">行事曆</h2>
        <div id="calendar"></div>
      </div>
    </div>
  </div>

  <!-- FullCalendar -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const calendarEl = document.getElementById('calendar');
      const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'title',
          center: '',
          right: 'today prev,next'
        },
        initialDate: new Date(),
        selectable: true,
        dateClick: function (info) {
          alert(info.dateStr + ' 目前沒有任何行程。');
        }
      });
      calendar.render();
    });
  </script>

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
