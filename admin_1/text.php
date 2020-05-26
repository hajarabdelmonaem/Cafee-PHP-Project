<?php

include "../database/connection.php";
//$queryUser = "SELECT * FROM orders,users WHERE orders.user_id = users.id GROUP BY users.id";
//$resultUser = mysqli_query($connect,$queryUser);
//while($rowUser = mysqli_fetch_assoc($resultUser)) {
//    echo "<pre>";
////    print_r($rowUser);
//    echo "</pre><br>";
//    $user_id = $rowUser['id'];
//    $query = "SELECT * FROM orders,users,products,orders_count WHERE orders.user_id = $user_id AND products.id = orders_count.product_id AND orders.id = orders_count.order_id GROUP BY orders_count.id";
//    $result = mysqli_query($connect, $query);
//    $count = 0;
////    print_r($result);
//
////$row = mysqli_fetch_assoc($result);
//    while ($row = mysqli_fetch_assoc($result)) {
//        $count += $row['count'] * $row['price'];
//        echo "<pre>";
////        print_r($row);
////        echo($count);
//        echo "</pre><br>";
////    $user_id = $row["id"];
////    $queryOrders = "SELECT * FROM users,orders WHERE orders.user_id = 2";
////    $resultOrders = mysqli_query($connect,$queryOrders);
////////$count = 1;
////    print_r($resultOrders) ;
//////
////////$row = mysqli_fetch_assoc($result);
////    while($row = mysqli_fetch_assoc($resultOrders)) {
////        echo "<pre>";
////        print_r($row) ;
////        echo "</pre>";
////    }
//    }
//}
$result=mysqli_query($connect,"SELECT *
            from orders inner join users on users.id=orders.user_id
            INNER JOIN orders_count on orders_count.order_id = orders.id 
            INNER JOIN products on orders_count.product_id=products.id 
            where orders.user_id=2 GROUP BY orders.id");
while($rowOrders = mysqli_fetch_assoc($result)) {
    echo "<pre>";
    print_r($rowOrders);
    echo "</pre>";
}
?>

<?php
//$queryOrders = "SELECT * FROM users,orders,orders_count WHERE orders.user_id = 2 AND users.id = 2 AND orders.id = orders_count.order_id";
//$resultOrders = mysqli_query($connect,$queryOrders);
//while($rowOrders = mysqli_fetch_assoc($resultOrders)) {
//$order_id = $rowOrders['order_id'];
//?>
<!--<tr role="button" data-toggle="collapse" href="#order--><?php //echo $rowOrders['id'] ?><!--"-->
<!--    aria-expanded="false" aria-controls="demo1">-->
<!--    <td data-title="WO Ref">--><?php //echo $rowOrders['id'] ?><!--</td>-->
<!--    <td data-title="Reported">--><?php //echo $rowOrders['date'] ?><!--</td>-->
<!--    --><?php
//
//    $totalOrdersPrice = 0;
//    $queryAllOrdersPrice = "SELECT * FROM users,orders,orders_count,products WHERE orders.user_id = 2 AND users.id = 2 AND orders.id = 1 AND orders_count.order_id = 1 AND products.id = orders_count.product_id";
//    $resultAllOrdersPrice = mysqli_query($connect, $queryAllOrdersPrice);
//    while($rowAllOrdersPrice = mysqli_fetch_assoc($resultAllOrdersPrice)) {
//        $totalOrdersPrice += $rowAllOrdersPrice['count'] * $rowAllOrdersPrice['price'] ;
//    }
//    ?>
<!--    <td data-title="Type">--><?php //echo $totalOrdersPrice ?><!--</td>-->
<!--</tr>-->
<!--<br>-->
<?php ////}
//
//    foreach ($select_product_name as $product_name) {
//    echo "<pre>";
//
//                print_r($product_name);
//                echo "</pre>";
//    ?>
<!--    <div style="color:black" class="product_of_user mt-1 p-2">-->
<!--    <span class="product_name">--><?php //echo $product_name['product_name'] ?><!--</span>-->
<!--    <input class="num_product" disabled="" type="number" value="--><?php //$order['amount'] ?><!--">-->
<!---->
<!--}-->
<!--        ?>-->

