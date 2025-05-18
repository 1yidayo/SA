<?php
session_start();
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

    $update_sql = "UPDATE en_requirements 
                   SET enterprise=?, type=?, code=?, ins=?, region=?, date=?, sponsorship=?, money=?, hope=?, title=?, information=? 
                   WHERE enrequirement_num=?";
    $stmt = $link->prepare($update_sql);
    $stmt->bind_param("sssssssssssi", $enterprise, $type, $code, $ins, $region, $date, $sponsorship, $money, $hope, $title, $information, $requirement_num);

    if ($stmt->execute()) {
        echo "<script>alert('修改成功'); window.location.href='post.history_en.php';</script>";
        exit();
    } else {
        echo "修改失敗：" . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>修改贊助內容</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
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
            toggleBudgetField();
            document.querySelector('select[name="sponsorship"]').addEventListener('change', toggleBudgetField);
        };
    </script>
</head>
<!-- 替換原本 HTML <body> 以下的部分即可 -->
<style>
    .text-orange {
        color: #fd7e14;
    }
</style>

<body style="background-color: #f8f9fa;">
    <div class="container mt-5 d-flex justify-content-center">
        <div class="card shadow-lg" style="width: 100%; max-width: 720px;">
            <div class="card-header text-center text-orange bg-white border-bottom-0">
                <h4 class="fw-bold">修改贊助內容</h4>
            </div>
            <div class="card-body">
                <?php if ($data) { ?>
                    <form method="POST">
                        <input type="hidden" name="enrequirement_num"
                            value="<?php echo htmlspecialchars($data["enrequirement_num"]); ?>">

                        <div class="mb-3">
                            <label class="form-label fw-bold">企業名稱：</label>
                            <input type="text" class="form-control" name="enterprise"
                                value="<?php echo htmlspecialchars($data["enterprise"]); ?>"readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">行業別：</label>
                            <input type="text" class="form-control" name="type"
                                value="<?php echo htmlspecialchars($data["type"]); ?>"readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">統一編號：</label>
                            <input type="text" class="form-control" name="code"
                                value="<?php echo htmlspecialchars($data["code"]); ?>"readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">負責人姓名：</label>
                            <input type="text" class="form-control" name="ins"
                                value="<?php echo htmlspecialchars($data["ins"]); ?>" required>
                        </div>
          
    

                        <div class="mb-3">
                            <label class="form-label fw-bold">贊助日期：</label>
                            <input type="date" class="form-control" name="date"
                                value="<?php echo htmlspecialchars($data["date"]); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">贊助類型：</label>
                            <select class="form-control" name="sponsorship" required>
                            required><?php echo htmlspecialchars($data["sponsorship"]); ?>
                                <option value="金錢" <?php if ($data["sponsorship"] == "金錢")
                                    echo "selected"; ?>>金錢</option>
                                <option value="物資" <?php if ($data["sponsorship"] == "物資")
                                    echo "selected"; ?>>物資</option>
                                <option value="場地" <?php if ($data["sponsorship"] == "場地")
                                    echo "selected"; ?>>金錢</option>
                                <option value="提供實習" <?php if ($data["sponsorship"] == "提供實習")
                                    echo "selected"; ?>>物資</option>
                            </select>
                        </div>

                        <div id="money-field" class="mb-3">
                            <label class="form-label fw-bold">預算區間：</label>
                            <select class="form-control" name="money">
                            required><?php echo htmlspecialchars($data["money"]); ?>
                                <option value="5,000元以下" <?php if ($data["money"] == "5,000元以下")
                                    echo "selected"; ?>>5,000元以下
                                </option>
                                <option value="5,000元~10,000元" <?php if ($data["money"] == "5,000元~10,000元")
                                    echo "selected"; ?>>5,000元~10,000元</option>
                                <option value="10,000元~30,000元" <?php if ($data["money"] == "10,000元~30,000元")
                                    echo "selected"; ?>>10,000元~30,000元</option>
                                <option value="30,000元以上" <?php if ($data["money"] == "30,000元以上")
                                    echo "selected"; ?>>
                                    30,000元以上</option>
                            </select>
                        </div>

                        <div id="region-field" class="mb-3">
                            <label class="form-label fw-bold">贊助地區</label>
                            <select class="form-control" name="region">
                            required><?php echo htmlspecialchars($data["region"]); ?>
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
                            required><?php echo htmlspecialchars($data["hope"]); ?>
                                <option value="宣傳" <?php if ($data["hope"] == "宣傳")
                                    echo "selected"; ?>>宣傳</option>
                                <option value="表演" <?php if ($data["hope"] == "表演")
                                    echo "selected"; ?>>表演</option>
                                <option value="其他" <?php if ($data["hope"] == "了解本企業職務")
                                    echo "selected"; ?>>了解本企業職務</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">標題：</label>
                            <input type="text" class="form-control" name="title"
                                value="<?php echo htmlspecialchars($data["title"]); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">內容說明：</label>
                            <textarea class="form-control" name="information" rows="5"
                                required><?php echo htmlspecialchars($data["information"]); ?></textarea>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success">儲存修改</button>
                            <a href="post.history_en.php" class="btn btn-secondary ms-2">返回歷史紀錄</a>
                        </div>
                    </form>
                <?php } else { ?>
                    <div class="alert alert-warning text-center">找不到該筆資料，請確認網址是否正確。</div>
                <?php } ?>
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
</body>


</html>