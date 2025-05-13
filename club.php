<!DOCTYPE html>
<html lang="zh-TW">

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
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
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
            <ul class="nav">
              <li><a href="en.html" class="active">首頁</a></li>
              <li><a href="properties.php">瀏覽</a></li>
              <li><a href="en_contact.php">發布</a></li>
              <li><a href="enhistory.php">發布歷史</a></li>
              <li><a href="self.en.php">個人頁面</a></li>
              <li><a href="login.html">登出</a></li>
              <li><a href="advanced search for enterprise.html"><i class="fa fa-calendar"></i>進階搜尋</a></li>
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
          <h3>社團活動詳情</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="single-property section">
    <div class="container">
      <div class="row">
        <?php
$clrequirement_num = $_GET['clrequirement_num'];
$link = mysqli_connect('localhost', 'root', '', 'SAS');
$sql = "SELECT * FROM club_requirements WHERE clrequirement_num = '$clrequirement_num'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result); // 只取出一筆結果，直接存入 $row 變數

if ($row) {
  echo "<div class='col-lg-8'>
          <div class='main-content'>
            <h2 class='mb-3'>" . htmlspecialchars($row['title']) . "</h2>
          </div>
        </div>";
} else {
  echo "<div class='col-lg-8'>
          <div class='main-content'>
            <h2 class='mb-3'>找不到資料</h2>
          </div>
        </div>";
}
?>


        <div class="col-lg-8">
          <div class="card shadow-sm p-4 mb-4 bg-white rounded">
            <div class="card-body">
              <h5 class="card-title font-weight-bold mb-3">活動詳情內文：</h5>
              <p class="card-text"><?= nl2br(htmlspecialchars($row['information'])) ?></p>
            </div>
          </div>

          <!-- 留言區 -->
          <div class="card shadow-sm p-4 mb-4 bg-white rounded" id="comment-section">
            <h5 class="mb-3">留言區</h5>

            <!-- 留言輸入框 -->
            <div class="d-flex mb-4">
              <div class="flex-grow-1">
                <textarea id="comment-text" class="form-control mb-2" rows="2" placeholder="留下你的留言..." style="resize: none;"></textarea>
                <button class="btn btn-primary btn-sm" id="submit-comment">送出</button>
              </div>
            </div>

            <!-- 顯示留言列表 -->
            <div id="comments-list"></div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="info-table">
            <ul>
              <li>
                <h4>贊助類型<br><span><?= $row['support_type'] ?></span></h4>
              </li>

              <?php if ($row['support_type'] === '金錢'): ?>
              <li>
                <h4>贊助範圍<br><span><?= $row['money'] ?? '未填寫' ?></span></h4>
              </li>
              <?php endif; ?>

              <li>
                <h4>活動預計規模<br><span><?= $row['people'] ?></span></h4>
              </li>
              <li>
                <h4>活動類型<br><span><?= $row['type'] ?></span></h4>
              </li>
              <li>
                <h4>企劃書內容<br>
                  <span>
                  <a href="<?= htmlspecialchars($row['upload']) ?>" download>下載企劃書</a>
                  </span>
                </h4>
              </li>

              <li>
                <h4><a href="<?= $row['ins'] ?>" target="_blank">社群連結</a><br><span></span></h4>
              </li>
            </ul>
          </div>
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
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const submitBtn = document.getElementById('submit-comment');
      const commentText = document.getElementById('comment-text');
      const commentsList = document.getElementById('comments-list');
      const clrequirement_num = <?= json_encode($clrequirement_num) ?>;

      function loadComments() {
        fetch('fetch_comments.php?clrequirement_num=' + clrequirement_num)
          .then(res => res.text())
          .then(data => {
            commentsList.innerHTML = data;
          });
      }

      submitBtn.addEventListener('click', () => {
        const content = commentText.value.trim();
        if (!content) return;

        fetch('submit_comment.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'clrequirement_num=' + encodeURIComponent(clrequirement_num) + '&content=' + encodeURIComponent(content)
        }).then(res => res.text())
          .then(() => {
            commentText.value = '';
            loadComments();
          });
      });

      loadComments();
    });
  </script>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>

</body>

</html>
