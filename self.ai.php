<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <title>社團企業媒合平台</title>

  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-villa-agency.css">
  <link rel="stylesheet" href="assets/css/owl.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

  <style>
    #calendar {
      background-color: white;
      padding: 15px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      font-family: serif;
    }
  </style>
</head>

<body>

  <!-- ***** Header ***** -->
  <header class="header-area header-sticky">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav class="main-nav">
          <ul class="nav">
                            <li><a href="ai.html" class="active">首頁</a></li>
                            <li><a href="properties3.php">瀏覽</a></li>
                            <li><a href="alumni contact.php">發布</a></li>
                            <li><a href="aihistory.php">發布歷史</a></li>
                            <li><a href="self.ai.php">個人頁面</a></li>
                            <li><a href="login.html">登出</a></li>
                            <li><a href="advanced search for ai.html"><i class="fa fa-calendar"></i>進階搜尋</ruby></a>
                            </li>
                          </ul>
            <a class='menu-trigger'><span>Menu</span></a>
          </nav>
        </div>
      </div>
    </div>
  </header>

  <!-- ***** Page Heading ***** -->
  <div class="page-heading header-text">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <span class="breadcrumb"><a href="#">Home</a> / My Page</span>
          <h3>校友個人頁面</h3>
        </div>
      </div>
    </div>
  </div>

  <!-- ***** Main Content ***** -->
  <div class="container mt-5">
    <div class="row">
      <!-- 左邊表單 -->
      <div class="col-lg-6">
        <h2 class="mb-4">您的個人檔案
          <button class="btn btn-secondary" onclick="location.href='de_self.change.php'" type="button">
            <b>修改個人資料</b>
          </button>
        </h2>
        <?php
        session_start();
        $userID = $_SESSION['userID'];
        $link = mysqli_connect('localhost', 'root', '', 'SA');

        $sql = "SELECT * FROM identity WHERE userID = '$userID'";
        $result = mysqli_query($link, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<form id='contact-form' action='' method='' enctype='multipart/form-data'>
          <div class='mb-3'>
            <label class='form-label'><b>姓名：</b></label><br><b>" . $row['name'] . "</b>
          </div>
          <div class='mb-3'>
            <label class='form-label'><b>聯絡資訊：</b></label><br><b>" . $row['ainins'] . "</b>
          </div>
        </form>";
        }
        ?>
      </div>

      <!-- 右邊行事曆 -->
      <div class="col-lg-6">
        <h2 class="mb-4">行事曆</h2>
        <div id="calendar"></div>
      </div>
    </div>
  </div>

  <!-- FullCalendar Modal -->
  <div class="modal fade" id="eventModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="eventModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="modal-body-content"></div>
      </div>
    </div>
  </div>

  <!-- FullCalendar JS -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    let calendar;
    document.addEventListener('DOMContentLoaded', async function () {
      const calendarEl = document.getElementById('calendar');
      calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        headerToolbar: {
          left: 'title',
          center: '',
          right: 'today prev,next'
        },
        selectable: true,
        dateClick: function (info) {
          showEventForm('add', { date: info.dateStr });
        },
        eventClick: function (info) {
          showEventForm('edit', {
            id: info.event.id,
            title: info.event.title,
            start: info.event.startStr,
            end: info.event.endStr || info.event.startStr
          });
        },
        events: async function (fetchInfo, successCallback, failureCallback) {
          const res = await fetch('events_api.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ action: 'list' })
          });
          const data = await res.json();
          successCallback(data);
        }
      });
      calendar.render();
    });

    function showEventForm(mode, data) {
      const modal = new bootstrap.Modal(document.getElementById('eventModal'));
      const title = mode === 'add' ? '新增行程' : '修改行程';
      document.getElementById('eventModalLabel').innerText = title;

      const form = `
        <form id="eventForm">
          <input type="hidden" name="id" value="${data.id || ''}">
          <div class="mb-3">
            <label class="form-label">行程名稱</label>
            <input type="text" name="title" class="form-control" value="${data.title || ''}" required>
          </div>
          <div class="mb-3">
            <label class="form-label">開始時間</label>
            <input type="datetime-local" name="start" class="form-control" value="${data.start?.replace(' ', 'T') || (data.date + 'T00:00')}">
          </div>
          <div class="mb-3">
            <label class="form-label">結束時間</label>
            <input type="datetime-local" name="end" class="form-control" value="${data.end?.replace(' ', 'T') || (data.date + 'T23:59')}">
          </div>
          <button type="submit" class="btn btn-primary">${mode === 'add' ? '新增' : '修改'}</button>
          ${mode === 'edit' ? '<button type="button" class="btn btn-danger ms-2" onclick="deleteEvent(' + data.id + ')">刪除</button>' : ''}
        </form>`;

      document.getElementById('modal-body-content').innerHTML = form;

      document.getElementById('eventForm').onsubmit = async function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        const payload = Object.fromEntries(formData.entries());
        payload.action = mode;

        const res = await fetch('events_api.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(payload)
        });

        const json = await res.json();
        if (json.success) {
          calendar.refetchEvents();
          modal.hide();
        } else {
          alert(json.error || '操作失敗');
        }
      }

      modal.show();
    }

    async function deleteEvent(id) {
      if (!confirm('確定要刪除這個行程嗎？')) return;
      const res = await fetch('events_api.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ action: 'delete', id })
      });
      const json = await res.json();
      if (json.success) {
        calendar.refetchEvents();
        bootstrap.Modal.getInstance(document.getElementById('eventModal')).hide();
      } else {
        alert(json.error || '刪除失敗');
      }
    }
  </script>

  <!-- Footer -->
  <footer class="mt-5">
    <div class="container">
      <div class="col-lg-8">
        <p style="text-align: left; font-weight: bold;">社團企業媒合平台</p>
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>

</body>
</html>