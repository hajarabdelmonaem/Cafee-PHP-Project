<?php  
session_start();
include ('../database/connection.php');

$room_id= $_POST['room_id'];

$notes= $_POST['notes'];

$id_prods= $_POST['id_prodss'];

$id_prods=explode(",", $id_prods);

//print_r($id_prods);

$count_products= $_POST['count_productss'];

$count_products=explode(",", $count_products);


$date_order=date("Y-m-d");
$user_id = $_SESSION['id'];



//$insert_order="INSERT INTO orders SET user_id=$user_id , room_id=$room_id , notes='$notes' , date_order='$date_order',state='processing'";
$insert_order="INSERT INTO `orders`(`user_id`, `room_id`, `notes`, `date`, `state`) VALUES ($user_id,$room_id,'$notes','$date_order','processing')";
//$connect->query($insert_order);

print_r($connect->query($insert_order));
$last_id_order = $connect->insert_id;




for ($i=0; $i <count($id_prods) ; $i++) {

	$insert_orders_count="INSERT INTO orders_count SET order_id= $last_id_order , product_id=$id_prods[$i] ,amount=$count_products[$i]";

    $connect->query($insert_orders_count);
}









 ?>