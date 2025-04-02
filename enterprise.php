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
                    
                    <!-- ***** Logo End ***** -->
                    <!-- ***** Menu Start ***** -->
                    <ul class="nav">
                            <li><a href="cl.html" class="active">首頁</a></li>
                            <li><a href="properties.php">瀏覽</a></li>
                            <li><a href="club.php">發布</a></li>
                            <li><a href="advanced search for club.html"><i class="fa fa-calendar"></i>進階搜尋</ruby></a>
                            </li>
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
          <h3>贊助需求
          </h3>
        </div>
      </div>
    </div>
  </div>

  <div class="single-property section">
    <div class="container">
      <div class="row">
        <?php
        $requirement_num = $_GET['requirement_num'];

        $link = mysqli_connect('localhost', 'root', '', 'SA');
        $sql = "select * from en_requirements where requirement_num = '$requirement_num'";
        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($result)){
        echo "<div class=col-lg-8>
          <div class=main-content>
            <strong>", $row['title'], "</strong> 
            
            <br><br>", $row['information'], 
          "</div> 
          <div class=accordion id=accordionExample>
            <div class=accordion-item>
              <div aria-labelledby=headingOne>
                <div class=accordion-body>
                </div>
              </div>
            </div>
          </div>
        </div>";
        }
        ?>

        <?php
        $requirement_num = $_GET['requirement_num'];

        $link = mysqli_connect('localhost', 'root', '', 'SA');
        $sql = "select * from en_requirements where requirement_num = '$requirement_num'";
        $result = mysqli_query($link, $sql);
        while($row = mysqli_fetch_assoc($result)){
        echo "<div class=col-lg-4>
          <div class=info-table>
            <ul>
              <li>
                <h4>贊助範圍<br><span>", $row['money'], "</span></h4>
              </li>
              <li>
                <h4>企業發展類型<br><span>", $row['type'], "</span></h4>
              </li>
              <li>
                <h4>企業統一編號<br><span>since ", $row['code'], "</span></h4>
              </li>
              <li>
                <h4><a href=", $row['ins'], " target=_blank>社群連結</a><br><span></span></h4>
              </li>
            </ul>
          </div>
        </div>";
        }
        ?>
      </div>
    </div>
  </div>
  <br>
  <br>
  <br>

 

 
  <footer class="footer-no-gap">
    <div class="container">
      <div class="col-lg-12">
        <p>Copyright © 2048 Villa Agency Co., Ltd. All rights reserved. 
        
        Design: <a rel="nofollow" href="https://templatemo.com" target="_blank">TemplateMo</a> Distribution: <a href="https://themewagon.com">ThemeWagon</a></p>
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