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

  <!-- Preloader -->
  <div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
      <span class="dot"></span>
      <div class="dots"><span></span><span></span><span></span></div>
    </div>
  </div>

  <!-- Header -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
            <ul class="nav">
              <li><a href="de.html" class="active">首頁</a></li>
              <li><a href="properties4.php">瀏覽</a></li>
              <li><a href="de_contact.php">發布</a></li>
              <li><a href="dehistory.php">發布歷史</a></li>
              <li><a href="self.de.php">個人頁面</a></li>
              <li><a href="login.html">登出</a></li>
              <li><a href="aftersearchforde.php"><i class="fa fa-calendar"></i>進階搜尋</a></li>
            </ul>
            <a class='menu-trigger'><span>Menu</span></a>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <!-- 頁面標題 -->
  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h3>系學會活動詳情</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- 主內容區塊 -->
  <div class="section">
    <div class="container">
      <div class="row">
        <?php
        $derequirement_num = $_GET['derequirement_num'];
        $link = mysqli_connect('localhost', 'root', '', 'SAS');
        $sql = "SELECT * FROM de_requirements WHERE derequirement_num = '$derequirement_num'";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
          echo "<div class='col-lg-8'>
  <div class='main-content mb-4'>
    <div class='d-flex justify-content-between align-items-center mb-2'>
      <h2 class='mb-0' style='font-size: 40px;'>" . htmlspecialchars(string: $row['title']) . "&nbsp;<button class='btn btn-outline-secondary mb-2'>Edit Post</button></h2>
      
    </div>
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

        <!-- 左側資訊 -->
        <div class="row">
          <div class="col-lg-3">
            <div class="card shadow-sm p-3 mb-4 bg-white rounded">
              <h5 class="mb-3" style="font-size: 25px;">活動詳情</h5>
              <ul class="list-unstyled">
                <div class='mb-3' style="font-size: 18px;"><label
                    class='form-label text-muted'>贊助類型：</label><b><?= htmlspecialchars($row['support_type']) ?></b>
                </div>
                <?php if ($row['support_type'] === '金錢'): ?>
                  <div class='mb-3' style="font-size: 18px;"><label
                      class='form-label text-muted'>贊助範圍：</label><b><?= htmlspecialchars($row['money'] ?? '未填寫') ?></b>
                  </div>
                <?php endif; ?>
                <div class='mb-3' style="font-size: 18px;"><label
                    class='form-label text-muted'>活動預計規模：</label><b><?= htmlspecialchars($row['people']) ?></b></div>
                <div class='mb-3' style="font-size: 18px;"><label class='form-label text-muted'>企劃書內容：</label><b><a
                      href="<?= htmlspecialchars($row['upload']) ?>" download>下載企劃書</a></b></div>
              </ul>
            </div>
          </div>

          <!-- 中間主要內容 -->
          <div class="col-lg-6">
            <div class="main-content">
              <div class="card shadow-sm p-3 mb-4 bg-white rounded">
                <div>
                  <h5 class="mb-3" style="font-size: 25px;">活動詳情內文：</h5>
                  <p style="font-size: 18px;"><?= nl2br(htmlspecialchars($row['information'])) ?></p>
                </div>


              </div>

              <!-- 留言區 -->
              <div class="card shadow-sm mb-4 bg-white rounded p-3" id="comment-section">
                <h5 class="mb-3" style="font-size: 25px;">留言區</h5>
                <div class="flex-grow-1 text-end">
                  <textarea id="comment-text" class="form-control mb-2" rows="2" placeholder="留下你的留言..."
                    style="resize: none;"></textarea>
                  <button class="btn btn-primary btn-sm" id="submit-comment"
                    style="background-color: black; border: black;">送出</button>
                </div>
                <div id="comments-list"></div>
              </div>
            </div>
          </div>
          <!-- 右側發文者資訊
<div class="col-lg-3">
  <div class="card shadow-sm p-3 mb-4 bg-white rounded">
    <div class="text-center">
      <br>
      <img src="uploads/<?= htmlspecialchars($row['profile_img'] ?? 'default-profile.png') ?>" alt="發文者頭像" class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover;">
    </div>
    <div>
      <div class='mb-3'><label class='form-label text-muted'>學校名稱：</label><b><?= htmlspecialchars($row['deschool']) ?></b></div>
      <div class='mb-3'><label class='form-label text-muted'></label><b><?= htmlspecialchars($row['dename']) ?></b></div>
      <div class='mb-3'><label class='form-label text-muted'>社團成員人數：</label><b><?= htmlspecialchars($row['desize']) ?></b></div>
      <div class='mb-3'><label class='form-label text-muted'>社團成立年分：</label><b><?= htmlspecialchars($row['deyear']) ?></b></div>
      <div class='mb-3'><label class='form-label text-muted'>粉專或社群連結：</label><b><a href="<?= htmlspecialchars($row['deins']) ?>" target="_blank"><?= htmlspecialchars($row['deins']) ?></a></b></div>
      <div class='mb-3'><label class='form-label text-muted'>聯絡人電話：</label><b><?= htmlspecialchars($row['dephone']) ?></b></div>
    </div>
  </div>
</div> -->

          <!-- 右側：發文者資訊與編輯按鈕 -->
          <?php
$derequirement_num = $_GET['derequirement_num'];
$link = mysqli_connect('localhost', 'root', '', 'SAS');

// 使用 LEFT JOIN 來聯結資料表，確保 profile_img 被選取
$sql = "SELECT 
            de_requirements.*, 
            identity.profile_img, 
            identity.identityID,
            identity.deschool,
            identity.dename,
            identity.desize,
            identity.deyear,
            identity.deins,
            identity.dephone
        FROM de_requirements 
        LEFT JOIN identity ON de_requirements.identityID = identity.identityID 
        WHERE derequirement_num = '$derequirement_num'";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);

if ($row) {
    $userID = $row['identityID'] ?? null;
    $avatar = isset($row['profile_img']) && $row['profile_img'] ? $row['profile_img'] : 'default-profile.png';
    ?>

    <div class='col-lg-3'>
      <div class='card shadow-sm p-3 mb-4 bg-white rounded'>
        <div class='text-center' style='align-items:center;'>
          <br>
          <img src='uploads/<?php echo $avatar; ?>' alt='發文者頭像' class='rounded-circle mb-3' style='width: 100px; height: 100px; object-fit: cover;'>
        </div>

        <div>
          <div class='mb-3' style='font-size: 18px;'>
            <label class='form-label text-muted'>學校名稱：</label>
            <b><?php echo isset($row['deschool']) ? $row['deschool'] : '未提供'; ?></b>
          </div>

          <div class='mb-3' style='font-size: 18px;'>
            <label class='form-label text-muted'>系學名稱：</label>
            <b><?php echo isset($row['dename']) ? $row['dename'] : '未提供'; ?></b>
          </div>

          <div class='mb-3' style='font-size: 18px;'>
            <label class='form-label text-muted'>系學成員人數：</label>
            <b><?php echo isset($row['desize']) ? $row['desize'] : '未提供'; ?></b>
          </div>

          <div class='mb-3' style='font-size: 18px;'>
            <label class='form-label text-muted'>系學成立年分：</label>
            <b><?php echo isset($row['deyear']) ? $row['deyear'] : '未提供'; ?></b>
          </div>

          <div class='mb-3' style='font-size: 18px;'>
            <label class='form-label text-muted'>粉專或社群連結：</label>
            <b>
              <?php if (!empty($row['deins'])): ?>
                <a class='fs-5' href='<?php echo $row['deins']; ?>' target='_blank'><?php echo $row['deins']; ?></a>
              <?php else: ?>
                未提供
              <?php endif; ?>
            </b>
          </div>

          <div class='mb-3' style='font-size: 18px;'>
            <label class='form-label text-muted'>聯絡人電話：</label>
            <b><?php echo isset($row['dephone']) ? $row['dephone'] : '未提供'; ?></b>
          </div>
        </div>
      </div>
    </div>

<?php
} else {
    echo "
    <div class='col-lg-8'>
      <div class='main-content'>
        <h2 class='mb-3'>找不到資料</h2>
      </div>
    </div>";
}
?>


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
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const submitBtn = document.getElementById('submit-comment');
      const commentText = document.getElementById('comment-text');
      const commentsList = document.getElementById('comments-list');
      const derequirement_num = <?= json_encode($derequirement_num) ?>;

      function loadComments() {
        fetch('fetch_comments.php?derequirement_num=' + derequirement_num)
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
          body: 'derequirement_num=' + encodeURIComponent(derequirement_num) + '&content=' + encodeURIComponent(content)
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