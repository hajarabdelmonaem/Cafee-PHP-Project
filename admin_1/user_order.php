<?php
//session_start();
include "../includes/header.php";
if(isset($_SESSION["username"]) && isset($_SESSION["email"])){
    include "../database/connection.php";
    ?>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <?php include "../includes/navBar.php"?>
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">

        <?php include "../includes/sideBar.php"?>
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <!-- BEGIN CONTENT BODY -->
            <div class="page-content">
                <!-- BEGIN PAGE HEADER-->
                <!-- BEGIN PAGE BAR -->
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                            <i class="fa fa-circle"></i>
                        </li>
                        <li>
                            <span>User</span>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                <h3 class="page-title"><i class="icon-basket"></i> My Order
                    <!--                    <small>blog post samples</small>-->
                </h3>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->

                <div class="blog-page blog-content-2">
                    <div class="row">
                        <form action="#" method="get" class="form-horizontal form-bordered margin-bottom-20">
                            <div class="form-group">
                                <label class="control-label col-md-3">Date Range</label>
                                <div class="col-md-4">
                                    <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
                                        <input type="text" autocomplete="false" class="form-control" name="startDate">
                                        <span class="input-group-addon"> to </span>
                                        <input type="text" autocomplete="false" class="form-control" name="endDate">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <input class="btn btn-primary" type="submit" id="dataSelected" name="ok">
                                </div>
                            </div>
                            <hr>
                        </form>
                        <div class="col-md-12 col-xs-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr class="active">
                                        <th><strong>Order Date</strong></th>
                                        <th><strong>User Name</strong></th>
                                        <th><strong>Status</strong></th>
                                        <th><strong>Amount</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    require_once("../controllers/orders.class.php");
                                    $orders = new orders();
                                    $arr;
                                    $filteredorders;
                                    $res;
                                    $total_price = 0;
                                    $endresult = $orders->ordersFun($_SESSION['id']);
                                    $directory = "../assets/Images";
                                    $images = glob($directory . "/*.jpg");
                                    while ($row = mysqli_fetch_assoc($endresult)) {
                                        $arr[] = $row;
                                    }
                                    $orders = array();
                                    $startDate = 0;
                                    $endDate = 0;
                                    foreach ($arr as $element) {
                                        $orders[$element['id']][] = $element;

                                    }
                                    if (isset($_GET['ok']) && !empty($_GET['ok'])) {

                                        $startDate = new DateTime($_GET['startDate']);

                                        $endDate = new DateTime($_GET['endDate']);
                                        // var_dump($startDate);
                                        if ($startDate != NULL && $endDate != NULL) {
                                            $filteredorders = array_filter($orders, function ($item) {
                                                $orderdate = new DateTime($item[0]["date"]);
                                                // var_dump($orderdate);
                                                if ($orderdate >= $GLOBALS['startDate'] && $orderdate <= $GLOBALS ['endDate'])
                                                    return TRUE;
                                                else
                                                    return FALSE;
                                            });
                                        }
                                    } else {
                                        $filteredorders = $orders;
                                    }
                                    foreach ($filteredorders as $order) {
                                        ?>
                                        <tr>
                                            <td role="button" data-toggle="collapse"  href="#order<?php echo $order[0]['id'] ?>" aria-expanded="false"
                                                aria-controls="demo<?php echo $order[0]['id'] ?>" data-title="Order Date"><?php echo $order[0]['date'] ?></td>
                                            <td role="button" data-toggle="collapse"  href="#order<?php echo $order[0]['id'] ?>" aria-expanded="false"
                                                aria-controls="demo<?php echo $order[0]['id'] ?>" data-title="User Name"><?php echo $order[0]['user_name'] ?></td>
                                            <td role="button" data-toggle="collapse"  href="#order<?php echo $order[0]['id'] ?>" aria-expanded="false"
                                                aria-controls="demo<?php echo $order[0]['id'] ?>" data-title="Action"><?php if($order[0]['state'] == 'processing'){echo 'processing';}else if($order[0]['state'] == 'inprogress'){echo 'Out For Delivery';}else{echo 'Done';} ?></td>
                                            <?php
                                            $totalOrdersPrice = 0;
                                            $queryAllOrdersPrice = "SELECT * FROM users,orders,orders_count,products WHERE orders.user_id = {$_SESSION['id']} AND users.id = {$_SESSION['id']} AND orders.id = {$order[0]['id']} AND orders_count.order_id = {$order[0]['id']} AND products.id = orders_count.product_id";
                                            $resultAllOrdersPrice = mysqli_query($connect, $queryAllOrdersPrice);
                                            while($rowAllOrdersPrice = mysqli_fetch_assoc($resultAllOrdersPrice)) {
                                                $totalOrdersPrice += $rowAllOrdersPrice['amount'] * $rowAllOrdersPrice['price'] ;
                                            }
                                            ?>
                                            <td role="button" data-toggle="collapse"  href="#order<?php echo $order[0]['id'] ?>" aria-expanded="false"
                                                aria-controls="demo<?php echo $order[0]['id'] ?>" data-title="Total Price"><?php echo $totalOrdersPrice; ?></td>
                                            <td>
                                                <?php
                                                if ($order[0]['state'] == "processing") {
                                                    ?>
                                                    <a href='../controllers/deleteController.php?_id=<?php echo $order[0]['id'] ?>'>Cancel</a>
                                                    <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="hiddenRow">
                                                <div class="collapse" id="order<?php echo $order[0]['id'] ?>">
                                                    <table class="table table-nested">
                                                        <tbody>
                                                        <tr>
                                                            <td class="col-xs-4 col-sm-2 text-center productsIcon">
                                                                <?php
                                                                $queryProducts = "SELECT * FROM orders,orders_count,products WHERE orders.id = {$order[0]['id']} AND orders_count.order_id = {$order[0]['id']} AND products.id = orders_count.product_id";
                                                                $resultProducts = mysqli_query($connect, $queryProducts);
                                                                while ($rowProducts = mysqli_fetch_assoc($resultProducts)) {
                                                                    ?>
                                                                    <a href="javascript:;" class="icon-btn"
                                                                       style="width: 200px;height: 220px;padding: 0;">
                                                                        <img style="width: 100%" src="../assets/Images/<?php echo $rowProducts['product_img'] ?>" alt="">
                                                                        <div style="margin-bottom: 0">
                                                                            <?php echo $rowProducts['product_name'] ?>
                                                                        </div>
                                                                        <div style="margin-bottom: 0;margin-top: 10px">Count : <span><?php echo $rowProducts['amount'] ?></span></div>
                                                                        <span class="badge badge-info" style="width: 40px;height: 30px;display: flex;justify-content: center;align-items: center;font-size: 15px !important;"> <?php echo $rowProducts['price'] ?> </span>
                                                                    </a>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <?php include "../includes/footer.php"?>
    </body>
    </html>
    <?php
}else{
    header("location:login.php");
}

?>