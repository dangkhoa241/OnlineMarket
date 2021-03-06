<?php
session_start();
error_reporting(0);
include('includes/config.php');
// Code user Registration
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">

    <title>Online Market | Terms of Service</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/green.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <!--<link rel="stylesheet" href="assets/css/owl.theme.css">-->
    <link href="assets/css/lightbox.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/rateit.css">
    <link rel="stylesheet" href="assets/css/bootstrap-select.min.css">

    <!-- Demo Purpose Only. Should be removed in production -->
    <link rel="stylesheet" href="assets/css/config.css">

    <link href="assets/css/green.css" rel="alternate stylesheet" title="Green color">
    <link href="assets/css/blue.css" rel="alternate stylesheet" title="Blue color">
    <link href="assets/css/red.css" rel="alternate stylesheet" title="Red color">
    <link href="assets/css/orange.css" rel="alternate stylesheet" title="Orange color">
    <link href="assets/css/dark-green.css" rel="alternate stylesheet" title="Darkgreen color">
    <!-- Demo Purpose Only. Should be removed in production : END -->


    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <script type="text/javascript">
    function valid() {
        if (document.register.password.value != document.register.confirmpassword.value) {
            alert("Password and Confirm Password Field do not match  !!");
            document.register.confirmpassword.focus();
            return false;
        }
        return true;
    }
    </script>
    <script>
    function userAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data: 'email=' + $("#email").val(),
            type: "POST",
            success: function(data) {
                $("#user-availability-status1").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {}
        });
    }
    </script>



</head>

<body class="cnt-home">



    <!-- ============================================== HEADER ============================================== -->
    <header class="header-style-1">

        <!-- ============================================== TOP MENU ============================================== -->
        <?php include('includes/top-header.php');?>
        <!-- ============================================== TOP MENU : END ============================================== -->
        <?php include('includes/main-header.php');?>
        <!-- ============================================== NAVBAR ============================================== -->
        <?php include('includes/menu-bar.php');?>
        <!-- ============================================== NAVBAR : END ============================================== -->

    </header>

    <!-- ============================================== HEADER : END ============================================== -->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="home.html">Home</a></li>
                    <li class='active'>Terms of Service</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content outer-top-bd">
        <div class="container">
            <div class="sign-in-page inner-bottom-sm">
                <div class="row">
                    <div class="col-md-12 col-sm-12 create-new-account">
                        <h4 class="checkout-subtitle">Terms Of Service</h4>
                        <h5>C??c b??n b??n h??ng mong mu???n ????ng k?? b??n h??ng c???n ph???i th???a c??c ti??u ch?? sau:</h5>
                        <ul>
                            <li>1. Gi???y ph??p kinh doanh</li>
                            <li>2. C?? ch???ng nh???n an to??n th???c ph???m</li>
                            <li>3. C??c s???n ph???m c?? ngu???n g???c xu???t x??? r?? r??ng, nh?? nh???p t??? ????u, th???i gian n??o</li>
                        </ul>
                        <h5>B??n b??n ph???i cung c???p c??c gi???y t??? n??y v?? ???????c ki???m tra x??t duy???t b???i c??ng ty ABC. Sau khi
                            ho??n th??nh, b??n b??n ph???i tr??? l???i c??c c??u h???i cam k???t li??n quan ?????n ti??u chu???n b??n h??ng nh??:
                            c???a h??ng b???n ph???i c?? nh??n vi??n ch??m s??c kh??ch h??ng, c???a h??ng b???n ph???i c?? th??ng b??o c??ng ty
                            ABC khi c?? thay ?????i ?????a ch??? kinh doanh, ... Sau khi b??n b??n ho??n th??nh t???t c??? c??c cam k???t,
                            c??c th??ng tin sau s??? ???????c cung c???p ?????y ?????
                            nh??:
                        </h5>
                        <ul style="margin-left: 50px;">
                            <li type="disc">T??n c???a h??ng</li>
                            <li type="disc">?????a ch??? kinh doanh</li>
                            <li type="disc">Lo???i m???t h??ng: n??ng s???n, th???t-c??,???.</li>
                            <li type="disc">S??? ??i???n tho???i li??n h???</li>
                            <li type="disc">T??n nh??n vi??n ch??m s??c kh??ch h??ng</li>
                            <li type="disc">Logo c???a h??ng (n???u c??)</li>
                            <li type="disc">Ng??y gi??? m??? c???a</li>
                            <li type="disc">Ng??y th??nh l???p</li>
                        </ul>
                        <h5>
                            Sau khi cung c???p th??ng tin, c??ng ty ABC s??? ki???m duy???t, th??ng b??o l???p h???p ?????ng v?? k??ch ho???t
                            h??? th???ng ????? b??n b??n c?? th??? b??n s???n ph???m.
                        </h5>
                    </div>
                </div><!-- /.row -->
            </div>

        </div>
    </div>
    <?php include('includes/footer.php');?>
    <script src="assets/js/jquery-1.11.1.min.js"></script>

    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/bootstrap-hover-dropdown.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>

    <script src="assets/js/echo.min.js"></script>
    <script src="assets/js/jquery.easing-1.3.min.js"></script>
    <script src="assets/js/bootstrap-slider.min.js"></script>
    <script src="assets/js/jquery.rateit.min.js"></script>
    <script type="text/javascript" src="assets/js/lightbox.min.js"></script>
    <script src="assets/js/bootstrap-select.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/scripts.js"></script>

    <!-- For demo purposes ??? can be removed on production -->

    <script src="switchstylesheet/switchstylesheet.js"></script>

    <script>
    $(document).ready(function() {
        $(".changecolor").switchstylesheet({
            seperator: "color"
        });
        $('.show-theme-options').click(function() {
            $(this).parent().toggleClass('open');
            return false;
        });
    });

    $(window).bind("load", function() {
        $('.show-theme-options').delay(2000).trigger('click');
    });
    </script>
    <!-- For demo purposes ??? can be removed on production : End -->



</body>

</html>

</html>
