<?php
session_start();
include('include/config.php');

var_dump($_COOKIE['token']);

//if(is_null($_COOKIE['token']) == 1 && strlen($_COOKIE['token']) == 0){
//        header('location:index.php');
//}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin| Manage Users</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>
</head>

<body>
    <?php include('include/header.php');?>

    <div class="wrapper">
        <div class="container">
            <div class="row">
                <?php include('include/sidebar.php');?>
                <div class="span9">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>Manage Users</h3>
                            </div>

                            <div class="module-body table">
                                <div class="alert alert-error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Oh snap!</strong>
                                    <?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
                                </div>

                                <br />

                                <table class="datatable-1 table table-bordered table-striped display">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> ID</th>
                                            <th> Name</th>
                                            <th>Email </th>
                                            <th>Mobile Number</th>
                                            <th>Address</th>
                                            <th>Active</th>

                                        </tr>
                                    </thead>
                                    <tbody>
<?php
$ch = curl_init();

$token = $_SESSION['token'];

$auth = 'Bearer ' . $token;

echo "<script>console.log($token);</script>";

$headers = array(
    'Accept: application/json',
    'Content-type: application/json',
    'authorization: '. $auth,
);


curl_setopt($ch, CURLOPT_URL, 'http://localhost:9000/api/users?active=false&role=seller');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

//Execute the request.
$data = curl_exec($ch);

$json =  json_decode($data);
if ($json->data >= 200 && $json->code < 300)
{
    $_SESSION['alogin']=$_POST['username'];
    $_SESSION['token']=$json->data->token;
}
curl_close($ch);

    echo '
        <tr>
            <td><?php echo htmlentities("stt");?></td>
            <td><?php echo htmlentities("_id");?></td>
            <td><?php echo htmlentities("name");?></td>
            <td> <?php echo htmlentities("email");?></td>
            <td><?php echo htmlentities("phone");?></td>
            <td><?php echo htmlentities("Address");?></td>
            <td class="active"><input type="checkbox" name="active-seller" value="" /></td>
        </tr>
    '



?>
                                </table>
                            </div>
                            <span class="">

                                <input type="submit" name="submit" value="Phê duyệt tài khoản"
                                    class="btn btn-upper btn-primary pull-right outer-right-xs">
                            </span>

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
