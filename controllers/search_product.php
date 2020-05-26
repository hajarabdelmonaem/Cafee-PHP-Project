<?php

include '../database/connection.php';

$key_search = $_POST['key_search'];

$select_product = "SELECT * FROM products WHERE product_name LIKE '%" . $key_search . "%'";
$result_product = $connect->query($select_product);
$count_product = $result_product->num_rows;

if ($count_product > 0) {
    foreach ($result_product as $product) {
        ?>
        <div class="col-sm-3">
            <div class="product">
                <span class="price"><?php echo $product['price'] ?> egp</span>
                <img product_id="<?php echo $product['id'] ?>" class="img_product" src="../assets/Images/<?php echo $product['product_img'] ?>">
                <img class="img_product" style="position: absolute;top: 0;left: 25%; z-index: -1" src="../assets/Images/<?php echo $product['product_img'] ?>">
                <p class="mr-4 product_name"><?php echo $product['product_name'] ?></p>
            </div>
        </div>
        <?php
    }
} else {
    echo "<p >No products found<p>";
}

