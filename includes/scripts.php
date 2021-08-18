<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="assets/vendor/php-email-form/validate.js"></script>
<script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="assets/vendor/counterup/jquery.counterup.min.js"></script>
<script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="assets/vendor/typed.js/typed.min.js"></script>
<script src="assets/vendor/venobox/venobox.min.js"></script>
<script src="assets/js/all.js"></script>
<script src="assets/js/sweetalert.min.js"></script>
<?php
if (isset($_SESSION['status']) &&  $_SESSION['status'] != '') {
    ?>
  
    <script>
        swal({
        title: "<?php echo $_SESSION['status']; ?>",
        // text: "You clicked the button!",
        icon: "<?php echo $_SESSION['status_code'];  ?>",
        button: "Ok, done!",
        });
    </script>
    <?php
    unset($_SESSION['status']);
}

?>




<!-- Main JS File -->
<script src="assets/js/main.js"></script>
