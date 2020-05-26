<?php
include('../database/connection.php');
$select_users = "SELECT user_id FROM orders where state ='processing'";
$result_users = $connect->query($select_users);
// select product
$select_products = "SELECT * FROM products";
$result_products = $connect->query($select_products);
?>
<section class="content">
    <audio autoplay loop src="../assets/music/music.mp3"></audio>
    <div class="opacity"></div>
    <div class="col-md-4">
        <div class="left">
            <p class="marker">Products</p>
            <div class="users_product"></div>
            <div class="Notes">
                <p class="marker"> Notes</p>
            </div>
            <div class="Rooms border-bottom">
                <p class="marker">Rooms</p>
                <select>
                    <option>none</option>
                </select>
            </div>
            <div class="total_price">
                <span>Total Price : </span>
                <span>0 </span>
                <div class="text-center confirm ">
                    <input type="submit" class="btn btn-success" value="Confirm">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="right text-center">
            <div class="users_list">
                <p class="marker">All users</p>
                <div>
                    <select id="users_select">
                        <option>Select User</option>
                        <?php
                        foreach ($result_users as $users) {
                            $user_id = $users['user_id'];
                            $select_user_name = "SELECT user_name FROM users where id = $user_id";
                            $result_user_name = $connect->query($select_user_name);
                            ?>
                            <option value="<?php echo $user_id ?>">
                                <?php
                                foreach ($result_user_name as $user_name) {
                                    echo $user_name['user_name'];
                                }
                                ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="my_products text-center">
                <div class="row">
                    <?php foreach ($result_products as $products) { ?>
                        <div class="col-sm-3">
                            <div class="product">
                                <span class="price"> <?php echo $products['price']; ?> Egp</span>
                                <img product_id="<?php echo $products['id'] ?>" class="img_product"
                                     src="../assets/Images/<?php echo $products['product_img']; ?>">
                                <img class="img_product" style="position: absolute;top: 0;left: 25%; z-index: -1"
                                     src="../assets/Images/<?php echo $products['product_img']; ?>">
                                <p class="mr-4 product_name"><?php echo $products['product_name']; ?></p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!--    <div class="bg"></div>-->
<!--    <a href="http://anetwork.ir" class="anetwork"></a>-->
<!--    <div class="text"><a>Welcome to Star Bucks!</a></div>-->
<!--    <div class="finish">Smile Please</div>-->
<!-- END CONTAINER -->
