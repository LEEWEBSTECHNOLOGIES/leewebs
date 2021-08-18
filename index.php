<?php
session_start();


include('includes/header.php');
?>

  <title>Leewebs Technologies - Index</title>
</head>

<!-- ======= Navbar ======= -->
<?php include('includes/navbar.php') ?>



<!-- ======= Intro Section ======= -->
<div id="home" class="intro route bg-image" style="background-image: url(assets/img/intro_bg.jpg)">
  <div class="overlay-itro"></div>
  <div class="intro-content display-table">
    <div class="table-cell">
      <div class="container">
        <!--<p class="display-6 color-d">Hello, world!</p>-->
        <h1 class="intro-title mb-4">I am Ali Ajibade</h1>
        <p class="intro-subtitle"><span class="text-slider-items">CEO Leewebs Technologies, Graphic Designer, Web Designer, Web Developer, EduCreator</span><strong class="text-slider"></strong></p>
        <!-- <p class="pt-3"><a class="btn btn-primary btn js-scroll px-4" href="#about" role="button">Learn More</a></p> -->
      </div>
    </div>
  </div>
</div><!-- End Intro Section -->


<main id="main">
  <!-- ======= Counter Section ======= -->
  <div class="section-counter paralax-mf bg-image" style="background-image: url(assets/img/counters-bg_1.jpg)">
    <div class="overlay-mf"></div>
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-lg-3">
          <div class="counter-box counter-box pt-4 pt-md-0">
            <div class="counter-ico">
              <span class="ico-circle"><i class="ion-checkmark-round"></i></span>
            </div>
            <div class="counter-num">
              <p class="counter">50</p>
              <span class="counter-text">WORKS COMPLETED</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3 col-lg-3">
          <div class="counter-box pt-4 pt-md-0">
            <div class="counter-ico">
              <span class="ico-circle"><i class="ion-ios-calendar-outline"></i></span>
            </div>
            <div class="counter-num">
              <p class="counter">4</p>
              <span class="counter-text">YEARS OF EXPERIENCE</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3 col-lg-3">
          <div class="counter-box pt-4 pt-md-0">
            <div class="counter-ico">
              <span class="ico-circle"><i class="ion-ios-people"></i></span>
            </div>
            <div class="counter-num">
              <p class="counter">10</p>
              <span class="counter-text">TOTAL CLIENTS</span>
            </div>
          </div>
        </div>
        <div class="col-sm-3 col-lg-3">
          <div class="counter-box pt-4 pt-md-0">
            <div class="counter-ico">
              <span class="ico-circle"><i class="ion-ribbon-a"></i></span>
            </div>
            <div class="counter-num">
              <p class="counter">0</p>
              <span class="counter-text">AWARD WON</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- End Counter Section -->

  <!-- ======= Portfolio Section ======= -->
  <section id="work" class="portfolio-mf sect-pt4 route">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title-box text-center">
            <h3 class="title-a">
              Portfolio
            </h3>
            <p class="subtitle-a">
              Leewebs Technologies is a web development and graphic design agency.
            </p>
            <div class="line-mf"></div>
          </div>
        </div>
      </div>
      <div class="row">
      <?php
        require 'admin/database/dbconfig.php';
        $query = "SELECT * FROM portfolio";
        $query_run = mysqli_query($connection, $query);
        $check_portfolio = mysqli_num_rows($query_run) > 0;

        if ($check_portfolio) {
          while ($row = mysqli_fetch_assoc($query_run)) {
            ?>

        <div class="col-md-4">
          <div class="work-box">
            <a href="admin/upload/portfolio/<?php echo $row['image']; ?>" data-gall="portfolioGallery" class="venobox">
              <div class="work-img">
                <img src="admin/upload/portfolio/<?php echo $row['image']; ?>" alt="" class="img-fluid">
              </div>
            </a>
            <div class="work-content">
              <div class="row">
                <div class="col-sm-8">
                  <h2 class="w-title"><?php echo $row['description']; ?></h2>
                  <div class="w-more">
                    <span class="w-ctegory"><?php echo $row['title']; ?></span> / <span class="w-date"><?php $new_date = explode("-", $row['date']); echo $new_date[2]."-".$new_date[1]."-".$new_date[0]; ?></span>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="w-like">
                    <a href="portfolio-details.php"> <span class="ion-ios-plus-outline"></span></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
            <?php
          }
          
        }

        ?>

      </div>
    </div>
  </section><!-- End Portfolio Section -->

  <!-- ======= Testimonials Section ======= -->
  <div class="testimonials paralax-mf bg-image" style="background-image: url(assets/img/overlay-bg.jpg)">
    <div class="overlay-mf"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div id="testimonial-mf" class="owl-carousel owl-theme">
            <div class="testimonial-box">
              <div class="author-test">
                <img src="assets/img/web_developer.jpg" alt="" class="rounded-circle b-shadow-a">
                <span class="author">Maryam Ibraheem</span>
              </div>
              <div class="content-test">
                <p class="description lead">
                  We 've had Ali into work with us a creative designer. He is a good designer. We would be happy to work with him again in the future.  
                </p>
                <span class="comit"><i class="fa fa-quote-right"></i></span>
              </div>
            </div>
            <div class="testimonial-box">
              <div class="author-test">
                <img src="assets/img/web_developer.jpg" alt="" class="rounded-circle b-shadow-a">
                <span class="author">Sir P</span>
              </div>
              <div class="content-test">
                <p class="description lead">
                  I am always satisfied with Ali's work be it development or design.
                </p>
                <span class="comit"><i class="fa fa-quote-right"></i></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- End Testimonials Section -->

  <!-- ======= Blog Section ======= -->
  <section id="blog" class="blog-mf sect-pt4 route">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="title-box text-center">
            <h3 class="title-a">
              Blog
            </h3>
            <p class="subtitle-a">
            Work with LEEWEBS TECHNOLOGIES and let us help you transform your business!
            </p>
            <div class="line-mf"></div>
          </div>
        </div>
      </div>
      <div class="row">
      <?php
       require 'admin/database/dbconfig.php';
       $query = "SELECT * FROM blog";
       $query_run = mysqli_query($connection, $query);
       $check_blog = mysqli_num_rows($query_run) > 0;

       if ($check_blog) {
         while($row = mysqli_fetch_array($query_run)) {
           ?>

        <div class="col-md-4">
          <div class="card card-blog">
            <div class="card-img">
              <a href="blog-single.php?id=.<?php echo $row['id'] ?>"><img src="admin/upload/testimony/<?php echo $row['image']; ?>" alt="" class="img-fluid"></a>
            </div>
            <div class="card-body">
              <div class="card-category-box">
                <div class="card-category">
                  <h6 class="category"><?php echo $row['title']; ?></h6>
                </div>
              </div>
              <h3 class="card-title"><a href="blog-single.php"><?php echo $row['topic']; ?></a></h3>
              <p class="card-description">
                <?php echo $row['content']; ?>
              </p>
            </div>
            <div class="card-footer">
              <div class="post-author">
                <a href="#">
                  <img src="assets/img/web_developer.jpg" alt="" class="avatar rounded-circle">
                  <span class="author">Ali</span>
                </a>
              </div>
              <div class="post-date">
                <span class="ion-ios-clock-outline"></span> <?php echo $row['date']; ?>
              </div>
            </div>
          </div>
        </div>
           <?php
           
         }
       } else {
        //  echo "No blog found";
       }

      ?>



       <?php
          require 'admin/database/dbconfig.php';
          $index = "SELECT * FROM single_blog";
          $index_run = mysqli_query($connection, $index);

          if (mysqli_num_rows($index_run) > 0) {
            while($index_row = mysqli_fetch_array($index_run)) {
              echo '
              <a class="dropdown-item" href=blog-single.php?branches='.preg_replace('#[ -]+#', '-', trim($index_row['topic'])).'>
               '.$index_row['topic'].' 
              </a>
              ';
            }
          } else {
            echo "No blog available";
          }
          ?>
        
        
      </div>
    </div>
  </section><!-- End Blog Section -->

  <!-- ======= Contact Section ======= -->

  
  <!-- End Contact Section -->
</main>
<!-- End #main -->
<!-- ======= Footer ======= -->
<?php include('includes/footer.php'); ?>