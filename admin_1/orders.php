<?php
//session_start();
include "../includes/header.php";
if(isset($_SESSION["username"]) && isset($_SESSION["email"])){
    include "../database/connection.php";
    if($_GET['user_id']){
        $user_id = $_GET['user_id'];
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
                            <span>Admin</span>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                <h3 class="page-title"><i class="icon-basket"></i> Orders
                    <!--                    <small>blog post samples</small>-->
                </h3>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->

                <div class="blog-page blog-content-2">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <table class="table table-hover table-bordered">
                                    <thead>
                                    <tr class="active">
                                        <th><strong>Order Date</strong></th>
                                        <th><strong>User Name</strong></th>
                                        <th><strong>Room</strong></th>
                                        <th><strong>EXT.</strong></th>
                                        <th><strong>Total Price</strong></th>
                                        <th><strong>Action</strong></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $queryOrders = "SELECT * FROM users,rooms,orders WHERE orders.user_id = $user_id and users.id = $user_id AND rooms.id = orders.room_id";
                                    $resultOrders = mysqli_query($connect,$queryOrders);
                                    while($rowOrders = mysqli_fetch_assoc($resultOrders)) {
                                        $order_id = $rowOrders['id'];
                                        ?>
                                        <tr role="button" data-toggle="collapse" href="#order<?php echo $rowOrders['id'] ?>" aria-expanded="false"
                                            aria-controls="demo<?php echo $rowOrders['id'] ?>">
                                            <td data-title="Order Date"><?php echo $rowOrders['date'] ?></td>
                                            <td data-title="User Name"><?php echo $rowOrders['user_name'] ?></td>
                                            <td data-title="Room"><?php echo $rowOrders['room_name'] ?></td>
                                            <td data-title="EXT."><?php echo $rowOrders['ext'] ?></td>
                                            <?php

                                            $totalOrdersPrice = 0;
                                            $queryAllOrdersPrice = "SELECT * FROM users,orders,orders_count,products WHERE orders.user_id = $user_id AND users.id = $user_id AND orders.id = $order_id AND orders_count.order_id = $order_id AND products.id = orders_count.product_id";
                                            $resultAllOrdersPrice = mysqli_query($connect, $queryAllOrdersPrice);
                                            while($rowAllOrdersPrice = mysqli_fetch_assoc($resultAllOrdersPrice)) {
                                                $totalOrdersPrice += $rowAllOrdersPrice['amount'] * $rowAllOrdersPrice['price'] ;
                                            }
                                            ?>
                                            <td data-title="Total Price"><?php echo $totalOrdersPrice ?></td>
                                            <td data-title="Action"><?php if($rowOrders['state'] == 0){echo 'processing';}else if($rowOrders['state'] == 1){echo 'Out For Delivery';}else{echo 'Done';} ?></td>

                                        </tr>
                                        <tr>
                                            <td colspan="6" class="hiddenRow">
                                                <div class="collapse" id="order<?php echo $rowOrders['id'] ?>">
                                                    <table class="table table-nested">
                                                        <tbody>
                                                        <tr>
                                                            <td class="col-xs-4 col-sm-2 text-center productsIcon">
                                                                <?php
                                                                $queryProducts = "SELECT * FROM orders,orders_count,products WHERE orders.id = $order_id AND orders_count.order_id = $order_id AND products.id = orders_count.product_id";
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
    }
}else{
    header("location:login.php");
}

?>