<?php
    require "../helper/helpers.php";
    use helper\helpers;

?>
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- BEGIN SIDEBAR -->
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper hide">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                    <span></span>
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="nav-item start <?php  helpers::checkUrlActive(["index.php"])?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item start <?php  helpers::checkUrlActive("index.php")?>">
                        <a href="index.php" class="nav-link ">
                            <i class="icon-bar-chart"></i>
                            <span class="title">Dashboard</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="heading">
                <h3 class="uppercase">Pages</h3>
            </li>
            <?php
            if($_SESSION['status'] == 'admin'){

            ?>
            <li class="nav-item <?php  helpers::checkUrlActive(["products.php","users.php","manual_orders.php","checks.php","addProduct.php","addUser.php","orders.php"])?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-user"></i>

                    <span class="title">Admin </span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php  helpers::checkUrlActive(["products.php","addProduct.php"]);?>">
                        <a href="products.php" class="nav-link nav-toggle">
                            <i class="icon-bag"></i>
                            <span class="title">Products</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php  helpers::checkUrlActive(["users.php","addUser.php"])?>">
                        <a href="users.php" class="nav-link nav-toggle">
                            <i class="icon-users"></i>
                            <span class="title">Users</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php  helpers::checkUrlActive(["manual_orders.php"])?>">
                        <a href="manual_orders.php" class="nav-link nav-toggle">
                            <i class="icon-basket"></i>
                            <span class="title">Manual Orders</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                    <li class="nav-item <?php  helpers::checkUrlActive(["checks.php"])?>">
                        <a href="checks.php" class="nav-link nav-toggle">
                            <i class="icon-check"></i>
                            <span class="title">Checks</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php
            }else{
            ?>
            <li class="nav-item <?php  helpers::checkUrlActive(["user_order.php"])?>">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="icon-users"></i>
                    <span class="title">Users </span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li class="nav-item <?php  helpers::checkUrlActive(["user_order.php"])?>">
                        <a href="user_order.php" class="nav-link nav-toggle">
                            <i class="icon-basket"></i>
                            <span class="title">My Orders</span>
                            <span class="selected"></span>
                        </a>
                    </li>
                </ul>
            </li>
            <?php
            }
            ?>
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->
