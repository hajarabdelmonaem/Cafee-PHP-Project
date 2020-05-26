<?php
include('../database/connection.php');

$id_user = $_POST['id_user'];

// select note from table order

$select_product = "SELECT id ,room_id ,notes from orders where user_id =$id_user and state='processing'";
$result_product = $connect->query($select_product);
$room_id = $result_product->fetch_assoc();
$order_id = $room_id['id'];
$room_id_user = $room_id['room_id'];


// select from table order_count

$select_order = "SELECT product_id , amount from orders_count where order_id =$order_id";
$result_order = $connect->query($select_order);

// select from table product to get products name  

?>
<p class="marker">Products</p>
<form action="../controllers/change_status_order.php" method="post">
    <input hidden class="order_id" value="<?php echo $order_id ?>">
    <div class="users_product">
        <?php
        foreach ($result_order as $order) {
        $prducts_id = $order['product_id'];
        $select_product_name = "SELECT product_name, price from products where id =$prducts_id";
        $select_product_name = $connect->query($select_product_name);
        foreach ($select_product_name as $product_name) {
            echo '<div style="color:black" class="product_of_user mt-1 p-2" >
                    
                    <span class="product_name">' . $product_name['product_name'] . '</span>
                    <input class="num_product" disabled="" type="number" value="' . $order['amount'] . '">';


        }
        ?>
        <span class="product_price"><?php echo $product_name['price'] ?></span>
        <span class="cancel"> x </span>
    </div>
    <?php
    }
    ?>
    </div>
    <?php

    // select room from tables room
    $select_room = "SELECT room_name from rooms where id =$room_id_user";
    $result_room = $connect->query($select_room);
    $room_name = $result_room->fetch_assoc();
    $room_id['notes'];
    $notes = explode("-", $room_id['notes']);
    ?>
    <div class="Notes">
        <p class="marker"> Notes</p>
        <ol class="border p-4">
            <?php
            foreach ($notes as $note) {
                ?>
                <li><?php echo $note ?></li>
                <?php
            }
            ?>
        </ol>
    </div>
    <div class="Rooms border-bottom">
        <p class="marker">Rooms</p>
        <select disabled>
            <option><?php echo $room_name['room_name'] ?></option>
        </select>
    </div>
    <div class="total_price">
        <span>Total Price : </span>
        <span class="total_price_target">0 </span>
        <div class="text-center confirm ">
            <input type="submit" class="confirm_btn btn btn-success" value="Confirm">
        </div>
    </div>
</form>


