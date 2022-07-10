<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
		
		}else{
			$message="Product ID is invalid";
		}
	}
		echo "<script>alert('Product has been added to the cart')</script>";
		echo "<script type='text/javascript'> document.location ='my-cart.php'; </script>";
}


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

    <title>Online Market Home Page</title>

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
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

</head>

<body class="cnt-home">



    <!-- ============================================== HEADER ============================================== -->
    <header class="header-style-1">
        <?php include('includes/top-header.php');?>
        <?php include('includes/main-header.php');?>
        <?php include('includes/menu-bar.php');?>
    </header>

    <!-- ============================================== HEADER : END ============================================== -->
    <div class="body-content outer-top-xs" id="top-banner-and-menu">
        <div class="container">
            <div class="furniture-container homepage-container">
                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
                        <!-- ================================== TOP NAVIGATION ================================== -->
                        <?php include('includes/side-menu.php');?>
                        <!-- ================================== TOP NAVIGATION : END ================================== -->
                    </div><!-- /.sidemenu-holder -->

                    <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder">
                        <!-- ========================================== SECTION – HERO ========================================= -->

                        <div id="hero" class="homepage-slider3">
                            <div id="owl-main" class="owl-carousel owl-inner-nav owl-ui-sm">
                                <div class="full-width-slider">
                                    <div class="item" style="background-image: url(assets/images/sliders/slide1.png);">
                                        <!-- /.container-fluid -->
                                    </div><!-- /.item -->
                                </div><!-- /.full-width-slider -->

                                <div class="full-width-slider">
                                    <div class="item full-width-slider"
                                        style="background-image: url(assets/images/sliders/slide2.png);">
                                    </div><!-- /.item -->
                                </div><!-- /.full-width-slider -->

                            </div><!-- /.owl-carousel -->
                        </div>


                        <!-- ============================================== INFO BOXES : END ============================================== -->
                    </div><!-- /.homebanner-holder -->

                </div><!-- /.row -->

                <!-- ============================================== SCROLL TABS ============================================== -->
                <div id="product-tabs-slider" class="scroll-tabs inner-bottom-vs  wow fadeInUp">
                    <div class="more-info-tab clearfix">
                        <h3 class="new-product-title pull-left">Products</h3>

                    </div>

                    <div class="tab-content outer-top-xs">
                        <div class="tab-pane in active" id="all">
                            <div class="product-slider">
                                <div class="owl-carousel home-owl-carousel custom-carousel owl-theme" data-item="4">
                                    <?php
$ret=mysqli_query($con,"select * from products");
while ($row=mysqli_fetch_array($ret)) 
{
	# code...


?>


                                    <div class="item item-carousel">
                                        <div class="products">

                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                            <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                width="180" height="300" alt=""></a>
                                                    </div><!-- /.image -->


                                                </div><!-- /.product-image -->


                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        <span class="price">
                                                            Rs.<?php echo htmlentities($row['productPrice']);?> </span>
                                                        <span
                                                            class="price-before-discount">Rs.<?php echo htmlentities($row['productPriceBeforeDiscount']);?>
                                                        </span>

                                                    </div><!-- /.product-price -->

                                                </div><!-- /.product-info -->

                                                <?php if($row['productAvailability']=='In Stock'){?>
                                                <div class="action"><a
                                                        href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                        class="lnk btn btn-primary">Add to Cart</a></div>
                                                <?php } else {?>
                                                <div class="action" style="color:red">Out of Stock</div>
                                                <?php } ?>
                                            </div><!-- /.product -->

                                        </div><!-- /.products -->
                                    </div><!-- /.item -->
                                    <?php } ?>

                                    <div class="item item-carousel">
                                        <div class="products">

                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                            <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                data-echo="https://suckhoedoisong.qltns.mediacdn.vn/324455921873985536/2021/9/17/tao1-16318699795931750429721-0-0-375-600-crop-1631870249601966495560.jpg"
                                                                width="180" height="300" alt=""></a>
                                                    </div><!-- /.image -->


                                                </div><!-- /.product-image -->


                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities('Táo đỏ Mỹ');?></a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        <span class="price">
                                                            <?php echo htmlentities(120000);?> VND </span>
                                                        <span
                                                            class="price-before-discount"><?php echo htmlentities(150000);?>VND
                                                        </span>

                                                    </div><!-- /.product-price -->

                                                </div><!-- /.product-info -->

                                                <?php if(1){?>
                                                <div class="action"><a
                                                        href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                        class="lnk btn btn-primary">Add to Cart</a></div>
                                                <?php } else {?>
                                                <div class="action" style="color:red">Out of Stock</div>
                                                <?php } ?>
                                            </div><!-- /.product -->

                                        </div><!-- /.products -->
                                    </div><!-- /.item -->
                                    <div class="item item-carousel">
                                        <div class="products">

                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                            <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                data-echo="https://vinmec-prod.s3.amazonaws.com/images/20200513_164911_307202_raucai.max-1800x1800.png"
                                                                width="180" height="300" alt=""></a>
                                                    </div><!-- /.image -->


                                                </div><!-- /.product-image -->


                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities('Rau cải thìa');?></a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        <span class="price">
                                                            <?php echo htmlentities(21000);?> VND </span>
                                                        <span
                                                            class="price-before-discount"><?php echo htmlentities(23500);?>VND
                                                        </span>

                                                    </div><!-- /.product-price -->

                                                </div><!-- /.product-info -->

                                                <?php if(1){?>
                                                <div class="action"><a
                                                        href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                        class="lnk btn btn-primary">Add to Cart</a></div>
                                                <?php } else {?>
                                                <div class="action" style="color:red">Out of Stock</div>
                                                <?php } ?>
                                            </div><!-- /.product -->

                                        </div><!-- /.products -->
                                    </div><!-- /.item -->
                                    <div class="item item-carousel">
                                        <div class="products">

                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                            <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                data-echo="https://dalatfarm.net/wp-content/uploads/2021/06/ca-rot-baby.jpg"
                                                                width="180" height="300" alt=""></a>
                                                    </div><!-- /.image -->


                                                </div><!-- /.product-image -->


                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities('Cà rốt baby');?></a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        <span class="price">
                                                            <?php echo htmlentities(34000);?> VND </span>
                                                        <span
                                                            class="price-before-discount"><?php echo htmlentities(45000);?>VND
                                                        </span>

                                                    </div><!-- /.product-price -->

                                                </div><!-- /.product-info -->

                                                <?php if(1){?>
                                                <div class="action"><a
                                                        href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                        class="lnk btn btn-primary">Add to Cart</a></div>
                                                <?php } else {?>
                                                <div class="action" style="color:red">Out of Stock</div>
                                                <?php } ?>
                                            </div><!-- /.product -->

                                        </div><!-- /.products -->
                                    </div><!-- /.item -->
                                    <div class="item item-carousel">
                                        <div class="products">

                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                            <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                data-echo="https://product.hstatic.net/200000444373/product/cu_den_0e710f1b76234c58be35cd3058617507_1024x1024.png"
                                                                width="180" height="300" alt=""></a>
                                                    </div><!-- /.image -->


                                                </div><!-- /.product-image -->


                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities('Củ dền Organic');?></a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        <span class="price">
                                                            <?php echo htmlentities(13000);?> VND </span>
                                                        <span
                                                            class="price-before-discount"><?php echo htmlentities(15000);?>VND
                                                        </span>

                                                    </div><!-- /.product-price -->

                                                </div><!-- /.product-info -->

                                                <?php if(1){?>
                                                <div class="action"><a
                                                        href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                        class="lnk btn btn-primary">Add to Cart</a></div>
                                                <?php } else {?>
                                                <div class="action" style="color:red">Out of Stock</div>
                                                <?php } ?>
                                            </div><!-- /.product -->

                                        </div><!-- /.products -->
                                    </div><!-- /.item -->
                                    <div class="item item-carousel">
                                        <div class="products">

                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                            <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                data-echo="https://suckhoedoisong.qltns.mediacdn.vn/324455921873985536/2021/9/1/chuoi1-1630451103524540765462.jpg"
                                                                width="180" height="300" alt=""></a>
                                                    </div><!-- /.image -->


                                                </div><!-- /.product-image -->


                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities('Chuối tiêu');?></a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        <span class="price">
                                                            <?php echo htmlentities(8000);?> VND </span>
                                                        <span
                                                            class="price-before-discount"><?php echo htmlentities(15000);?>VND
                                                        </span>

                                                    </div><!-- /.product-price -->

                                                </div><!-- /.product-info -->

                                                <?php if(1){?>
                                                <div class="action"><a
                                                        href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                        class="lnk btn btn-primary">Add to Cart</a></div>
                                                <?php } else {?>
                                                <div class="action" style="color:red">Out of Stock</div>
                                                <?php } ?>
                                            </div><!-- /.product -->

                                        </div><!-- /.products -->
                                    </div><!-- /.item -->
                                    <div class="item item-carousel">
                                        <div class="products">

                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                            <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                data-echo="https://3.bp.blogspot.com/-htFJQjjCfXg/V1vQaJBX6YI/AAAAAAAAAAo/-aZj-QHnxc0ycoL9YdOXEUjrytYSUYitACLcB/s1600/coconut.jpg"
                                                                width="180" height="300" alt=""></a>
                                                    </div><!-- /.image -->


                                                </div><!-- /.product-image -->


                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities('Dừa sáp ngon, cơm dày');?></a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        <span class="price">
                                                            <?php echo htmlentities(150000);?> VND </span>
                                                        <span
                                                            class="price-before-discount"><?php echo htmlentities(200000);?>VND
                                                        </span>

                                                    </div><!-- /.product-price -->

                                                </div><!-- /.product-info -->

                                                <?php if(1){?>
                                                <div class="action"><a
                                                        href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                        class="lnk btn btn-primary">Add to Cart</a></div>
                                                <?php } else {?>
                                                <div class="action" style="color:red">Out of Stock</div>
                                                <?php } ?>
                                            </div><!-- /.product -->

                                        </div><!-- /.products -->
                                    </div><!-- /.item -->

                                    <div class="item item-carousel">
                                        <div class="products">

                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                            <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                data-echo="https://product.hstatic.net/200000325223/product/sau_rieng_new-01_63392fbb5c3d449e913faebc332ae80f_master.png"
                                                                width="180" height="300" alt=""></a>
                                                    </div><!-- /.image -->


                                                </div><!-- /.product-image -->


                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities('Sầu riêng ri 6');?></a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        <span class="price">
                                                            <?php echo htmlentities(230000);?> VND </span>
                                                        <span
                                                            class="price-before-discount"><?php echo htmlentities(300000);?>VND
                                                        </span>

                                                    </div><!-- /.product-price -->

                                                </div><!-- /.product-info -->

                                                <?php if(1){?>
                                                <div class="action"><a
                                                        href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                        class="lnk btn btn-primary">Add to Cart</a></div>
                                                <?php } else {?>
                                                <div class="action" style="color:red">Out of Stock</div>
                                                <?php } ?>
                                            </div><!-- /.product -->

                                        </div><!-- /.products -->
                                    </div><!-- /.item -->
                                    <div class="item item-carousel">
                                        <div class="products">

                                            <div class="product">
                                                <div class="product-image">
                                                    <div class="image">
                                                        <a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>">
                                                            <img src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                data-echo="https://www.ritafarm.com/wp-content/uploads/2016/01/rau-muong-ritafarm.jpg"
                                                                width="180" height="300" alt=""></a>
                                                    </div><!-- /.image -->


                                                </div><!-- /.product-image -->


                                                <div class="product-info text-left">
                                                    <h3 class="name"><a
                                                            href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities('Rau muống');?></a>
                                                    </h3>
                                                    <div class="rating rateit-small"></div>
                                                    <div class="description"></div>

                                                    <div class="product-price">
                                                        <span class="price">
                                                            <?php echo htmlentities(12000);?> VND </span>
                                                        <span
                                                            class="price-before-discount"><?php echo htmlentities(15000);?>VND
                                                        </span>

                                                    </div><!-- /.product-price -->

                                                </div><!-- /.product-info -->

                                                <?php if(1){?>
                                                <div class="action"><a
                                                        href="index.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                        class="lnk btn btn-primary">Add to Cart</a></div>
                                                <?php } else {?>
                                                <div class="action" style="color:red">Out of Stock</div>
                                                <?php } ?>
                                            </div><!-- /.product -->

                                        </div><!-- /.products -->
                                    </div><!-- /.item -->

                                </div><!-- /.home-owl-carousel -->
                            </div><!-- /.product-slider -->
                        </div>







                    </div>
                </div>
            </div>
        </div>
    </div>



    </section>

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

    <!-- For demo purposes – can be removed on production -->

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
    <!-- For demo purposes – can be removed on production : End -->



</body>

</html>
