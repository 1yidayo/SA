<?php
session_start();
$link = mysqli_connect('localhost', 'root', '', 'SAS');
$enrequirement_num = $_GET['enrequirement_num'];

// 抓活動資料
$sql = "SELECT er.*, 
               i.profile_img, 
               i.enterprise, 
               i.entype, 
               i.enplace, 
               i.enperson, 
               i.enins, 
               i.enphone, 
               i.enprefer, 
               i.endonate
        FROM en_requirements er
        LEFT JOIN identity i ON er.identityID = i.identityID
        WHERE er.enrequirement_num = '$enrequirement_num'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="zh-TW">

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
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
</head>

<body>
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots">
        <span></span><span></span><span></span>
      </div>
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
                <li><a href="post_cl.php">發布</a></li>
              <?php elseif ($_SESSION['level'] === 'en'): ?>
                <li><a href="post_en.php">發布</a></li>
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

              <li><a href="self_<?= $_SESSION['level'] ?>.php">個人頁面</a></li>
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
          <h3>企業貼文詳情</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <h2 style="font-size: 40px;" class="mb-0"><?= htmlspecialchars($row['title']) ?></h2>
      <?php if (isset($_SESSION['level']) && $_SESSION['level'] === 'cl'): ?>
        <?php
        $clubID = $_SESSION['identityID'];
        $enterpriseID = $row['identityID'];
        $check_sql = "SELECT * FROM cooperation_requests WHERE initiator='club' AND club_identityID='$clubID' AND enterprise_identityID='$enterpriseID' AND enrequirement_num='$enrequirement_num'";
        $check_result = mysqli_query($link, $check_sql);
        $requested = mysqli_num_rows($check_result) > 0;
        ?>
        <?php if ($requested): ?>
          <button class="btn btn-secondary" disabled>已申請</button>
        <?php else: ?>
          <form method="POST" action="send_cooperation.php" onsubmit="return confirm('確定要送出合作申請嗎？');">
            <input type="hidden" name="target_identityID" value="<?= $enterpriseID ?>" />
            <input type="hidden" name="enrequirement_num" value="<?= $enrequirement_num ?>" />
            <input type="hidden" name="initiator" value="club" />
            <button type="submit" class="btn btn-warning">申請合作</button>
          </form>
        <?php endif; ?>
      <?php elseif (!isset($_SESSION['level'])): ?>
        <a href="login.php" class="btn btn-danger">請先登入</a>
      <?php endif; ?>
    </div>
    <div class="card mb-4"></div>

    <div class="row">
      <!-- 左側：活動資訊 -->
      <div class="col-lg-3">
        <div class="card">
          <div class="card-body">
            <h5 style="font-size:25px; margin-bottom:10px;">活動資訊</h5>
            <p style="font-size:16px;"><strong>可提供贊助類型：</strong><?= $row['sponsorship'] ?></p>
            <?php if ($row['sponsorship'] === '金錢'): ?>
              <p style="font-size:16px;"><strong>贊助範圍：</strong><?= $row['money'] ?: '未填寫' ?></p>
            <?php endif; ?>
            <p style="font-size:16px;"><strong>預計活動時間：</strong><?= $row['date'] ?></p>
            <p style="font-size:16px;">
              <strong><?= ($row['sponsorship'] === '提供實習') ? '實習地區' : '活動地區' ?>：</strong><?= $row['region'] ?>
            </p>
            <p style="font-size:16px;"><strong>希望社團達到目的：</strong><?= $row['hope'] ?></p>
          </div>
        </div>
      </div>

      <!-- 中間：內文 + 留言 -->
      <div class="col-lg-6">
        <div class="card mb-3">
          <div class="card-body">
            <h5 style="font-size:25px; margin-bottom:10px;">贊助詳情內文</h5>
            <p style="font-size:16px;"><?= nl2br(htmlspecialchars($row['information'])) ?></p>
          </div>
        </div>

        <div class="card" id="comment-section">
          <div class="card-body">
            <h5 style="font-size:25px; margin-bottom:10px;">留言區</h5>
            <textarea id="comment-text" class="form-control mb-2" rows="2" placeholder="留下你的留言..."
              style="resize:none;"></textarea>
            <button class="btn btn-primary btn-sm text-end" id="submit-comment"
              style="background-color:black; border:black;">送出</button>
            <div id="comments-list"></div>
          </div>
        </div>
      </div>

      <!-- 右側：企業資訊 -->
      <div class="col-lg-3">
        <div class="card p-3">
          <div class="text-center mb-3">
            <?php $avatar = $row['profile_img'] ?: 'default-profile.png'; ?>
            <img src="uploads/<?= htmlspecialchars($avatar) ?>" alt="頭像" class="rounded-circle"
              style="width:100px;height:100px;object-fit:cover;">
          </div>
          <!-- <p><strong>企業名稱：</strong><?= htmlspecialchars($row['enterprise']) ?></p>
          <p><strong>行業別：</strong><?= htmlspecialchars($row['entype']) ?></p>
          <p><strong>所在地區：</strong><?= htmlspecialchars($row['enplace']) ?></p>
          <p><strong>負責人：</strong><?= htmlspecialchars($row['enperson']) ?></p>
          <p><strong>社群連結：</strong><a href="<?= htmlspecialchars($row['enins']) ?>"
              target="_blank"><?= htmlspecialchars($row['enins']) ?></a></p>
          <p><strong>Email／電話：</strong><?= htmlspecialchars($row['enphone']) ?></p>
          <p><strong>合作偏好：</strong><?= htmlspecialchars($row['enprefer']) ?></p> -->
          <p style="font-size: 16px; text-align: left;"><strong>企業名稱：</strong><?= $row['enterprise'] ?></p>
          <p style="font-size: 16px; text-align: left;"><strong>行業別：</strong><?= $row['entype'] ?></p>
          <p style="font-size: 16px; text-align: left;"><strong>所在地區：</strong><?= $row['enplace'] ?></p>
          <p style="font-size: 16px; text-align: left;"><strong>負責人：</strong><?= $row['enperson'] ?></p>
          <p style="font-size: 16px; text-align: left;"><strong>社群連結：</strong><a href="<?= $row['enins'] ?>"
              target="_blank"><?= $row['enins'] ?></a></p>
          <p style="font-size: 16px; text-align: left;"><strong>Email／電話：</strong><?= $row['enphone'] ?></p>
          <p style="font-size: 16px; text-align: left;"><strong>合作偏好：</strong><?= $row['enprefer'] ?></p>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <div class="container">
      <div class="col-lg-8">
        <p style="text-align:left; font-weight:bold;">社團企業媒合平台</p>
      </div>
    </div>
  </footer>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const submitBtn = document.getElementById('submit-comment');
      const commentText = document.getElementById('comment-text');
      const commentsList = document.getElementById('comments-list');
      const enrequirement_num = <?= json_encode($enrequirement_num) ?>;

      function loadComments() {
        fetch('fetch_comments.php?enrequirement_num=' + enrequirement_num)
          .then(res => res.text())
          .then(data => { commentsList.innerHTML = data; });
      }

      submitBtn.addEventListener('click', () => {
        const content = commentText.value.trim();
        if (!content) return;
        fetch('submit_comment.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: 'enrequirement_num=' + encodeURIComponent(enrequirement_num) + '&content=' + encodeURIComponent(content)
        }).then(res => res.text())
          .then(() => { commentText.value = ''; loadComments(); });
      });

      loadComments();
    });
  </script>
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>