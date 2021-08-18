<?php
session_start();
include('includes/header.php');
?>
  <title>Leewebs Technologies - Contact</title>
</head>

<!-- ======= Navbar ======= -->
<?php include('includes/navbar.php') ?>

<!-- ======= Intro Section ======= -->
<div id="home" class="intro route bg-image" style="background-image: url(assets/img/4.jpg)">
    <div class="overlay-itro"></div>
        <div class="intro-content display-table">
    </div>
</div>
<!-- End Intro Section -->

<!-- ======= Contact Section ======= -->
<section class="paralax-mf footer-paralax bg-image sect-mt4 route" style="background-image: url(assets/img/overlay-bg.jpg)">
    <div class="overlay-mf"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="contact-mf">
                    <div id="contact" class="box-shadow-full">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="title-box-2">
                                    <h5 class="title-left">Send Us Message</h5>                                
                                </div>
                                <div> 
                                    <form action="code.php" method="POST">
                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                                                    <!-- <div class="validate"></div> -->
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                                                    <!-- <div class="validate"></div> -->
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
                                                    <!-- <div class="validate"></div> -->
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                                                    <!-- <div class="validate"></div> -->
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <button type="submit" name="contact_save" class="button button-a button-big button-rounded">Send Message</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="title-box-2 pt-4 pt-md-0">
                                    <h5 class="title-left">Get in Touch</h5>                                
                                </div>
                                <div class="more-info">
                                    <p class="lead">
                                     Hire us to make your graphic design and web development projects on time with no compromise on quality.
                                    </p>
                                    <ul class="list-ico">
                                        <li><span class="ion-ios-location"></span>Lagos, Nigeria.</li>
                                        <li><span class="ion-ios-telephone"></span>+234 8084 838268</li>
                                        <li><span class="ion-email"></span>leewebs@yahoo.com</li>
                                    </ul>
                                </div>
                                <div class="socials">
                                    <ul>
                                        <li><a href="https://web.facebook.com/ali.ajibade.946/"><span class="ico-circle"><i class="ion-social-facebook"></i></span></a></li>
                                        <li><a href="https://www.instagram.com/leewebs2020/"><span class="ico-circle"><i class="ion-social-instagram"></i></span></a></li>
                                        <li><a href="https://twitter.com/Aliu94992120"><span class="ico-circle"><i class="ion-social-twitter"></i></span></a></li>
                                        <li><a href="https://www.pinterest.com/aliuajibade3170139/"><span class="ico-circle"><i class="ion-social-pinterest"></i></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Contact Section -->


<!-- ======= Footer ======= -->
<?php include('includes/footer.php'); ?>
