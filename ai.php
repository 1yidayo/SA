<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <title>社團企業媒合平台</title>

  <!-- CSS -->
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
              <li><a href="properties3.php">瀏覽</a></li>
                            <li><a href="alumni contact.php"  class="active">發布</a></li>
                            <li><a href="aihistory.php">發布歷史</a></li>
                            <li><a href="self.ai.php">個人頁面</a></li>
                            <li><a href="login.html">登出</a></li>
                            <li><a href="advanced search for ai.html"><i class="fa fa-calendar"></i>進階搜尋</a>
                            </li>
            </ul>
            <a class="menu-trigger"><span>Menu</span></a>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <!-- Page Heading -->
  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <h3>贊助需求詳情</h3>
        </div>
      </div>
    </div>
  </div>

  <div class="section">
    <div class="container">
      <div class="row">
        <?php
        $airequirement_num = $_GET['airequirement_num'];
        $link = mysqli_connect('localhost', 'root', '', 'SAS');
        $sql = "SELECT ar.*, i.ainame, i.ainins, i.profile_img 
        FROM ai_requirements ar
        LEFT JOIN identity i ON ar.identityID = i.identityID
        WHERE ar.airequirement_num = '$airequirement_num'";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row) {
          echo "<div class='col-lg-8'>
          <div class='main-content mb-4'>
            <div class='d-flex justify-content-between align-items-center mb-2'>
              <h2 class='mb-0' style='font-size: 40px;'>" . htmlspecialchars($row['title']) . "&nbsp;</h2>
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

        <div class="row">
          <!-- Left Side: Title & Description -->
          <div class="col-lg-3">
  <div class="card shadow-sm p-3 mb-4 bg-white rounded">
    <h5 class="mb-3" style="font-size: 25px;">校友資訊</h5>
    <ul class="list-unstyled">
      <div class='mb-3' style="font-size: 18px;">
        <label class='form-label text-muted'>校友姓名：</label>
        <b><?= htmlspecialchars($row['ainame'] ?? '未填寫') ?></b>
      </div>
      <div class='mb-3' style="font-size: 18px;">
        <label class='form-label text-muted'>校友聯絡資訊：</label>
        <b><?= htmlspecialchars($row['ainins'] ?? '未填寫') ?></b>
      </div>
    </ul>
  </div>
</div>

          <!-- 貼文標題與活動詳情 -->
          <div class="col-lg-6">
            <div class="main-content">
              <div class="card shadow-sm p-3 mb-4 bg-white rounded">
                <div>
                  <h5 class="mb-3" style="font-size: 25px;">公司簡介及實習職位說明：</h5>
                  <p class="card-text" style="font-size: 18px;"><?= nl2br(htmlspecialchars($row['information'])) ?></p>
                </div>
              </div>

              <!-- 留言區 -->
              <div class="card shadow-sm mb-4 bg-white rounded" id="comment-section" style="padding: 16px;">
                <h5 class="mb-3" style="font-size: 25px;">留言區</h5>
                <!-- <div class="d-flex mb-4"> -->
                <div class="flex-grow-1 text-end">
                  <textarea id="comment-text" class="form-control mb-2" rows="2" placeholder="留下你的留言..."
                    style="resize: none;"></textarea>
                  <button class="btn btn-primary btn-sm" id="submit-comment"
                    style="background-color: black; border: black; ">送出</button>
                </div>
                <!-- </div> -->
                <div id="comments-list"></div>
              </div>
            </div>
          </div>

          <!-- 右發文者資訊與編輯按鈕 -->
          <?php
          $airequirement_num = $_GET['airequirement_num'];
          $link = mysqli_connect('localhost', 'root', '', 'SAS');

          // 使用 LEFT JOIN 來聯結資料表 確保 profile_img 被選取
          $sql = "SELECT ai_requirements.*, identity.profile_img 
        FROM ai_requirements 
        LEFT JOIN identity ON ai_requirements.identityID = identity.identityID 
        WHERE airequirement_num = '$airequirement_num'";

          $result = mysqli_query($link, $sql);
          $row = mysqli_fetch_assoc($result);
          $userID = $row['identityID'] ?? null;

          if ($userID) {
            $sql_identity = "SELECT * FROM identity WHERE identityID = '$userID'";
            $result_identity = mysqli_query($link, $sql_identity);
            $identity_row = mysqli_fetch_assoc($result_identity);
          }

          if ($row) {
            // 確認是否有 profile_img 若無則使用預設圖片
            $avatar = isset($row['profile_img']) && $row['profile_img'] ? $row['profile_img'] : 'default-profile.png';
            $sql = "SELECT * FROM identity WHERE userID = '$userID'";
            $result = mysqli_query($link, $sql);
            $row = mysqli_fetch_assoc($result);
            // 顯示發文者頭像
            echo "<div class='col-lg-3'>
            
            <div class='card shadow-sm p-3 mb-4 bg-white rounded'>
            <div class='text-center' style='align-items:center;'>
              <br><img src='uploads/{$avatar}' alt='發文者頭像' class='rounded-circle mb-3' style='width: 100px; height: 100px; object-fit: cover;'>

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
      const enrequirement_num = <?= json_encode($enrequirement_num) ?>;

      function loadComments() {
        fetch('fetch_comments.php?enrequirement_num=' + enrequirement_num)
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
          body: 'enrequirement_num=' + encodeURIComponent(enrequirement_num) + '&content=' + encodeURIComponent(content)
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
