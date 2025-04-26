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
              <li><a href="cl.html" class="active">首頁</a></li>
              <li><a href="properties2.php">瀏覽</a></li>
              <li><a href="club contact.html">發布</a></li>
              <li><a href="clubhistory.php">發布歷史</a></li>
              <li><a href="self.cl.php">個人頁面</a></li>
              <li><a href="first.html">登出</a></li>
              <li><a href="advanced search for club.html"><i class="fa fa-calendar"></i>進階搜尋</a></li>
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
          <h3>社團個人頁面</h3>
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
          <button class="btn btn-secondary" onclick="location.href='cl_self.change.php'" type="button">
            <b>修改個人資料</b>
          </button>
        </h2>
        <form id="contact-form" action="" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label"><b>學校名稱</b>
            </label><input class="form-control" placeholder="您的學校全名" name="school">
          </div>
          <div class="mb-3">
            <label class="form-label"><b>社團名稱</b>
            </label><input class="form-control" placeholder="您的社團名稱" name="club">
          </div>
          <div class="mb-3">
            <label class="form-label"><b>社團規模</b>
            </label><input class="form-control" placeholder="您的社團規模" name="people">
          </div>
          <div class="mb-3">
            <label class="form-label"><b>社團成立年份</b>
            </label><input class="form-control" placeholder="您的社團成立年份" name="year">
          </div>
          <div class="mb-3">
            <label class="form-label"><b>社團類型</b>
            </label><input class="form-control" placeholder="您的社團類型" name="type">
          </div>
          <div class="mb-3">
            <label class="form-label"><b>社群連結</b>
            </label><input class="form-control" placeholder="您的社群連結" name="ins">
          </div>
        </form>
      </div>

      <!-- 右邊行事曆 -->
      <div class="col-lg-6">
        <h2 class="mb-4">行事曆</h2>
        <div id="calendar"></div>
      </div>
    </div>
  </div>

  <!-- 行事曆的 Modal -->
  <div class="modal fade" id="eventModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">行程管理</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body" id="modal-body-content"></div>
      </div>
    </div>
  </div>

  <!-- FullCalendar -->
  <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

  <script>
    let calendar;
    document.addEventListener('DOMContentLoaded', function () {
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
          showEventsModal(info.dateStr);
        }
      });
      calendar.render();
    });

    function showEventsModal(dateStr) {
      const modalElement = document.getElementById('eventModal');
      const eventModal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);

      const events = calendar.getEvents().filter(event => event.startStr.startsWith(dateStr));
      let html = `<h5>${dateStr}</h5>`;

      if (events.length > 0) {
        html += '<ul class="list-group">';
        events.forEach(event => {
          html += `<li class="list-group-item d-flex justify-content-between align-items-center">
                    ${event.title}
                    <button class="btn btn-sm btn-outline-primary" onclick="editEvent('${event.id}', '${dateStr}')">修改/刪除</button>
                   </li>`;
        });
        html += '</ul>';
      } else {
        html += '<p>今日無行程</p>';
      }

      html += `<button class="btn btn-success mt-3" onclick="addEvent('${dateStr}')">新增行程</button>`;
      document.getElementById('modal-body-content').innerHTML = html;

      eventModal.show();
    }

    function addEvent(dateStr) {
      const title = prompt('請輸入行程名稱:');
      if (title) {
        calendar.addEvent({
          id: String(Date.now()),
          title: title,
          start: dateStr
        });
        showEventsModal(dateStr); // 重新刷新列表
      }
    }

    function editEvent(id, dateStr) {
      const event = calendar.getEventById(id);
      if (!event) return;

      const newTitle = prompt('修改行程名稱：\n（不輸入即可刪除）', event.title);
      if (newTitle === null) return; // 使用者按取消
      if (newTitle === '') {
        // 若輸入空白，刪除
        if (confirm('確定要刪除此行程嗎？')) {
          event.remove();
        }
      } else {
        event.setProp('title', newTitle);
      }
      showEventsModal(dateStr); // 更新列表
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
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/isotope.min.js"></script>
  <script src="assets/js/owl-carousel.js"></script>
  <script src="assets/js/counter.js"></script>
  <script src="assets/js/custom.js"></script>

</body>
</html>
