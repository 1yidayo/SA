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
                                <li><a href="index_cl.php">首頁</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="index_en.php" class="active">首頁</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="browse_cl.php">瀏覽</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="browse_en.php" class="active">瀏覽</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="post_cl.php">發布</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="post_en.php" class="active">發布</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="post.history_cl.php" class="active">發布歷史</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="post.history_en.php" class="active">發布歷史</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="cooperations_cl.php">我的合作</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="cooperations_en.php" class="active">我的合作</a></li>
                            <?php endif; ?>
                            <?php if ($_SESSION['level'] === 'cl'): ?>
                                <li><a href="self_cl.php">個人頁面</a></li>
                            <?php elseif ($_SESSION['level'] === 'en'): ?>
                                <li><a href="self_en.php" class="active">個人頁面</a></li>
                            <?php endif; ?>
                            <li><a href="logout.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登出</a></li>
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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $num = intval($_POST['clrequirement_num']);

        $sql_old = "SELECT * FROM club_requirements WHERE clrequirement_num = $num AND identityID = '{$_SESSION['identityID']}'";
        $result_old = mysqli_query($link, $sql_old);
        $old = mysqli_fetch_assoc($result_old);

        if (!$old) {
            header("Location: post.history_cl.php");
            exit();
        }

        $title = $_POST['title'] ?? $old['title'];
        $money = $_POST['money'] ?? $old['money'];
        $people = $_POST['people'] ?? $old['people'];
        $type = $_POST['type'] ?? $old['type'];
        $region = $_POST['region'] ?? $old['region'];
        $event_time = $_POST['event_time'] ?? $old['event_time'];
        $information = $_POST['information'] ?? $old['information'];

        $title = mysqli_real_escape_string($link, $title);
        $money = mysqli_real_escape_string($link, $money);
        $people = mysqli_real_escape_string($link, $people);
        $type = mysqli_real_escape_string($link, $type);
        $region = mysqli_real_escape_string($link, $region);
        $event_time = mysqli_real_escape_string($link, $event_time);
        $information = mysqli_real_escape_string($link, $information);

        $sql = "UPDATE club_requirements SET 
                title = '$title',
                money = '$money',
                people = '$people',
                type = '$type',
                region = '$region',
                event_time = '$event_time',
                information = '$information'
            WHERE clrequirement_num = $num AND identityID = '{$_SESSION['identityID']}'";

        mysqli_query($link, $sql);
        header("Location: post.history_cl.php");
        exit();
    } else if (isset($_GET['clrequirement_num'])) {
        $num = intval($_GET['clrequirement_num']);
        $sql = "SELECT * FROM club_requirements WHERE clrequirement_num = $num AND identityID = '{$_SESSION['identityID']}'";
        $result = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($result);
        if (!$row) {
            header("Location: post.history_cl.php");
            exit();
        }
    } else {
        header("Location: post.history_cl.php");
        exit();
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
            <h3>編輯贊助需求</h3>
            <form method="POST" action="history.edit_cl.php">
                <input type="hidden" name="clrequirement_num" value="<?= $row['clrequirement_num'] ?>">

                <div class="mb-3">
                    <label class="form-label">標題</label>
                    <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($row['title']) ?>"
                        required>
                </div>

                <div class="mb-3" id="money-group" style="<?= $row['type'] === '金錢' ? '' : 'display: none;' ?>">
                    <label class="form-label">贊助金額</label>
                    <input type="number" class="form-control" name="money"
                        value="<?= htmlspecialchars($row['money']) ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">預估規模</label>
                    <select class="form-control" name="people">
                        <option value="">請選擇</option>
                        <option value="0-10人" <?= $row['people'] == '0-10人' ? 'selected' : '' ?>>0-10人</option>
                        <option value="11-20人" <?= $row['people'] == '11-20人' ? 'selected' : '' ?>>11-20人</option>
                        <option value="21-30人" <?= $row['people'] == '21-30人' ? 'selected' : '' ?>>21-30人</option>
                        <option value="31-40人" <?= $row['people'] == '31-40人' ? 'selected' : '' ?>>31-40人</option>
                        <option value="41-50人" <?= $row['people'] == '41-50人' ? 'selected' : '' ?>>41-50人</option>
                        <option value="50人以上" <?= $row['people'] == '50人以上' ? 'selected' : '' ?>>50人以上</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">贊助類型</label>
                    <select class="form-select" name="type" id="type" required>
                        <option value="金錢" <?= $row['type'] == '金錢' ? 'selected' : '' ?>>金錢</option>
                        <option value="人力" <?= $row['type'] == '人力' ? 'selected' : '' ?>>人力</option>
                        <option value="其他" <?= $row['type'] == '其他' ? 'selected' : '' ?>>其他</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">內文 (必填)</label>
                    <textarea class="form-control" name="information"
                        required><?= htmlspecialchars($row['information']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">預計活動月份</label>
                    <input type="date" name="event_time" class="form-control"
                        value="<?= htmlspecialchars($row['event_time']) ?>" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">活動地區</label>
                    <select class="form-select" name="region" required>
                        <option value="">請選擇</option>
                        <option value="北部" <?= $row['region'] == '北部' ? 'selected' : '' ?>>北部</option>
                        <option value="中部" <?= $row['region'] == '中部' ? 'selected' : '' ?>>中部</option>
                        <option value="南部" <?= $row['region'] == '南部' ? 'selected' : '' ?>>南部</option>
                        <option value="東部" <?= $row['region'] == '東部' ? 'selected' : '' ?>>東部</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">更新</button>
                <a href="post.history_cl.php" class="btn btn-secondary">取消</a>
            </form>
        </div>

        <script>
            document.getElementById('type').addEventListener('change', function () {
                const moneyGroup = document.getElementById('money-group');
                moneyGroup.style.display = this.value === '金錢' ? 'block' : 'none';
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