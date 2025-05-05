<?php
session_start();
?>
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
      display: flex;
      flex-wrap: wrap; /* 允許換行 */
      gap: 10px; /* 設定間距 */
      justify-content: flex-start; /* 讓內容從左到右排列 */
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

      /* 確保每個歷史紀錄框高度一致 */
      .uniform-box {
          min-height: 430px; /* 根據內容調整，讓每筆高度一致 */
          display: flex;
          flex-direction: column;
          justify-content: space-between;
      }

      /* 讓修改/刪除連結整齊排列 */
      .text-links {
          margin-top: 10px;
          text-align: right;
          font-size: 14px;
      }

      .text-links a {
          text-decoration: none;
          color: #333;
          margin: 0 5px;
      }

      .text-links a:hover {
          text-decoration: underline;
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
                    <!-- ***** Menu End ***** -->
                </nav>
            </div>
        </div>
    </div>
  </header>
  <!-- ***** Header Area End ***** -->
<?php


$link = mysqli_connect('localhost', 'root', '', 'SAS');
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
if (!isset($_SESSION['identityID'])) {
    header("Location: first.html");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num = intval($_POST['enquirement_num']);

    $sql = "SELECT * FROM en_requirements WHERE enrequirement_num = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $requirement_num);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $requirement_num = $_POST["enrequirement_num"];
    $enterprise = $_POST["enterprise"];
    $type = $_POST["type"];
    $code = $_POST["code"];
    $ins = $_POST["ins"];
    $region = $_POST["region"];
    $date = $_POST["date"];
    $sponsorship = $_POST["sponsorship"];
    $money = $_POST["money"];
    $hope = $_POST["hope"];
    $title = $_POST["title"];
    $information = $_POST["information"];

    $update_sql = "UPDATE en_requirements 
                   SET enterprise=?, type=?, code=?, ins=?, region=?, date=?, sponsorship=?, money=?, hope=?, title=?, information=? 
                   WHERE enrequirement_num=?";
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("sssssssssssi", $enterprise, $type, $code, $ins, $region, $date, $sponsorship, $money, $hope, $title, $information, $requirement_num);

    if ($stmt->execute()) {
        echo "<script>alert('修改成功'); window.location.href='enhistory.php';</script>";
        exit();
    } else {
        echo "修改失敗：" . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>修改贊助內容</title>
    <script>
    function toggleBudgetField() {
        const sponsorship = document.querySelector('select[name="sponsorship"]').value;
        const moneyField = document.getElementById('money-field');
        if (sponsorship === '金錢') {
            moneyField.style.display = 'block';
        } else {
            moneyField.style.display = 'none';
        }
    }

    window.onload = function () {
        toggleBudgetField(); // 預設載入時執行一次
        document.querySelector('select[name="sponsorship"]').addEventListener('change', toggleBudgetField);
    };
    </script>
</head>
<body>
<h2>修改贊助內容</h2>

<?php if (isset($data)) { ?>
<form method="POST">
    <input type="hidden" name="enrequirement_num" value="<?php echo htmlspecialchars($data["enrequirement_num"]); ?>">
    <label>企業名稱：<input type="text" name="enterprise" value="<?php echo htmlspecialchars($data["enterprise"]); ?>" required></label><br>
    <label>產業類型：<input type="text" name="type" value="<?php echo htmlspecialchars($data["type"]); ?>" required></label><br>
    <label>統一編號：<input type="text" name="code" value="<?php echo htmlspecialchars($data["code"]); ?>" required></label><br>
    <label>聯絡人：<input type="text" name="ins" value="<?php echo htmlspecialchars($data["ins"]); ?>" required></label><br>
    <label>地區：<input type="text" name="region" value="<?php echo htmlspecialchars($data["region"]); ?>" required></label><br>
    <label>贊助日期：<input type="date" name="date" value="<?php echo htmlspecialchars($data["date"]); ?>" required></label><br>

    <label>贊助種類：
        <select name="sponsorship" required>
            <option value="金錢" <?php if($data["sponsorship"] == "金錢") echo "selected"; ?>>金錢</option>
            <option value="物資" <?php if($data["sponsorship"] == "物資") echo "selected"; ?>>物資</option>
            <option value="其他" <?php if($data["sponsorship"] == "其他") echo "selected"; ?>>其他</option>
        </select>
    </label><br>

    <div id="money-field">
        <label>預算區間：
            <select name="money">
                <option value="5,000元以下" <?php if($data["money"] == "5,000元以下") echo "selected"; ?>>5,000元以下</option>
                <option value="5,000元~10,000元" <?php if($data["money"] == "5,000元~10,000元") echo "selected"; ?>>5,000元~10,000元</option>
                <option value="10,000元~30,000元" <?php if($data["money"] == "10,000元~30,000元") echo "selected"; ?>>10,000元~30,000元</option>
                <option value="30,000元以上" <?php if($data["money"] == "30,000元以上") echo "selected"; ?>>30,000元以上</option>
            </select>
        </label><br>
    </div>

    <label>期望內容：<input type="text" name="hope" value="<?php echo htmlspecialchars($data["hope"]); ?>" required></label><br>
    <label>標題：<input type="text" name="title" value="<?php echo htmlspecialchars($data["title"]); ?>" required></label><br>
    <label>內容說明：<textarea name="information" required><?php echo htmlspecialchars($data["information"]); ?></textarea></label><br>
    <button type="submit">修改</button>
</form>
<?php } else { ?>
<p>無此資料</p>
<?php } ?>

</body>
</html>




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