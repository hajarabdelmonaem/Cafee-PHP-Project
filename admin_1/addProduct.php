<?php
//session_start();
include "../includes/header.php";
if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
    ?>
    <body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
    <?php include "../includes/navBar.php" ?>
    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"></div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">

        <?php include "../includes/sideBar.php" ?>
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
                <h3 class="page-title"><i class="fa fa-briefcase"></i> Add Product
                    <!--                    <small>blog post samples</small>-->
                </h3>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->

                <div class="blog-page blog-content-2">
                    <div class="row">
                        <div class="main">

                            <!-- Sign up form -->
                            <section class="signup">
                                <div class="container">
                                    <div class="signup-content">
                                        <div class="signup-form">
                                            <h2 class="form-title">Add Product</h2>
                                            <form method="POST" class="register-form"
                                                  action="../controllers/productsController.php" id="register-form"
                                                  enctype="multipart/form-data"
                                                  action="">
                                                <div class="form-group">
                                                    <label for="productName"></label>
                                                    <input type="text" name="product_name" id="product_name"
                                                           placeholder="Product Name"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="Price"></label>
                                                    <input type="number" name="product_price" id="price"
                                                           placeholder="Product's Price"/>
                                                </div>

                                                <div class="form-group">
                                                    <span style="color:gray">Category</span>


                                                    <select class="form-control form-control-md" name="categorySelect">

                                                        <?php
                                                        $conn = mysqli_connect("localhost", "root", "", "cafeedb");
                                                        $res = mysqli_query($conn, "select * from category");

                                                        while ($row = mysqli_fetch_array($res)) {
                                                            ?>


                                                            <option value=<?php echo $row["id"] ?>> <?php echo $row["category_name"] ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>

                                                </div>

                                                <!-- modal button-->

                                                <button type="button" class="btn btn-primary"
                                                        style="margin-left:135px;margin-top:5px;"
                                                        data-toggle="modal" data-target="#myModal">Add Category
                                                </button>
                                                <div class="form-group">

                                                    <div class="file-field">
                                                        <div class="btn  btn-sm float-left">

                                                            <input type="file" name="categoryImg">
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="form-group form-button">
                                                    <input type="submit" name="signup" id="signup" class="form-submit"
                                                           value="Save"/>
                                                    <input type="submit" name="reset" id="reset" class="form-submit"
                                                           value="Reset"/>
                                                </div>

                                            </form>
                                            <!-- Modal -->
                                            <form metho="post" action="">
                                                <div id="myModal" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">

                                                        <!-- Modal content-->
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal">&times;
                                                                </button>
                                                                <h4 class="modal-title">Add Your Product</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="input-group mb-3">
                                                                    <input type="text" class="form-control"
                                                                           placeholder="Write your Product Here ... "
                                                                           name="productName"
                                                                           aria-describedby="basic-addon2">


                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">

                                                                <button type="submit" class="btn btn-primary"
                                                                        name="saveProduct">Save
                                                                </button>
                                                            </div>

                                                        </div>


                                                    </div>
                                                </div>

                                                <?php
                                                if (isset($_POST['saveProduct'])) {

                                                    $nameOfProduct = $_POST['productName'];

                                                    $connect = mysqli_connect("localhost", "root", "", "cafeedb");
                                                    if ($connect) {

                                                        $insertIntoCategory = mysqli_query($connect, "insert into category (category_name) values('$nameOfProduct')");
                                                    }


                                                }

                                                ?>
                                            </form>
                                        </div>
                                        <div class="signup-image">
                                            <figure><img src="../assets/Images/signup-image.jpg" alt="sing up image">
                                            </figure>

                                        </div>
                                    </div>
                                </div>
                            </section>


                        </div>
                    </div>
                </div>
            </div>
            <!-- END CONTENT BODY -->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <?php include "../includes/footer.php" ?>
    </body>
    </html>
    <?php
} else {
    header("location:login.php");
}

?>