<?php
session_start();
?>

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
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="index_cl.php" class="active">首頁</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="index_en.php">首頁</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="browse_cl.php" class="active">瀏覽</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="browse_en.php">瀏覽</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="post_cl.php" class="active">發布</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="post_en.php">發布</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="post.history_cl.php" class="active">發布歷史</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="post.history_en.php" class="active">發布歷史</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="cooperations_cl.php" class="active">我的合作</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="cooperations_en.php">我的合作</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="self_cl.php" class="active">個人頁面</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="self_en.php">個人頁面</a></li>
                            <?php endif; ?>
                            <li><a href="logout.php">登出</a></li>
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
          <h3>修改發布歷史</h3>
        </div>
      </div>
    </div>
  </div>
  <?php
  $link = mysqli_connect('localhost', 'root', '', 'SAS');
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}
if (!isset($_SESSION['identityID'])) {
    header("Location: first.html");
    exit();
}

$data = null;

// 若為 GET 取得要編輯的資料
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['enrequirement_num'])) {
    $requirement_num = intval($_GET['enrequirement_num']);
    $sql = "SELECT * FROM en_requirements WHERE enrequirement_num = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("i", $requirement_num);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
}

// 若為 POST 提交編輯表單
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
    $intern_number = $_POST["intern_number"];
    $others = $_POST["others"];

    $update_sql = "UPDATE en_requirements
                   SET enterprise=?, type=?, code=?, ins=?, region=?, date=?, sponsorship=?, money=?, hope=?, title=?, information=?, intern_number=?, others=?
                   WHERE enrequirement_num=?";
    
    $stmt = $link->prepare($update_sql);
    $stmt->bind_param("ssssssssssssssi", $enterprise, $type, $code, $ins, $region, $date, $sponsorship, $money, $hope, $title, $information, $intern_number, $others, $requirement_num);

    if ($stmt->execute()) {
        echo "<script>alert('修改成功'); window.location.href='post.history_en.php';</script>";
        exit();
    } else {
        echo "修改失敗：" . $stmt->error;
    }
}

?>
<!DOCTYPE html>
    <html lang="zh-TW">

    <head>
        <meta charset="UTF-8">
        <title>編輯贊助需求</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="assets/css/fontawesome.css">
        <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
        <style>
            .edit-form-container {
                max-width: 700px;
                margin: 50px auto;
                background-color: #f9f9f9;
                padding: 30px;
                border-radius: 12px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            .edit-form-container h3 {
                color: #f39c12;
                font-weight: 700;
                margin-bottom: 30px;
            }

            .edit-form-container label {
                font-weight: 600;
                font-size: 15px;
            }

            .edit-form-container input,
            .edit-form-container select,
            .edit-form-container textarea {
                font-size: 15px;
                padding: 8px 12px;
                border-radius: 8px;
                border: 1px solid #ccc;
                transition: border-color 0.3s;
            }

            .edit-form-container input:focus,
            .edit-form-container select:focus,
            .edit-form-container textarea:focus {
                border-color: #f39c12;
                outline: none;
                box-shadow: 0 0 0 2px rgba(243, 156, 18, 0.2);
            }

            .edit-form-container button {
                margin-right: 10px;
            }
        </style>
    </head>

    <body>

        <div class="container edit-form-container">
            <h3>修改贊助內容</h3>
            <form method="POST" action="history.edit_en.php">
                <input type="hidden" name="enrequirement_num" value="<?= $data['enrequirement_num'] ?>">
                <input type="hidden" name="enterprise" value="<?= $data['enterprise'] ?>">
                <input type="hidden" name="type" value="<?= $data['type'] ?>">
                <input type="hidden" name="code" value="<?= $data['code'] ?>">

                <div class="mb-3">
                            <label class="form-label fw-bold">聯絡資訊：</label>
                            <input type="text" class="form-control" name="ins"
                                value="<?php echo htmlspecialchars($data["ins"]); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">贊助日期：</label>
                            <input type="date" class="form-control" name="date"
                                value="<?php echo htmlspecialchars($data["date"]); ?>" required>
                        </div>

                        <div class="mb-3">
                    <label class="form-label">贊助類型</label>
                    <select class="form-select" name="sponsorship" id="sponsorship" required>
                        <option value="金錢" <?= $data['sponsorship'] == '金錢' ? 'selected' : '' ?>>金錢</option>
                        <option value="物資" <?= $data['sponsorship'] == '物資' ? 'selected' : '' ?>>物資</option>
                        <option value="場地" <?= $data['sponsorship'] == '場地' ? 'selected' : '' ?>>場地</option>
                        <option value="提供實習" <?= $data['sponsorship'] == '提供實習' ? 'selected' : '' ?>>提供實習</option>
                        <option value="其他" <?= $data['sponsorship'] == '其他' ? 'selected' : '' ?>>其他</option>
                    </select>
                </div>

                        <div class="mb-3" id="money-group" style="<?= $data['sponsorship'] === '金錢' ? '' : 'display: none;' ?>">
                    <label class="form-label">贊助範圍</label>
                    <select name="money" class="form-select" id="money">
                    <option value="">請選擇</option>
                    <option value="$20,000以下" <?= $data['money'] == '$20,000以下' ? 'selected' : '' ?>>$20,000以下</option>
                    <option value="$20,001-$30,000" <?= $data['money'] == '$20,001-$30,000' ? 'selected' : '' ?>>$20,001-$30,000</option>
                    <option value="$30,001-$50,000" <?= $data['money'] == '$30,001-$50,000' ? 'selected' : '' ?>>$30,001-$50,000</option>
                    <option value="$50,001-$70,000" <?= $data['money'] == '$50,001-$70,000' ? 'selected' : '' ?>>$50,001-$70,000</option>
                    <option value="$70,001以上" <?= $data['money'] == '$70,001以上' ? 'selected' : '' ?>>$70,001以上</option>

                    </select>
                </div>
                <div class="col-12" id="intern-group" style="display:none;">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>預估提供的實習人數(必填)</b></span>
                  </div>
                  <input type="number" class="form-control" name="intern_number" id="intern_number"
                        placeholder="請輸入實習人數" min="1" title="必填欄位！"
                        value="<?= htmlspecialchars($data['intern_number']) ?>"> 
                </div>
                <div class="col-12" id="others-group" style="display:none;">
                  <div class="d-flex align-items-center bg-light text-body rounded-start p-2">
                    <span class="ms-1"><b>概述(必填)</b></span>
                  </div>
                  <input type="text" class="form-control" name="others" id="others"
                        placeholder="請概述可提供的贊助" title="必填欄位！"
                        value="<?= htmlspecialchars($data['others']) ?>">
                </div>


                        <div id="region-field" class="mb-3">
                            <label class="form-label fw-bold">贊助地區</label>
                            <select class="form-control" name="region">
                            <?php echo htmlspecialchars($data["region"]); ?>
                                <option value="北部" <?php if ($data["region"] == "北部")
                                    echo "selected"; ?>>北部
                                </option>
                                <option value="中部" <?php if ($data["region"] == "中部")
                                    echo "selected"; ?>>中部</option>
                                <option value="南部" <?php if ($data["region"] == "南部")
                                    echo "selected"; ?>>南部</option>
                                <option value="東部" <?php if ($data["region"] == "東部")
                                    echo "selected"; ?>>
                                    東部</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">希望社團達到目的：</label>
                            <select class="form-control" name="hope" required>
                            <?php echo htmlspecialchars($data["hope"]); ?>
                                <option value="宣傳" <?php if ($data["hope"] == "宣傳")
                                    echo "selected"; ?>>宣傳</option>
                                <option value="表演" <?php if ($data["hope"] == "表演")
                                    echo "selected"; ?>>表演</option>
                                <option value="了解本企業職務" <?php if ($data["hope"] == "了解本企業職務")
                                    echo "selected"; ?>>了解本企業職務</option>
                            </select>
                        </div>


                

                <div class="mb-3">
                    <label class="form-label">內文標題</label>
                    <input type="text" class="form-control" name="title"
                    value="<?php echo htmlspecialchars($data["title"]); ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">內文 (必填)</label>
                    <textarea class="form-control" name="information"
                        required><?= htmlspecialchars($data['information']) ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">更新</button>
                <a href="post.history_en.php" class="btn btn-secondary">取消</a>
            </form>
        </div>

        <<script>
    document.addEventListener('DOMContentLoaded', function () {
    const sponsorship = document.getElementById('sponsorship');
    const moneyGroup = document.getElementById('money-group');
    const internGroup = document.getElementById('intern-group');
    const othersGroup = document.getElementById('others-group');

    function toggleFields() {
        const value = sponsorship.value;
        moneyGroup.style.display = value === '金錢' ? 'block' : 'none';
        internGroup.style.display = value === '提供實習' ? 'block' : 'none';
        othersGroup.style.display = value === '其他' ? 'block' : 'none';

        // 清空不顯示的欄位
        if (value !== '金錢') document.getElementById('money').value = '';
        if (value !== '提供實習') document.getElementById('intern_number').value = '';
        if (value !== '其他') document.getElementById('others').value = '';
    }

    sponsorship.addEventListener('change', toggleFields);

    // 初次載入時觸發
    toggleFields();
});
</script>



    </body>

    </html>



    <!-- Footer -->
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