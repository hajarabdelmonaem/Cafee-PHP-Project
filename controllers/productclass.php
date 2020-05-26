<?php

class Product {

    private $product_name;
    private $product_price;
    private $product_img;
    private $category_id;
    public function set_product_name ($product_name)
    {
        $this->product_name=$product_name;
    }
    public function get_product_name()
    {
        return $this->product_name;
    }




    public function set_product_price ($product_price)
    {
        $this->product_price=$product_price;
    }
    public function get_product_price()
    {
        return $this->product_price;
    }

    public function set_product_img ($product_img)
    {
        $this->product_img=$product_img;
    }
    public function get_product_img()
    {
        return $this->product_img;
    }

    public function validate_products()
    {
        $emptyArray=[];
        if(empty($this->product_name))
            $emptyArray[]="productname";
        if(empty($this->product_price))
            $emptyArray[]="price";
        return count($emptyArray);
    }



    public function addItem()
    {
        $product_name=$_POST['product_name'];
        $product_price=$_POST['product_price'];
        $product_img=$_FILES['categoryImg']['name'];
        $category_id=$_POST['categorySelect'];
        $product_img_tmp=$_FILES['categoryImg']['tmp_name'];
//        $extention=$_FILES['categoryImg']['type'];
        print_r($_FILES);

        $conncet=mysqli_connect("localhost","root","","cafeedb");
        if($conncet)
        {
        $insert_res=mysqli_query($conncet,"insert into products (product_name,price,category_id,product_img,status) values('$product_name','$product_price','$category_id','$product_img',0)");

        if($insert_res)
        {
            move_uploaded_file($product_img_tmp,"../assets/Images/$product_img");
            echo "insert done";
            header("Location:../admin_1/products.php");
          
        }
        else
        {
            echo "insert failed";
        }
    
        }


    }


}


?>