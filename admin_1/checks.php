<?php
//session_start();
include "../includes/header.php";
if(isset($_SESSION["username"]) && isset($_SESSION["email"])){
    include "../database/connection.php";
    if(isset($_GET['from']) && isset($_GET['to'])){
        $from = $_GET['from'];
        $to = $_GET['to'];
    }
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
                            <span>General</span>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                <h3 class="page-title"><i class="icon-check"></i> Checks
                    <!--                    <small>blog post samples</small>-->
                </h3>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->

                <div class="blog-page blog-content-2">
                    <div class="row">
                        <form action="" method="get" class="form-horizontal form-bordered margin-bottom-20">
                            <div class="form-group">
                                <label class="control-label col-md-3">Date Range</label>
                                <div class="col-md-4">
                                    <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="yyyy-mm-dd">
                                        <input type="text" autocomplete="false" class="form-control" name="from">
                                        <span class="input-group-addon"> to </span>
                                        <input type="text" autocomplete="false" class="form-control" name="to">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <input class="btn btn-primary" type="submit" id="dataSelected">
                                </div>
                            </div>
                                <hr>
                        </form>
                        <form action="orders.php" method="get" class="form-horizontal form-bordered margin-bottom-20">
                            <div class="form-group">
                                <label class="control-label col-md-3">Users</label>
                                <div class="col-md-4">
                                    <div class="input-group input-large date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                        <select name="user_id" onchange="$('#userSelected').click()" id="" class="form-control">
                                            <option value="" selected disabled>Select</option>
                                            <?php
                                            $query = "SELECT * FROM users";
                                            $result = mysqli_query($connect,$query);
                                            while($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <option value="<?php echo $row["id"] ?>"><?php echo $row["user_name"] ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <input type="submit" id="userSelected" class="display-none">
                                    </div>
                                </div>
                            </form>
                        </div>
                    <div class="col-md-12 col-xs-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet light bordered">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr class="active">
                                    <th class="col-xs-4"><strong># ID</strong></th>
                                    <th class="col-xs-4"><strong>User Name</strong></th>
                                    <th class="col-xs-4"><strong>Amount</strong></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $queryUser = "SELECT * FROM orders,users WHERE orders.user_id = users.id GROUP BY users.id";
                                $resultUser = mysqli_query($connect,$queryUser);
                                $countUser = 1;
                                while($rowUser = mysqli_fetch_assoc($resultUser)) {
                                    ?>
                                    <tr role="button" data-toggle="collapse" href="#user<?php echo $rowUser['id'] ?>" aria-expanded="false"
                                        aria-controls="demo<?php echo $rowUser['id'] ?>">
                                        <td data-title="WO Ref"><?php echo $countUser++ ?></td>
                                        <td data-title="Reported"><?php echo $rowUser['user_name'] ?></td>
                                        <?php
                                        $user_id = $rowUser['id'];
                                        $totalProductsPrice = 0;
                                        if(isset($_GET['from']) && isset($_GET['to'])){
                                            $queryAllPrice = "SELECT * FROM orders,users,products,orders_count WHERE orders.user_id = $user_id AND products.id = orders_count.product_id AND orders.id = orders_count.order_id AND orders.date BETWEEN '$from' AND '$to' GROUP BY orders_count.id";
                                        }else{
                                            $queryAllPrice = "SELECT * FROM orders,users,products,orders_count WHERE orders.user_id = $user_id AND products.id = orders_count.product_id AND orders.id = orders_count.order_id GROUP BY orders_count.id";
                                        }
                                        $resultAllPrice = mysqli_query($connect, $queryAllPrice);
                                        while($rowAllPrice = mysqli_fetch_assoc($resultAllPrice)) {
//                                            echo "<pre>";
//                                            print_r($rowAllPrice);
//                                            echo "</pre>";
                                            $totalProductsPrice += $rowAllPrice['amount'] * $rowAllPrice['price'] ;
                                        }
                                        ?>
                                            <td data-title="Type"><?php echo $totalProductsPrice ?></td>

                                    </tr>
                                    <tr>
                                        <td colspan="6" class="hiddenRow">
                                            <div class="collapse" style="padding: 5px 20px" id="user<?php echo $rowUser['id'] ?>">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr class="" style="background: #7be5db;">
                                                        <th class="col-xs-4"><strong># ID</strong></th>
                                                        <th class="col-xs-4"><strong>Order Date</strong></th>
                                                        <th class="col-xs-4"><strong>Amount</strong></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    if(isset($_GET['from']) && isset($_GET['to'])){
                                                        $queryOrders = "SELECT * FROM users,orders,orders_count WHERE orders.user_id = $user_id AND users.id = $user_id AND orders.id = orders_count.order_id AND orders.date BETWEEN '$from' AND '$to' GROUP BY orders_count.order_id";
                                                    }else{
                                                        $queryOrders = "SELECT * FROM users,orders,orders_count WHERE orders.user_id = $user_id AND users.id = $user_id AND orders.id = orders_count.order_id GROUP BY orders_count.order_id";
                                                    }
                                                    $resultOrders = mysqli_query($connect,$queryOrders);
                                                    $countOrders = 1;
                                                    while($rowOrders = mysqli_fetch_assoc($resultOrders)) {
                                                        $order_id = $rowOrders['order_id'];
                                                    ?>
                                                        <tr role="button" data-toggle="collapse" href="#order<?php echo $rowOrders['id'] ?>"
                                                            aria-expanded="false" aria-controls="demo1">
                                                            <td data-title="WO Ref"><?php echo $countOrders++ ?></td>
                                                            <td data-title="Reported"><?php echo $rowOrders['date'] ?></td>
                                                            <?php

                                                            $totalOrdersPrice = 0;
                                                            $queryAllOrdersPrice = "SELECT * FROM users,orders,orders_count,products WHERE orders.user_id = $user_id AND users.id = $user_id AND orders.id = $order_id AND orders_count.order_id = $order_id AND products.id = orders_count.product_id";
                                                            $resultAllOrdersPrice = mysqli_query($connect, $queryAllOrdersPrice);
                                                            while($rowAllOrdersPrice = mysqli_fetch_assoc($resultAllOrdersPrice)) {
                                                                $totalOrdersPrice += $rowAllOrdersPrice['amount'] * $rowAllOrdersPrice['price'] ;
                                                            }
                                                            ?>
                                                            <td data-title="Type"><?php echo $totalOrdersPrice ?></td>
                                                        </tr>
                                                    <tr>
                                                        <td colspan="6" class="hiddenRow">
                                                            <div class="collapse" id="order<?php echo $rowOrders['id'] ?>">
                                                                <table class="table table-nested">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td class="col-xs-4 col-sm-2 text-center productsIcon">
                                                                            <?php
                                                                            $queryProducts = "SELECT * FROM orders,orders_count,products WHERE orders.id = 1 AND orders_count.order_id = $order_id AND products.id = orders_count.product_id";
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