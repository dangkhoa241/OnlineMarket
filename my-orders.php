<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['confirm_order'])){
    
    $ar = $_POST['confirm_order'];
    $url = "http://localhost:9000/api/orders/" . $ar[0];

    echo $url;
    $myObj = new stdClass();
    $myObj->status = "Đã nhận";
    
    $myJSON = json_encode($myObj);
    $ch = curl_init();
    echo $myJSON;
    $token = $_SESSION['cus-token'];

    $auth = 'Bearer ' . $token;


    $headers = array(
            'Accept: application/json',
            'Content-type: application/json',
            'authorization: '. $auth,
    );

        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $myJSON);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        //execute post
        $result = curl_exec($ch);
        $json =  json_decode($result);
        //echo "<script>console.log($json);</script>";

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

    <title>Order History</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
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
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <script language="javascript" type="text/javascript">
    var popUpWin = 0;

    function popUpWindow(URLStr, left, top, width, height) {
        if (popUpWin) {
            if (!popUpWin.closed) popUpWin.close();
        }
        popUpWin = open(URLStr, 'popUpWin',
            'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' +
            600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
    }
    </script>

</head>

<body class="cnt-home">



    <!-- ============================================== HEADER ============================================== -->
    <header class="header-style-1">
        <?php include('includes/top-header.php');?>
        <?php include('includes/main-header.php');?>
        <?php include('includes/menu-bar.php');?>
    </header>
    <!-- ============================================== HEADER : END ============================================== -->
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="#">Home</a></li>
                    <li class='active'>Shopping Cart</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div><!-- /.breadcrumb -->

    <div class="body-content outer-top-xs">
        <div class="container">
            <div class="row inner-bottom-sm">
                <div class="shopping-cart">
                    <div class="col-md-12 col-sm-12 shopping-cart-table ">
                        <div class="table-responsive">
                            <form name="content" method="post">

                                <table class="datatable-1 table table-bordered table-striped	 display table-responsive">
                                    <thead>
                                        <tr>

                                            <th class="cart-romove item">#</th>
                                            <th class="cart-description item">OrderID</th>
                                            <th class="cart-total item">Payment Method</th>
                                            <th class="cart-description item">Total Price</th>
                                            <th class="cart-description item">Order Date</th>
                                            <th class="cart-description item">Confirm Date</th>
                                            <th class="cart-description item">Delivery Date</th>
                                            <th class="cart-total last-item">Status</th>
                                            <th class="cart-total last-item">Received</th>
                                        </tr>
                                    </thead><!-- /thead -->

                                    <tbody>
                                        <?php
$ch = curl_init();
$id = $_SESSION['cus-id'];
$token = $_SESSION['cus-token'];

$auth = 'Bearer ' . $token;


$headers = array(
    'Accept: application/json',
    'Content-type: application/json',
    'authorization: '. $auth,
);


curl_setopt($ch, CURLOPT_URL, 'http://localhost:9000/api/orders');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

//Execute the request.
$data = curl_exec($ch);
echo "<script>console.log($data);</script>";
$json =  json_decode($data);
//echo "<script>console.log($json);</script>";
// if ($json->data >= 200 && $json->code < 300)
// {
//     $_SESSION['alogin']=$_POST['username'];
//     $_SESSION['token']=$json->data->token;
// }
curl_close($ch);
$orders = $json->data;
$cus_orders = [];
$l1 = count($json->data);
for ($i = 0; $i < $l1; $i++){
    if($orders[$i]->buyer_id = $id){
            $cus_orders[$i] = $orders[$i];
            $j = $l;
        }  
}

$l2 = count($cus_orders);
$c = 0;
for ($i = 0; $i < $l2; $i++) {
    if($cus_orders[$i]->status === "Đang giao"){ 
    // echo $users[$i]; echo "<br>";
    $c++;
    ?>
                                        <tr>
                                            <td><?php echo $c;?> </td>
                                            <td><?php echo $cus_orders[$i]->_id;?></td>
                                            <td><?php echo $cus_orders[$i]->payment_method;?></td>
                                            <td><?php echo $cus_orders[$i]->order_date;?></td>
                                            <td><?php echo $cus_orders[$i]->confirm_date;?></td>
                                            <td><?php echo $cus_orders[$i]->delivery_date;?></td>
                                            <td><?php echo $cus_orders[$i]->total_price;?></td>
                                            <td><?php echo $cus_orders[$i]->status;?></td>
                                            <td class="confirm"><input type="checkbox" name="confirm_order[]"
                                                    value="<?php echo $cus_orders[$i]->_id;?>" />
                                            </td>
                                        </tr>
                                        <?php
    }


                                        } ?>

                                </table>
                        </div>
                        <span class="">

                            <input type="submit" name="submit" value="Received Order"
                                class="btn btn-upper btn-primary pull-right outer-right-xs">
                        </span>
                    </div>

                </div><!-- /.shopping-cart -->
            </div> <!-- /.row -->
            </form>

        </div><!-- /.container -->
    </div><!-- /.body-content -->
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
