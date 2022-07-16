<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['alogin']) == 0)
{
    header('location:index.php');
}
else{
date_default_timezone_set('Asia/Kolkata');// change according timezone
$currentTime = date('d-m-Y h:i:s A', time());

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin| Category</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
          rel='stylesheet'>
</head>

<body>
<?php include('include/header.php'); ?>

<div class="wrapper">
    <div class="container">
        <div class="row">
            <?php include('include/sidebar.php'); ?>
            <div class="span9">
                <div class="content">

                    <div class="module">
                        <div class="module-head">
                            <h3>Category</h3>
                        </div>
                        <div class="module-body">

                            <?php if (isset($_POST['submit'])) {
                                ?>

                                <?php
                                $url = "http://localhost:9000/api/categories";
                                $name = $_POST['name'];
                                $description = $_POST['description'];


                                $myObj = new stdClass();
                                $myObj->name = $name;
                                $myObj->description = $description;
                                $myJSON = json_encode($myObj);
                                $ch = curl_init();
                                $token = $_SESSION['token'];
                                $auth = 'Bearer ' . $token;


                                $headers = array(
                                    'Accept: application/json',
                                    'Content-type: application/json',
                                    'authorization: ' . $auth,
                                );

                                //set the url, number of POST vars, POST data
                                curl_setopt($ch, CURLOPT_URL, $url);
                                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                curl_setopt($ch, CURLOPT_POST, true);
                                curl_setopt($ch, CURLOPT_POSTFIELDS, $myJSON);
                                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                                curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

                                //execute post
                                $result = curl_exec($ch);
                                curl_close($ch);
                                ?>

                            <?php } ?>


                            <br/>

                            <form class="form-horizontal row-fluid" name="Category" method="post">

                                <div class="control-group">
                                    <label class="control-label" for="basicinput">Category Name</label>
                                    <div class="controls">
                                        <input type="text" placeholder="Enter category Name" name="name"
                                               class="span8 tip" required>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label" for="basicinput">Description</label>
                                    <div class="controls">
                                        <textarea class="span8" name="description" rows="5"></textarea>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <div class="controls">
                                        <button type="submit" name="submit" class="btn">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="module">
                        <div class="module-head">
                            <h3>Manage Categories</h3>
                        </div>
                        <div class="module-body table">
                            <table class="datatable-1 table table-bordered table-striped display">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                </tr>
                                </thead>

                                <tbody>

                                <?php
                                include('../includes/config.php');
                                $category = getData('categories');

                                foreach ($category as $key => $value) {
                                    echo "
                                    <tr>
                                        <td>" . $value->_id . "</td>
                                        <td>" . $value->name . "</td>
                                        <td>" . $value->description . "</td>
                                    </tr>          
                                ";
                                }
                                ?>

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

<?php include('include/footer.php'); ?>

<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
<script src="scripts/datatables/jquery.dataTables.js"></script>
<script>
    $(document).ready(function () {
        $('.datatable-1').dataTable();
        $('.dataTables_paginate').addClass("btn-group datatable-pagination");
        $('.dataTables_paginate > a').wrapInner('<span />');
        $('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
        $('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
    });
</script>
</body>
<?php } ?>
