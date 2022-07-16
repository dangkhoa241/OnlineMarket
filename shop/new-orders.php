<?php
session_start();
include('include/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop | New Orders</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>
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

<body>
    <?php include('include/header.php');?>

    <div class="wrapper">
        <div class="container">
            <div class="row" width="1300px">
                <?php include('include/sidebar.php');?>
                <div class="span12">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>New Orders</h3>
                            </div>
                            <div class="module-body table">

                                <br />
                                <table cellpadding="0" cellspacing="0" border="0"
                                    class="datatable-1 table table-bordered table-striped	 display table-responsive">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>OrderID</th>
                                            <th>CustomerID</th>
                                            <th>Payment Method</th>
                                            <th>Order Date</th>
                                            <th>Confirm Date</th>
                                            <th>Delivery Date</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                            <th>Confirm</th>


                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
$ch = curl_init();
$id = $_SESSION['id'];
$token = $_SESSION['token'];

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
$shop_orders = [];
$l1 = count($json->data);
for ($i = 0; $i < $l1; $i++){
    $l= count($orders[$i]->products);
    for($j = 0; $j < $l; $j++){
        if($orders[$i]->products[$j]->shop_id = $id){
            $shop_orders[$i] = $orders[$i];
            $j = $l;
        }   
    } 
}

$l2 = count($shop_orders);
for ($i = 0; $i < $l2; $i++) {
    if($shop_orders[$i]->status === "Chờ xác nhận"){ 
    // echo $users[$i]; echo "<br>";
    ?>
                                        <tr>
                                            <td><?php echo $i + 1;?> </td>
                                            <td><?php echo $shop_orders[$i]->_id;?></td>
                                            <td><?php echo $shop_orders[$i]->buyer_id;?></td>
                                            <td><?php echo $shop_orders[$i]->payment_method;?></td>
                                            <td><?php echo $shop_orders[$i]->order_date;?></td>
                                            <td><?php echo $shop_orders[$i]->confirm_date;?></td>
                                            <td><?php echo $shop_orders[$i]->delivery_date;?></td>
                                            <td><?php echo $shop_orders[$i]->total_price;?></td>
                                            <td><?php echo $shop_orders[$i]->status;?></td>
                                            <td class="confirm"><input type="checkbox" name="active_seller[]"
                                                    value="<?php echo $shop_orders[$i]->_id;?>" />
                                            </td>
                                        </tr>
                                        <?php
    }


                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>



                    </div>
                    <!--/.content-->
                </div>
                <!--/.span9-->
            </div>
        </div>
        <!--/.container-->
    </div>
    <!--/.wrapper-->

    <?php include('include/footer.php');?>

    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script src="scripts/datatables/jquery.dataTables.js"></script>
    <script>
    $(document).ready(function() {
        $('.datatable-1').dataTable();
        $('.dataTables_paginate').addClass("btn-group datatable-pagination");
        $('.dataTables_paginate > a').wrapInner('<span />');
        $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
        $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
    });
    </script>
</body>
<?php } ?>
