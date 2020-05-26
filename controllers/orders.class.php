<?php
    class orders{

        private $order_state;

        public function ordersFun($user_id){
            global $connect;
            $query = "SELECT * FROM users,orders_count,products,orders WHERE users.id = orders.user_id AND orders_count.order_id = orders.id AND orders_count.product_id = products.id AND orders.user_id=$user_id GROUP BY orders.id";
            $result=mysqli_query($connect,$query);
            return $result;
            }
    }
?>