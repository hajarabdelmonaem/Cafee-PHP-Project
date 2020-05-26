<?php
//session_start();
include "../includes/header.php";
if(isset($_SESSION["username"]) && isset($_SESSION["email"])){
    include('../database/connection.php');
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
                <h3 class="page-title"> Admin
                    <!--                    <small>blog post samples</small>-->
                </h3>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->

                <div class="blog-page blog-content-2">
                    <div class="row">
                        <?php
                        if($_SESSION['status'] == 'admin'){
                            include "admin.php";
                        }else{
                            ?>
                            <form class="form-horizontal form-bordered margin-bottom-20">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Search for Product</label>
                                    <div class="col-md-4">
                                        <div class="input-group input-large">
                                            <input type="search" placeholder="Search" aria-label="Search" autocomplete="false" class="search form-control" name="from">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            </form>
                            <?php
                            include "user.php";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
<!--    <div class="bg"></div>-->
<!--    <a href="http://anetwork.ir" class="anetwork"></a>-->
<!--    <div class="text"><a>Welcome to Star Bucks!</a></div>-->
<!--    <div class="finish">Smile Please</div>-->
    <!-- END CONTAINER -->
    <?php include "../includes/footer.php"?>
    </body>
    </html>
    <?php
}else{
    header("location:login.php");
}

?>