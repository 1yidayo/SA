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
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
<!--

TemplateMo 591 villa agency

https://templatemo.com/tm-591-villa-agency

-->

    <style>
.properties-box {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
}


.properties-items {
    width: 30%; /* 保持與原本大小相近 */
    min-width: 300px; /* 避免縮小過度 */
}

/* 讓小螢幕時調整排列 */
@media (max-width: 992px) {
    .properties-items {
        width: 45%; /* 平板改為兩欄 */
    }
}

@media (max-width: 600px) {
    .properties-items {
        width: 100%; /* 手機版單欄 */
    }
}

    </style>


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
                    
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                            <li><a href="de.html" class="active">首頁</a></li>
                            <li><a href="properties4.php">瀏覽</a></li>
                            <li><a href="de_contact.php">發布</a></li>
                            <li><a href="dehistory.php">發布歷史</a></li>
                            <li><a href="self.de.php">個人頁面</a></li>
                            <li><a href="login.html">登出</a></li>
                            <li><a href="advanced search for department society.html"><i class="fa fa-calendar"></i>進階搜尋</a>
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
          <h3>企業贊助</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="section properties">
    <div class="container">
    <div id="filter-buttons" class="text-center mb-4">
  <div id="industry-buttons" class="mb-2">
    <strong>行業別：</strong>

  </div>
  <div id="type-buttons" class="mb-2">
    <strong>贊助類型：</strong>
    <button class="btn btn-outline-warning mx-1 filter-btn" data-type="type" data-value="金錢">金錢</button>
    <button class="btn btn-outline-warning mx-1 filter-btn" data-type="type" data-value="物資">物資</button>
    <button class="btn btn-outline-warning mx-1 filter-btn" data-type="type" data-value="場地">場地</button>
    <button class="btn btn-outline-warning mx-1 filter-btn" data-type="type" data-value="提供實習">提供實習</button>
  </div>
</div>

      <div class="row properties-box">
      <?php

$link = mysqli_connect('localhost', 'root', '', 'SAS');

$userID = $_SESSION['userID'] ?? null;

$sql = "SELECT * FROM en_requirements";
$result = mysqli_query($link, $sql);

while($row = mysqli_fetch_assoc($result)){
  $enrequirement_num = $row['enrequirement_num'];

  // 判斷是否已收藏
  $isFavorited = false;
  if ($userID) {
    $check_sql = "SELECT * FROM user_favorites WHERE userID='$userID' AND requirement_num='$enrequirement_num'";
    $check_result = mysqli_query($link, $check_sql);
    $isFavorited = mysqli_num_rows($check_result) > 0;
  }

  echo "<div class='col-lg-4 col-md-6 align-self-center mb-30 properties-items sponsor-card' data-industry='" . $row['type'] . "' data-type='" . $row['sponsorship'] . "'>
          <div class='item'>
              <h4><a href='enterprise.php?enrequirement_num=" . $row['enrequirement_num'] . "'>" . $row['title'] . "</a></h4>
              <ul>
                  <li>贊助類型：<span>" . $row['sponsorship'] . "</span></li>
                  <li>企業行業別：<span>" . $row['type'] . "</span></li>
              </ul>
              <div class='main-button mb-2'>
                  <a href='enterprise.php?enrequirement_num=" . $row['enrequirement_num'] . "'>了解活動詳情</a>
              </div>
              <li>發布時間：<span>" . $row['created_time'] . "</span></li><br>";

  // 收藏按鈕（若已登入才顯示）
  if ($userID) {
    echo "<form action='toggle_favorite.php' method='POST'>
            <input type='hidden' name='requirement_num' value='$enrequirement_num'>
            <button type='submit' class='btn btn-sm " . ($isFavorited ? "btn-danger" : "btn-outline-primary") . "'>" .
              ($isFavorited ? "取消收藏" : "加入收藏") .
            "</button>
          </form>";
  } else {
    echo "<div><small class='text-muted'>請先登入以加入收藏</small></div>";
  }

  echo "  </div>
        </div>";
}
?>


</div>

        </div>
      <div class="row">
        <!-- <div class="col-lg-12">
          <ul class="pagination">
            <li><a href="#">1</a></li>
            <li><a class="is_active" href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">>></a></li>
          </ul>
        </div> -->
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

    <?php
    $link = mysqli_connect('localhost', 'root', '', 'SAS');
    $sql = "SELECT DISTINCT type FROM en_requirements WHERE type IS NOT NULL AND type != ''";
    $result = mysqli_query($link, $sql);

    $industries = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $industries[] = $row['type'];
    }
    ?>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/isotope.min.js"></script>
<script src="assets/js/owl-carousel.js"></script>
<script src="assets/js/counter.js"></script>
<script src="assets/js/custom.js"></script>

<!-- 這是新增的篩選功能腳本 -->
<script>
  const selectedFilters = {
    industry: null,
    type: null
  };

  // 從 PHP 拿到的行業資料
  const industriesFromDB = <?php echo json_encode($industries); ?>;
  const industryContainer = document.getElementById('industry-buttons');

  // 動態建立行業按鈕
  function createIndustryButton(industry) {
    const btn = document.createElement('button');
    btn.className = 'btn btn-outline-dark mx-1 filter-btn';
    btn.dataset.type = 'industry';
    btn.dataset.value = industry;
    btn.innerText = industry;
    industryContainer.appendChild(btn);
  }

  industriesFromDB.forEach(createIndustryButton);

  // 事件委派
  document.addEventListener('click', function (e) {
    if (e.target.classList.contains('filter-btn')) {
      handleFilterClick(e);
    }
  });

  // 點擊篩選邏輯
  function handleFilterClick(e) {
    const btn = e.target;
    const type = btn.dataset.type;
    const value = btn.dataset.value;

    const sameValueClicked = selectedFilters[type] === value;

    // 清除所有同類型按鈕的 active 樣式
    document.querySelectorAll(`button[data-type="${type}"]`).forEach(b => b.classList.remove('active'));

    if (sameValueClicked) {
      selectedFilters[type] = null;
    } else {
      selectedFilters[type] = value;
      btn.classList.add('active');
    }

    filterResults();
  }

  // 篩選邏輯
  function filterResults() {
    const allCards = document.querySelectorAll('.sponsor-card');
    let firstVisibleCard = null;

    allCards.forEach(card => {
      const cardIndustry = card.dataset.industry;
      const cardType = card.dataset.type;

      const matchIndustry = !selectedFilters.industry || selectedFilters.industry === cardIndustry;
      const matchType = !selectedFilters.type || selectedFilters.type === cardType;

      if (matchIndustry && matchType) {
        card.style.display = 'block';
        if (!firstVisibleCard) firstVisibleCard = card;
      } else {
        card.style.display = 'none';
      }
    });

    if (firstVisibleCard) {
      const yOffset = -100;
      const y = firstVisibleCard.getBoundingClientRect().top + window.pageYOffset + yOffset;
      window.scrollTo({ top: y, behavior: 'smooth' });
    }
  }
</script>

<style>
  .filter-btn.active {
    background-color: #ffc107;
    color: white;
    border-color: #ffc107;
  }
</style>
  </body>
</html>