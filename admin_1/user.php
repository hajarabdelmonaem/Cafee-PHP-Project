<?php
include('../database/connection.php');
// select product
$select_products = "SELECT * FROM products";
$result_products = $connect->query($select_products);
// select rooms
$select_rooms = "SELECT * FROM rooms";
$result_rooms = $connect->query($select_rooms);

?>

<!-- Start Header -->
<section class="content">
    <audio autoplay loop src="../assets/music/music.mp3"></audio>
    <div class="opacity"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4">
                <div class="left">
                    <form action="../controllers/add_order.php" method="post">
                        <p class="marker">Products</p>
                        <div class="users_product"></div>
                        <div class="Notes">
                            <p class="marker"> Notes</p>
                            <textarea style="width: 100%" id="notes" name="notes" rows="5" placeholder="Please Write Your Notes Here seperate Dash "></textarea>
                        </div>
                        <div class="Rooms border-bottom">
                            <p class="marker">Rooms</p>
                            <select id="room_id" name="room_id">
                                <?php foreach ($result_rooms as $rooms) { ?>
                                    <option value="<?php echo $rooms['id']; ?> ">
                                        Room <?php echo $rooms['room_name']; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="total_price">
                            <span>Total Price : </span>
                            <span class="total_price_target"> 0 </span>
                            <div class="text-center confirm ">
                                <input class="conf" type="submit" class="btn btn-success" value="Confirm">
                            </div>
                        </div>

                    </form>

                </div>
            </div>
            <div class="col-md-8">
                <div class="right text-center">
                    <div class="users_list">
                        <p class="marker">latest Oreders</p>

                    </div>
                    <div class="my_products text-center">
                        <div class="row product_result">

                            <?php foreach ($result_products as $products) { ?>
                                <div class="col-sm-3">
                                    <div class="product">

                                        <span class="price"
                                              style="z-index: 1"> <?php echo $products['price']; ?> Egp</span>


                                        <img product_id="<?php echo $products['id'] ?> "
                                             class="img_product" style="position: relative;"
                                             src="../assets/Images/<?php echo $products['product_img']; ?>">

                                        <img class="img_product"
                                             style="position: absolute;top: 0;left: 25%; z-index: -1"
                                             src="../assets/Images/<?php echo $products['product_img']; ?>">

                                        <p class="mr-4 product_name"><?php echo $products['product_name']; ?></p>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- End Header -->



<!--  start loadin screen -->
<!--<div class="bg"></div>-->
<!---->
<!--<a href="http://anetwork.ir" class="anetwork"></a>-->
<!--<div class="text"><a>Welcome to Star Bucks!</a></div>-->
<!---->
<!--<div class="finish">Smile Please</div>-->


