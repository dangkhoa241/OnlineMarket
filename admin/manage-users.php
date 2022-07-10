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

if(isset($_GET['del']))
		  {
		          mysqli_query($con,"delete from products where id = '".$_GET['id']."'");
                  $_SESSION['delmsg']="Product deleted !!";
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
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>Manage Users</h3>
                            </div>

                            <div class="module-body table">

                                <?php if(isset($_GET['del']))
{?>
                                <div class="alert alert-error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Oh snap!</strong>
                                    <?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
                                </div>
                                <?php } ?>

                                <br />


                                <table cellpadding="0" cellspacing="0" border="0"
                                    class="datatable-1 table table-bordered table-striped	 display" width="100%">
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
                                        <!-- <tr>
                                            <td><?php echo 1;?></td>
                                            <td><?php echo "08ef9wuf9sdufs8fasfsd98";?></td>
                                            <td><?php echo "Nguyen Van A";?></td>
                                            <td><?php echo "seller1@gmail.com";?></td>
                                            <td> <?php echo "0983625745";?></td>
                                            <td><?php echo "Quận 5";?></td>
                                            <td class="active"><input type="checkbox" name="active-seller"
                                                    value="<?php echo false;?>" /></td>

                                        </tr> -->
                                        <?php
										//Initialize cURL.
$ch = curl_init();

$token = $_SESSION['token'];

$auth = 'Bearer ' . $token;

echo "<script>console.log($token);</script>";

$headers = array(
    'Accept: application/json',
    'Content-type: application/json',
    'authorization: '. $auth,
);

//Set the URL that you want to GET by using the CURLOPT_URL option.
curl_setopt($ch, CURLOPT_URL, 'http://localhost:9000/api/users?active=false&role=seller');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//Set CURLOPT_RETURNTRANSFER so that the content is returned as a variable.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

//Set CURLOPT_FOLLOWLOCATION to true to follow redirects.
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

//Execute the request.
$data = curl_exec($ch);

$json =  json_decode($data);
    if ($json->data >= 200 && $json->code < 300)
    {
        $_SESSION['alogin']=$_POST['username'];
        $_SESSION['token']=$json->data->token;
    }
//Close the cURL handle.
curl_close($ch);

//Print the data out onto the page.
echo "<script>console.log($data);</script>";

$cnt=1;
while($array)

?>
                                        <!-- <tr>
                                            <td><?php echo htmlentities('stt');?></td>
                                            <td><?php echo htmlentities('_id');?></td>
                                            <td><?php echo htmlentities('name');?></td>
                                            <td> <?php echo htmlentities('email');?></td>
                                            <td><?php echo htmlentities('phone');?>
                                            </td>
                                            <td><?php echo htmlentities('Address');?>
                                            </td>
                                            <td class="active"><input type="checkbox" name="active-seller"
                                                    value="<?php echo false;?>" /></td>
                                        </tr> -->
                                        <?php $cnt=$cnt+1; } ?>
                                        <!-- <tr>
                                            <td><?php echo 2;?></td>
                                            <td><?php echo "3r22wuf9sdufs8fasfsd98";?></td>
                                            <td><?php echo "Nguyen Van B";?></td>
                                            <td><?php echo "seller3@gmail.com";?></td>
                                            <td> <?php echo "0997687457";?></td>
                                            <td><?php echo "Huyện cần giờ";?></td>
                                            <td class="active"><input type="checkbox" name="active-seller"
                                                    value="<?php echo false;?>" /></td>

                                        </tr>
                                        <tr>
                                            <td><?php echo 3;?></td>
                                            <td><?php echo "fsauf9sdufs8fasfsd98";?></td>
                                            <td><?php echo "Nguyen Ngoc Anh";?></td>
                                            <td><?php echo "seller4@gmail.com";?></td>
                                            <td> <?php echo "0988686745";?></td>
                                            <td><?php echo "Quận Gò Vấp";?></td>
                                            <td class="active"><input type="checkbox" name="active-seller"
                                                    value="<?php echo false;?>" /></td>

                                        </tr>
                                        <tr>
                                            <td><?php echo 4;?></td>
                                            <td><?php echo "34539sdufs8fasfsd98";?></td>
                                            <td><?php echo "Tran Van Tai";?></td>
                                            <td><?php echo "seller5@gmail.com";?></td>
                                            <td> <?php echo "0983667865";?></td>
                                            <td><?php echo "TP Thủ Đức";?></td>
                                            <td class="active"><input type="checkbox" name="active-seller"
                                                    value="<?php echo false;?>" /></td>

                                        </tr>
                                        <tr>
                                            <td><?php echo 5;?></td>
                                            <td><?php echo "653wuf9sdufs8fasfsd98";?></td>
                                            <td><?php echo "Nguyen Thi Hue";?></td>
                                            <td><?php echo "seller7@gmail.com";?></td>
                                            <td> <?php echo "0983534558";?></td>
                                            <td><?php echo "Quận 7";?></td>
                                            <td class="active"><input type="checkbox" name="active-seller"
                                                    value="<?php echo false;?>" /></td>

                                        </tr> -->

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
