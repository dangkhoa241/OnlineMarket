<?php
session_start();
include('include/config.php');
if (strlen($_SESSION['shop-token']) == 0) {
    header('location:index.php');
} else {
    $pid = intval($_GET['id']); // product id
    if (isset($_POST['Update'])) {
        $category = $_POST['category'];
        $name = $_POST['name'];
        $productprice = $_POST['price'];
        $productdescription = $_POST['description'];
        $url = "http://localhost:9000/api/products".$pid;
        $_SESSION['msg'] = "Product Updated Successfully !!";



        $myObj = new stdClass();
        if ($name != "") {
            $myObj->name = $name;
        }
        if ($productprice != "") {
            $myObj->price = $productprice;
        }
        if ($productdescription != "") {
            $myObj->description = $productdescription;
        }
        if ($category != "") {
            $myObj->category = $category;
        }
        $myJSON = json_encode($myObj);
        $ch = curl_init();
        $token = $_SESSION['shop-token'];
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

        //execute 
        $result = curl_exec($ch);
        $json =  json_decode($result);
        echo "<script>console.log($myJSON);</script>";
        echo "<script>console.log($result);</script>";
        curl_close($ch);
    }


?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Shop | Insert Product</title>
        <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
        <link type="text/css" href="css/theme.css" rel="stylesheet">
        <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
        <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
        <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
        <script type="text/javascript">
            bkLib.onDomLoaded(nicEditors.allTextAreas);
        </script>


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
                                    <h3>Update Product id: <?php echo "$pid" ?></h3>
                                </div>
                                <div class="module-body">

                                   


                                    

                                    <br />

                                    <form class="form-horizontal row-fluid" name="edit" method="post" enctype="multipart/form-data">
                                        <label class="control-label" for="basicinput">Category</label>
                                        <div class="controls">
                                            <select name="category" class="span8 tip" onChange="getSubcat(this.value);" required>
                                                <option value="">Select Category</option>
                                                <?php include('../includes/config.php');
                                                $category = getData('categories');
                                                foreach ($category as $key => $value) { ?>
                                                    <option value="<?php echo $value->_id; ?>">
                                                        <?php echo $value->name; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <br>
                                        <label>Product name:</label><input type="text" name="name" id="name">

                                        <label>Product price:</label><input type="text" name="price" id="price">
                                        <label>Product description:</label><input type="text" name="description" id="description"> <br> <br>
                                        <button type="Update" name="Update" class="btn">Update</button>
                                    </form>
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