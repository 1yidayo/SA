<?php
session_start();
$link = mysqli_connect('localhost', 'root', '', 'SAS');
$clrequirement_num = $_GET['clrequirement_num'];

// 抓活動資料
$sql = "SELECT cr.*, i.profile_img, i.school, i.club, i.clsize, i.clyear, i.cltype, i.clins, i.clphone
        FROM club_requirements cr
        LEFT JOIN identity i ON cr.identityID = i.identityID
        WHERE clrequirement_num = '$clrequirement_num'";
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
              <li><a href="logout.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登出</a></li>
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
          <h3>社團活動詳情</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- <div class="row">
    <div class="d-flex justify-content-between align-items-center">
      <h2 class='mb-0' style='font-size: 40px;'><?= htmlspecialchars($row['title']) ?></h2>

      <?php
      if ($_SESSION['level'] === 'en') {
        $enterpriseID = $_SESSION['identityID'];
        $clubID = $row['identityID'];
        $check_sql = "SELECT * FROM cooperation_requests WHERE initiator = 'enterprise' AND enterprise_identityID = '$enterpriseID' AND club_identityID = '$clubID' AND enrequirement_num = '$clrequirement_num'";
        $check_result = mysqli_query($link, $check_sql);
        $invited = mysqli_num_rows($check_result) > 0;

        if ($invited) {
          echo "<button class='btn btn-secondary' disabled>已邀請</button>";
        } else {
          echo "<form method='POST' action='send_cooperation.php'>
                  <input type='hidden' name='target_identityID' value='$clubID' />
                  <input type='hidden' name='enrequirement_num' value='$clrequirement_num' />
                  <button type='submit' class='btn btn-warning'>邀請合作</button>
                </form>";
        }
      }
      ?>
    </div>

    <div class="card col-lg-3">
      <div class="card-body">
        <h5>活動資訊</h5>
        <p><strong>贊助類型：</strong> <?= $row['support_type'] ?></p>

        <?php if ($row['support_type'] === '金錢'): ?>
          <p><strong>贊助範圍：</strong> <?= $row['money'] ?? '未填寫' ?></p>
        <?php endif; ?>

        <?php if ($row['support_type'] === '提供實習'): ?>
          <p><strong>預估需要的實習人數：</strong> <?= $row['intern_number'] ?? '未填寫' ?></p>
        <?php endif; ?>

        <?php if ($row['support_type'] !== 'exposure' && $row['support_type'] !== '提供實習'): ?>
          <p><strong>活動預計規模：</strong> <?= $row['people'] ?? '未填寫' ?></p>
          <p><strong>活動地區：</strong> <?= $row['region'] ?? '未填寫' ?></p>
        <?php endif; ?>

        <p><strong>活動類型：</strong> <?= $row['type'] ?></p>
        <p><strong>企劃書：</strong> <a href="<?= htmlspecialchars($row['upload']) ?>" download>下載</a></p>
        <p><strong>社群連結：</strong> <a href="<?= $row['ins'] ?>" target="_blank">點此前往</a></p>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="main-content">
        <div class="card card-body">
          <h5>活動詳情內文</h5>
          <p><?= nl2br(htmlspecialchars($row['information'])) ?></p>
        </div>

        <div class="card" id="comment-section">
          <div class="card-body">
            <h5>留言區</h5>
            <textarea id="comment-text" class="form-control mb-2" rows="2" placeholder="留下你的留言..." style="resize: none;"></textarea>
            <button class="btn btn-primary btn-sm" id="submit-comment">送出</button>
            <div id="comments-list"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card p-3">
        <div class="text-center">
          <img src="uploads/<?= $row['profile_img'] ?? 'default-profile.png' ?>" alt="頭像" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;" />
        </div>
        <p><strong>學校：</strong><?= $row['school'] ?></p>
        <p><strong>社團：</strong><?= $row['club'] ?></p>
        <p><strong>人數：</strong><?= $row['clsize'] ?></p>
        <p><strong>成立年：</strong><?= $row['clyear'] ?></p>
        <p><strong>類型：</strong><?= $row['cltype'] ?></p>
        <p><strong>社群：</strong><a href="<?= $row['clins'] ?>" target="_blank"><?= $row['clins'] ?></a></p>
        <p><strong>電話：</strong><?= $row['clphone'] ?></p>
      </div>
    </div>
  </div> -->

  <div class="container mt-4">
    <!-- <h2 class='mb-0' style='font-size: 40px;'><?= htmlspecialchars($row['title']) ?></h2> -->

    <div class="d-flex justify-content-between align-items-center mb-2">
      <h2 class='mb-0' style='font-size: 40px;'><?= htmlspecialchars($row['title']) ?></h2>
      <?php
    // 判斷是否登入
    if (isset($_SESSION['level']) && $_SESSION['level'] === 'en') {
      $enterpriseID = $_SESSION['identityID'];
      $clubID = $row['identityID'];

      // 檢查是否已送出合作邀請
      $check_sql = "SELECT * FROM cooperation_requests 
                    WHERE initiator = 'enterprise' 
                    AND enterprise_identityID = '$enterpriseID' 
                    AND club_identityID = '$clubID' 
                    AND clrequirement_num = '$clrequirement_num'";
      $check_result = mysqli_query($link, $check_sql);
      $invited = mysqli_num_rows($check_result) > 0;

      if ($invited) {
        echo "<button class='btn btn-secondary' disabled>已邀請</button>";
      } else {
        echo "<form method='POST' action='send_cooperation.php' onsubmit='return confirm(\"確定要送出合作邀請嗎？\");'>
                <input type='hidden' name='target_identityID' value='$clubID' />
                <input type='hidden' name='clrequirement_num' value='$clrequirement_num' />
                <input type='hidden' name='initiator' value='enterprise' />
                <button type='submit' class='btn btn-warning'>邀請合作</button>
              </form>";
      }
    } elseif (!isset($_SESSION['level'])) {
      echo "<a href='login.php' class='btn btn-danger'>請先登入</a>";
    }
    ?>
    </div>
    <div class="card mb-4"></div>

    <div class="row">
      <!-- 左邊：活動資訊 -->
      <div class="col-lg-3">
        <div class="card">
          <div class="card-body">
            <h5 style="font-size: 25px; margin-bottom: 10px;">活動資訊</h5>
            <p style="font-size: 16px; text-align: left;"><strong>贊助類型：</strong> <?= $row['support_type'] ?></p>
            <?php if ($row['support_type'] === '金錢'): ?>
              <p style="font-size: 16px; text-align: left;"><strong>贊助範圍：</strong> <?= $row['money'] ?? '未填寫' ?></p>
            <?php endif; ?>
            <?php if ($row['support_type'] === '提供實習'): ?>
              <p style="font-size: 16px; text-align: left;"><strong>預估需要的實習人數：</strong>
                <?= $row['intern_number'] ?? '未填寫' ?></p>
            <?php endif; ?>
            <?php if ($row['support_type'] !== 'exposure' && $row['support_type'] !== '提供實習'): ?>
              <p style="font-size: 16px; text-align: left;"><strong>活動預計規模：</strong> <?= $row['people'] ?? '未填寫' ?></p>
              <p style="font-size: 16px; text-align: left;"><strong>活動地區：</strong> <?= $row['region'] ?? '未填寫' ?></p>
            <?php endif; ?>
            <p style="font-size: 16px; text-align: left;"><strong>活動類型：</strong> <?= $row['type'] ?></p>
            <p style="font-size: 16px; text-align: left;"><strong>企劃書：</strong> <a
                href="<?= htmlspecialchars($row['upload']) ?>" download>下載</a></p>
            <p style="font-size: 16px; text-align: left;"><strong>社群連結：</strong> <a href="<?= $row['ins'] ?>"
                target="_blank">點此前往</a></p>
          </div>
        </div>
      </div>

      <!-- 中間：內文 + 留言區 -->
      <div class="col-lg-6">
        <div class="card mb-3">
          <div class="card-body">
            <h5 style="font-size: 25px; margin-bottom: 10px;">活動詳情內文</h5>
            <p style="font-size: 16px;"><?= nl2br(htmlspecialchars($row['information'])) ?></p>
          </div>
        </div>

        <div class="card" id="comment-section">
          <div class="card-body">
            <h5 style="font-size: 25px; margin-bottom: 10px;">留言區</h5>
            <textarea id="comment-text" class="form-control mb-2" rows="2" placeholder="留下你的留言..."
              style="resize: none;"></textarea>
            <button class="btn btn-primary btn-sm text-end" id="submit-comment"
              style="background-color:black; border: black;">送出</button>
            <div id="comments-list"></div>
          </div>
        </div>
      </div>

      <!-- 右邊：社團資料 + 頭像 -->
      <div class="col-lg-3">
        <div class="card p-3" style="">
          <img src="uploads/<?= $row['profile_img'] ?? 'default-profile.png' ?>" alt="頭像" class="rounded-circle mb-3"
            style="width: 100px; height: 100px; object-fit: cover; align-items: center;">

          <p style="font-size: 16px; text-align: left;"><strong>學校名稱：</strong><?= $row['school'] ?></p>
          <p style="font-size: 16px; text-align: left;"><strong>社團名稱：</strong><?= $row['club'] ?></p>
          <p style="font-size: 16px; text-align: left;"><strong>社團人數：</strong><?= $row['clsize'] ?></p>
          <p style="font-size: 16px; text-align: left;"><strong>成立年份：</strong><?= $row['clyear'] ?></p>
          <p style="font-size: 16px; text-align: left;"><strong>社團類型：</strong><?= $row['cltype'] ?></p>
          <p style="font-size: 16px; text-align: left;"><strong>社群連結：</strong><a href="<?= $row['clins'] ?>"
              target="_blank"><?= $row['clins'] ?></a></p>
          <p style="font-size: 16px; text-align: left;"><strong>聯絡電話：</strong><?= $row['clphone'] ?></p>

        </div>
        <div>

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

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>
</body>

</html>