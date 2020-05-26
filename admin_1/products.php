<?php
//session_start();
include "../includes/header.php";
if (isset($_SESSION["username"]) && isset($_SESSION["email"])) {
    include "../database/connection.php";
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
                <h3 class="page-title"><i class="fa fa-briefcase"></i> Products
                    <!--                    <small>blog post samples</small>-->
                </h3>
                <!-- END PAGE TITLE-->
                <!-- END PAGE HEADER-->

                <div class="blog-page blog-content-2">
                    <div class="row">
                        <div class="col-md-12 col-xs-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet light bordered">
                                <div class="portlet-title">
                                    <div class="btn-group">
                                        <a href="addProduct.php" id="sample_editable_1_new" class="btn green text-decoration-none"> Add New Product
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                    <div class="tools"></div>
                                </div>
                                <div class="portlet-body">
                                    <table class="table table-striped table-bordered table-hover" id="sample_1">
                                        <thead>
                                            <tr>
                                                <th> # id </th>
                                                <th> Product </th>
                                                <th> Price </th>
                                                <th class="no-print"> Image </th>
                                                <th> Status </th>
                                                <th class="no-print"> Edit </th>
                                                <th class="no-print"> Delete </th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        <?php
                                            $query = "SELECT * FROM products ORDER BY id DESC";
                                            $result = mysqli_query($connect,$query);
                                            $count = 1;
                                            while($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <tr>
                                                    <td> <?php echo $row["id"] ?> </td>
                                                    <td> <?php echo $row["product_name"] ?> </td>
                                                    <td> $<?php echo $row["price"] ?> </td>
                                                    <td><img class="d-flex" style="width: 115px;margin: 0 auto"
                                                             src="../assets/Images/<?php echo $row["product_img"] ?>" alt=""/>
                                                    </td>
                                                    <td>
                                                    <?php if($row['status'] == 0){
                                                    ?>
                                                        <span class="label label-sm label-success"> Available </span>
                                                    <?php
                                                        }else{
                                                    ?>
                                                        <span class="label label-sm label-danger"> UnAvailable </span>
                                                    <?php
                                                    }
                                                    ?>

                                                    </td>
                                                    <td>
                                                        <button class="btn green btn-outline sbold uppercase editProduct" data-toggle="modal" data-target="#exampleModal<?php echo $row["id"] ?>" id="<?php echo $row["id"] ?>"><i class="fa fa-edit"></i> Edit</button>
                                                        <div class="modal fade text-left" id="exampleModal<?php echo $row["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="../controllers/productsController.php" class="validateProduct" enctype="multipart/form-data" method="post">
                                                                            <div class="form-body">
                                                                                <div class="form-group form-md-line-input display-none">
                                                                                    <input type="text" value="<?php echo $row["id"] ?>" class="form-control Product_Name" name="id" placeholder="Enter your name">
                                                                                </div>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <input type="text" value="<?php echo $row["product_name"] ?>" class="form-control Product_Name" name="product_name" placeholder="Enter your name">
                                                                                    <label for="form_control_1">Product Name
                                                                                    </label>
                                                                                    <span class="help-block">Enter your Product name...</span>
                                                                                </div>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <div class="input-group" style="width: 100%">
                                                                                        <input type="text" value="<?php echo $row["price"] ?>" class="form-control Price" name="price" placeholder="Enter Price">
                                                                                        <label for="form_control_1">Price</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group form-md-line-input">
                                                                                    <select class="form-control" name="category_id">
                                                                                        <option value="">Select</option>
                                                                                        <?php
                                                                                            $query = "SELECT * FROM category";
                                                                                            $category_result = mysqli_query($connect,$query);
                                                                                            $count = 1;
                                                                                            while($category_row = mysqli_fetch_assoc($category_result)) {
                                                                                        ?>
                                                                                                <option value="<?php echo $category_row["id"] ?>" <?php echo ($category_row['id'] == $row["category_id"]) ? "selected" : "" ?>><?php echo $category_row["category_name"] ?></option>
                                                                                        <?php
                                                                                            }
                                                                                        ?>
                                                                                    </select>
                                                                                    <label for="form_control_1">Category</label>
                                                                                    <span class="help-block">Select Category</span>
                                                                                </div>
                                                                                <div class="form-group form-md-radios">
                                                                                    <label for="form_control_1">Status</label>
                                                                                    <div class="md-radio-inline">
                                                                                        <div class="md-radio">
                                                                                            <input type="radio" id="checkbox2_8" <?php echo ($row['status'] == 0) ? "checked" : "" ?> name="status" value="0" class="md-radiobtn">
                                                                                            <label for="checkbox2_8">
                                                                                                <span></span>
                                                                                                <span class="check"></span>
                                                                                                <span class="box"></span> Available
                                                                                            </label>
                                                                                        </div>
                                                                                        <div class="md-radio">
                                                                                            <input type="radio" id="checkbox2_9" <?php echo ($row['status'] == 1) ? "checked" : "" ?> name="status" value="1" class="md-radiobtn">
                                                                                            <label for="checkbox2_9">
                                                                                                <span></span>
                                                                                                <span class="check"></span>
                                                                                                <span class="box"></span> UnAvailable
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group form-md-line-input">
                                                                                <div class="input-group margin-bottom-25" style="width: 100%">
                                                                                    <input type="file" value="" class="form-control" name="product_img" placeholder="Enter Price">
                                                                                    <label for="form_control_1">Select Image</label>
                                                                                </div>
                                                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                                                                    <?php
                                                                                        if($row["product_img"] == null){
                                                                                    ?>
                                                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
                                                                                    <?php
                                                                                        }else{
                                                                                    ?>
                                                                                            <img style="width: 100%" src="../assets/Images/<?php echo $row["product_img"] ?>" alt="">
                                                                                    <?php
                                                                                        }
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-actions">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <button type="submit" name="saveEdit" class="btn green">Save Changes</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
<!--                                                                        <button type="button" class="btn btn-primary">Send message</button>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn red btn-outline sbold uppercase deleteProduct" id="<?php echo $row["id"] ?>"><i class="fa fa-trash-o"></i> Delete</button>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th># id</th>
                                                <th>Product</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th> Status </th>
                                                <th> Edit </th>
                                                <th> Delete </th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
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
    <?php include "../includes/footer.php" ?>
    </body>
    </html>
    <?php
} else {
    header("location:login.php");
}

?>