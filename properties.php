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
    <!--

TemplateMo 591 villa agency

https://templatemo.com/tm-591-villa-agency

-->
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
                            <li><a href="en.html" class="active">首頁</a></li>
                            <li><a href="properties.php">瀏覽</a></li>
                            <li><a href="en_contact.php">發布</a></li>
                            <li><a href="enhistory.php">發布歷史</a></li>
                            <li><a href="enterprise_cooperations.php">我的合作</a></li>
                            <li><a href="self.en.php">個人頁面</a></li>
                            <li><a href="aftersearchforen.php">進階搜尋</a></li>
                            <li><a href="login.html"><i class="fa fa-calendar"></i>登出</a>
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
          <!-- <span class="breadcrumb"><a href="#">首頁</a> / 社團活動</span> -->
          <h3>企業搜尋相關社團</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="contact-page section"  style="align-item:center">
    <div class="container" style="margin-top: -50px; margin-right: 100px;">
      <form id="search-form" action="properties.php" method="post" style="align-item:right;">
        <div class="row">
          <div class="col-md-2">
          </div>
          <div class="col-2">
                <label for="school">學校</label>
                <input class="form-control" type="text" placeholder="請輸入學校名稱" name="school">
              </div>
              <div class="col-2">
                <label for="school">社團</label>
                <input class="form-control" type="text" placeholder="請輸入社團名稱" name="club">
              </div>
              <div class="col-2">
                <label for="support_type">贊助類型</label>
                <select name="support_type" id="support_type" class="form-control">
                  <option value="">請選擇</option>
                  <option value="金錢">金錢</option>
                  <option value="物資">物資</option>
                  <option value="場地">場地</option>
                  <option value="提供實習">提供實習</option>
                </select>
              </div>
          
          <div class="col-md-2" style="margin-top: 24px;">
            <button class="btn btn-primary" type="submit" style="background-color:black; border: black;"><b>搜尋</b></button>
          </div>
        </div>
      </form>
    </div>

  <div class="section properties">
    <div class="container">
      <div class="row properties-box">
        <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 adv">
        <?php
        $link = mysqli_connect('localhost', 'root', '', 'SAS');

        if (!$link) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        // 取得搜尋表單的輸入
        $school = isset($_POST['school']) ? mysqli_real_escape_string($link, $_POST['school']) : '';
        $club = isset($_POST['club']) ? mysqli_real_escape_string($link, $_POST['club']) : '';
        $support_type = isset($_POST['support_type']) ? mysqli_real_escape_string($link, $_POST['support_type']) : '';

        // 動態產生 WHERE 條件
        $conditions = array();

        if (!empty($school)) {
            $conditions[] = "school LIKE '%$school%'";
        }
        if (!empty($club)) {
            $conditions[] = "club LIKE '%$club%'";
        }
        if (!empty($support_type)) {
            $conditions[] = "support_type LIKE '%$support_type%'";
        }

        // 建構完整 SQL
        $sql = "SELECT * FROM club_requirements";
        if (count($conditions) > 0) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }

        $result = mysqli_query($link, $sql);
        if (!$result) {
            die("Query failed: " . mysqli_error($link));
        }

        if (mysqli_num_rows($result) == 0) {
            echo "<p>未找到符合的活動</p>";
        }

        while($row = mysqli_fetch_assoc($result)){
            echo "<div class='properties-items'>
                <div class='item'>
                    <h4><a href='enterprise.php?clrequirement_num=" . $row['clrequirement_num'] . "'>" . $row['title'] . "</a></h4>
                    <ul>
                        <li><span>" . $row['club'] . "</span></li>
                        <li>學校：<span>" . $row['school'] . "</span></li>
                        <li>需要贊助類型：<span>" . $row['support_type'] . "</span></li>
                    </ul>
                    <div class='main-button'>
                        <a href='enterprise.php?enrequirement_num=" . $row['clrequirement_num'] . "'>了解活動詳情</a>
                    </div>
                </div>
            </div>";
        }
    ?>
        </div>
      </div>
      <div class="row">
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="col-lg-12">
        <p>Copyright © 2048 Villa Agency Co., Ltd. All rights reserved.

          Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a> Distribution: <a
            href="https://themewagon.com">ThemeWagon</a></p>
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
