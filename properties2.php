<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
  <title>社團企業媒合平台</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="assets/css/fontawesome.css" />
  <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css" />
  <link rel="stylesheet" href="assets/css/owl.css" />
  <link rel="stylesheet" href="assets/css/animate.css" />
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

  <style>
    .custom-filter-btn {
      border: 2px solid #ff6600;
      background-color: white;
      color: #ff6600;
      border-radius: 25px;
      padding: 8px 20px;
      font-weight: 500;
      transition: 0.3s ease-in-out;
    }

    .custom-filter-btn:hover,
    .custom-filter-btn.active {
      background-color: #ff6600;
      color: #fff;
      text-decoration: none;
    }

    .properties-box {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: flex-start;
    }

    .properties-items {
      width: 30%;
      min-width: 300px;
    }

    @media (max-width: 992px) {
      .properties-items {
        width: 45%;
      }
    }

    @media (max-width: 600px) {
      .properties-items {
        width: 100%;
      }
    }
  </style>
</head>

<body>
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
              <li><a href="first.html">登出</a></li>
              <li><a href="advanced search for club.html"><i class="fa fa-calendar"></i>進階搜尋</a></li>
            </ul>
            <a class="menu-trigger"><span>Menu</span></a>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h3>企業贊助</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="section properties">
    <div class="container">
      <?php
        $link = mysqli_connect('localhost', 'root', '', 'SAS');
        $industry = $_GET['industry'] ?? 'all';
        $type = $_GET['type'] ?? 'all';

        // 取得所有行業別（for 篩選按鈕）
        $industryResult = mysqli_query($link, "SELECT DISTINCT type FROM en_requirements WHERE type IS NOT NULL AND type != ''");
        $industries = [];
        while ($row = mysqli_fetch_assoc($industryResult)) {
          $industries[] = $row['type'];
        }

        function buildUrl($industry, $type) {
          $params = [];
          if ($industry !== 'all') $params[] = "industry=" . urlencode($industry);
          if ($type !== 'all') $params[] = "type=" . urlencode($type);
          return "?" . implode("&", $params);
        }
      ?>

      <div class="text-center mb-4">
        <strong>行業別：</strong>
        <a href="<?= buildUrl('all', $type) ?>" class="btn custom-filter-btn mx-1 <?= $industry === 'all' ? 'active' : '' ?>">全部</a>
        <?php foreach ($industries as $ind): ?>
          <a href="<?= buildUrl($ind, $type) ?>" class="btn custom-filter-btn mx-1 <?= $industry === $ind ? 'active' : '' ?>"><?= $ind ?></a>
        <?php endforeach; ?>
      </div>

      <div class="text-center mb-4">
        <strong>贊助類型：</strong>
        <?php
          $types = ['金錢', '物資', '場地', '提供實習'];
          echo "<a href='" . buildUrl($industry, 'all') . "' class='btn custom-filter-btn mx-1 " . ($type === 'all' ? 'active' : '') . "'>全部</a>";
          foreach ($types as $t) {
            echo "<a href='" . buildUrl($industry, $t) . "' class='btn custom-filter-btn mx-1 " . ($type === $t ? 'active' : '') . "'>$t</a>";
          }
        ?>
      </div>

      <div class="row properties-box">
        <?php
          $sql = "SELECT * FROM en_requirements WHERE 1";

          if ($industry !== 'all') {
            $safeIndustry = mysqli_real_escape_string($link, $industry);
            $sql .= " AND type = '$safeIndustry'";
          }
          if ($type !== 'all') {
            $safeType = mysqli_real_escape_string($link, $type);
            $sql .= " AND sponsorship LIKE '%$safeType%'";
          }

          $result = mysqli_query($link, $sql);
          while($row = mysqli_fetch_assoc($result)) {
            echo "<div class='properties-items'>
                    <div class='item'>
                      <h4><a href='enterprise.php?enrequirement_num=" . $row['enrequirement_num'] . "'>" . $row['title'] . "</a></h4>
                      <ul>
                        <li>贊助類型：<span>" . $row['sponsorship'] . "</span></li>
                        <li>企業行業別：<span>" . $row['type'] . "</span></li>
                      </ul>
                      <div class='main-button'>
                        <a href='enterprise.php?enrequirement_num=" . $row['enrequirement_num'] . "'>了解活動詳情</a>
                      </div>
                    </div>
                  </div>";
          }
        ?>
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

  <!-- JS -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
