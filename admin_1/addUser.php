<?php
//session_start();
include "../includes/header.php";
if(isset($_SESSION["username"]) && isset($_SESSION["email"])){
    include "../database/connection.php";
    $emptyArray = [];
    if (isset($_GET["error"]))
        $emptyArray = explode(',', $_GET["error"]);

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
                <h3 class="page-title"><i class="fa fa-users"></i> Add User
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
                                            <h2 class="form-title">Sign up</h2>
                                            <form method="POST" class="register-form" id="register-form" enctype="multipart/form-data" action="../controllers/registerusercontroller.php">
                                                <div class="form-group">
                                                    <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                                    <input type="text" name="name" id="name" placeholder="Your Name"/>
                                                    <span style="color:red"> <?php if(in_array("username",$emptyArray))echo " It's Required";?></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email"><i class="zmdi zmdi-email"></i></label>
                                                    <input type="email" name="email" id="email" placeholder="Your Email"/>
                                                    <span style="color:red"> <?php if(in_array("email",$emptyArray))echo " It's Required";?></span>

                                                </div>
                                                <div class="form-group">
                                                    <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                                    <input type="password" name="pass" id="pass" placeholder="Password"/>
                                                    <span style="color:red"> <?php if(in_array("password",$emptyArray))echo " It's Required";?></span>

                                                </div>
                                                <div class="form-group">
                                                    <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                                    <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                                                    <span style="color:red"><?php if(in_array("repeat_password",$emptyArray)) echo "repeat your password"?></span>

                                                </div>

                                                <div class="form-group">
                                                    <label for="number"><i class="zmdi zmdi-lock-outline"></i> Room</label>
                                                    <select class="form-control" name="number" id="number" style="width=100px">
                                                        <option value="" selected disabled>Select</option>
                                                        <?php
                                                        $query = "SELECT * FROM rooms";
                                                        $result = mysqli_query($connect,$query);
                                                        while($row = mysqli_fetch_assoc($result)) {
                                                        ?>
                                                            <option value="<?php echo $row["id"] ?>"><?php echo $row["room_name"] ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                                    </select>
                                                    <span style="color:red"><?php if(in_array("room",$emptyArray)) echo "It's Required"?></span>
                                                </div>

                                                <div class="form-group">

                                                    <input type="text" name="Ext" id="Ext" placeholder="Ext"/>
                                                    <span style="color:red"> <?php if(in_array("ext",$emptyArray))echo " It's Required";?></span>

                                                </div>
                                                <div class="file-field">
                                                    <div class="btn btn-primary btn-sm float-left">
                                                        <input type="file" name="imgFile">
                                                        <span style="color:red"> <?php if(in_array("img",$emptyArray))echo " It's Required";?></span>
                                                    </div>
                                                </div>
                                                <div class="form-group form-button">
                                                    <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                                                    <input type="reset" name="reset" id="reset" class="form-submit" value="reset"/>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="signup-image">
                                            <figure><img src="../assets/Images/signup-image.jpg" alt="sing up image"></figure>
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
    <?php include "../includes/footer.php"?>
    </body>
    </html>
    <?php
}else{
    header("location:login.php");
}

?>