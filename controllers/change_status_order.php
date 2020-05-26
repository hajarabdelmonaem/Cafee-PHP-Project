<?php
include ('../database/connection.php');

$order_id=$_POST['order_id'];

$update_status_order="UPDATE orders SET state='done' Where id=$order_id";

$connect->query($update_status_order);

header("Location:../admin_1/index.php");


?>