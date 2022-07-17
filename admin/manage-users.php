<?php
session_start();
include('include/config.php');

if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_POST['active_seller'])){
    $url = "http://localhost:9000/api/users/active";
    $ar = $_POST['active_seller'];


    $myObj = new stdClass();

    foreach($ar as $key => $value) {
        $myObj->user_id = $ar[0];
        $myJSON = json_encode($myObj);
        $ch = curl_init();

        $token = $_SESSION['token'];

        $auth = 'Bearer ' . $token;


        $headers = array(
            'Accept: application/json',
            'Content-type: application/json',
            'authorization: '. $auth,
        );

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_POST, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS, $myJSON);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        //execute post
        $result = curl_exec($ch);
        $json =  json_decode($result);
    }
}
}
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
                    <form class="content" method="post">

                        <div class="module">
                            <div class="module-head">
                                <h3>Manage Users</h3>
                            </div>

                            <div class="module-body table">


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
echo "<script>console.log($data);</script>";
$json =  json_decode($data);
//echo "<script>console.log($json);</script>";
// if ($json->data >= 200 && $json->code < 300)
// {
//     $_SESSION['alogin']=$_POST['username'];
//     $_SESSION['token']=$json->data->token;
// }
curl_close($ch);
$users = $json->data;
$l = count($users);
for ($i = 0; $i < $l; $i++) { 
    // echo $users[$i]; echo "<br>";
    ?>
                                        <tr>
                                            <td><?php echo $i + 1;?> </td>
                                            <td><?php echo $users[$i]->_id;?></td>
                                            <td><?php echo $users[$i]->name;?></td>
                                            <td> <?php echo $users[$i]->email;?></td>
                                            <td><?php echo $users[$i]->mobile_number;?></td>
                                            <td><?php echo $users[$i]->address;?></td>
                                            <td class="active"><input type="checkbox" name="active_seller[]"
                                                    value="<?php echo $users[$i]->_id;?>" />
                                            </td>
                                        </tr>
                                        <?php



                                        } ?>
                                </table>
                            </div>
                            <span class="">

                                <input type="submit" name="submit" value="Active User"
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
