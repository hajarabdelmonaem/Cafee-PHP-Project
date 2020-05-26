<?php

//require_once("config.php");
include "../database/connection.php";
if (isset($_GET['_id'])) {
    $_id = $_GET['_id'];
    global $connect;
    $res = mysqli_query($connect, "delete from orders_count where orders_count.order_id={$_id}");
    $res = mysqli_query($connect, "delete from orders where orders.id={$_id}");
}


if ($res) {
    header("Location:../admin_1/user_order.php");

} else {

    echo "nooooo";
}


?>