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
                            <span>Admin</span>
                        </li>
                    </ul>
                </div>
                <!-- END PAGE BAR -->
                <!-- BEGIN PAGE TITLE-->
                <h3 class="page-title"><i class="fa fa-users"></i> Users
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
                                        <a href="addUser.php" id="sample_editable_1_new" class="btn green text-decoration-none"> Add New User
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
                                                <th> Name </th>
                                                <th> Room </th>
                                                <th> Image </th>
                                                <th> Ext. </th>
                                                <th> Edit </th>
                                                <th> Delete </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query = "SELECT * FROM rooms,users WHERE users.room_id = rooms.id";
                                        $result = mysqli_query($connect,$query);
                                        $count = 1;
                                        while($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td> <?php echo $row["id"] ?> </td>
                                                <td> <?php echo $row["user_name"] ?> </td>
                                                <td> <?php echo $row["room_name"] ?> </td>
                                                <td><img class="d-flex" style="width: 115px;margin: 0 auto" src="../assets/Images/<?php echo $row["user_img"] ?>" alt="" /> </td>
                                                <td> <?php echo $row["ext"] ?> </td>
                                                <td>
                                                    <button class="btn green btn-outline sbold uppercase editUser" data-toggle="modal" data-target="#exampleModal<?php echo $row["id"] ?>" id="<?php echo $row["id"] ?>"><i class="fa fa-edit"></i> Edit</button>
                                                    <div class="modal fade text-left" id="exampleModal<?php echo $row["id"] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="../controllers/usersController.php" class="validateUser" enctype="multipart/form-data" method="post">
                                                                        <div class="form-body">
                                                                            <div class="form-group form-md-line-input display-none">
                                                                                <input type="text" value="<?php echo $row["id"] ?>" class="form-control" name="id" placeholder="Enter the name">
                                                                            </div>
                                                                            <div class="form-group form-md-line-input">
                                                                                <input type="text" value="<?php echo $row["user_name"] ?>" class="form-control" name="user_name" placeholder="Enter your name">
                                                                                <label for="form_control_1">User Name
                                                                                </label>
                                                                                <span class="help-block">Enter User name...</span>
                                                                            </div>
                                                                            <div class="form-group form-md-line-input">
                                                                                <input type="email" class="form-control" value="<?php echo $row["email"] ?>" name="email" placeholder="Enter the email">
                                                                                <label for="form_control_1">Email</label>
                                                                                <span class="help-block">Please enter email...</span>
                                                                            </div>
                                                                            <div class="form-group form-md-line-input">
                                                                                <input type="password" value="<?php echo $row["password"] ?>" class="form-control" name="password" placeholder="Enter the password">
                                                                                <label for="form_control_1">Password
                                                                                </label>
                                                                                <span class="help-block">Enter Password...</span>
                                                                            </div>
                                                                            <div class="form-group form-md-line-input">
                                                                                <input type="text" value="<?php echo $row["ext"] ?>" class="form-control" name="ext" placeholder="Enter the ext">
                                                                                <label for="form_control_1">EXT
                                                                                </label>
                                                                                <span class="help-block">Enter EXT...</span>
                                                                            </div>
                                                                            <div class="form-group form-md-line-input">
                                                                                <select class="form-control" name="room_id">
                                                                                    <option value="">Select</option>
                                                                                    <?php
                                                                                    $query = "SELECT * FROM rooms";
                                                                                    $room_result = mysqli_query($connect,$query);
                                                                                    $count = 1;
                                                                                    while($room_row = mysqli_fetch_assoc($room_result)) {
                                                                                        ?>
                                                                                        <option value="<?php echo $room_row["id"] ?>" <?php echo ($room_row['id'] == $row["room_id"]) ? "selected" : "" ?>><?php echo $room_row["room_name"] ?></option>
                                                                                        <?php
                                                                                    }
                                                                                    ?>
                                                                                </select>
                                                                                <label for="form_control_1">Rooms</label>
                                                                                <span class="help-block">Select a Room</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group form-md-line-input">
                                                                            <div class="input-group margin-bottom-25" style="width: 100%">
                                                                                <input type="file" value="" class="form-control" name="user_img" placeholder="Enter Price">
                                                                                <label for="form_control_1">Select Image</label>
                                                                            </div>
                                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                                                                <?php
                                                                                if($row["user_img"] == null){
                                                                                    ?>
                                                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="">
                                                                                    <?php
                                                                                }else{
                                                                                    ?>
                                                                                    <img style="width: 100%" src="../assets/Images/<?php echo $row["user_img"] ?>" alt="">
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
                                                    <button class="btn red btn-outline sbold uppercase deleteUser" id="<?php echo $row["id"] ?>"><i class="fa fa-trash-o"></i> Delete</button>
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
    <?php include "../includes/footer.php"?>
    </body>
    </html>
    <?php
}else{
    header("location:login.php");
}

?>