<?php
include "../database/connection.php";
session_start();


if (isset($_POST["saveEdit"])) {
    $target_dir = "../assets/Images/";
    $target_file = $target_dir . basename($_FILES["product_img"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $id = $_POST["id"];
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $category_id = $_POST["category_id"];
    $status = $_POST["status"];
    if($_FILES["product_img"]["tmp_name"]){
        $temp = explode(".", $_FILES["product_img"]["name"]);
        $newfilename = 'image_'.time().'.' . end($temp);
        if (move_uploaded_file($_FILES["product_img"]["tmp_name"], $target_dir.$newfilename)) {
            echo "The file " . basename($_FILES["product_img"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        $query = "UPDATE products SET product_name = '$product_name',price = $price, category_id = $category_id,status = $status,product_img = '$newfilename' WHERE id = $id";
        $result= mysqli_query($connect,$query);
        if($result){
            header("location:../admin_1/products.php");
        }else{
            echo "false";
        }
    }else{
        $query = "UPDATE products SET product_name = '$product_name',price = $price, category_id = $category_id,status = $status WHERE id = $id";
        $result= mysqli_query($connect,$query);
        if($result){
            header("location:../admin_1/products.php");
        }else{
            echo "false";
        }
    }
}

if(isset($_POST['deleteProduct'])){
    $product_id = $_POST["id"];
    $query = "DELETE FROM products WHERE id = $product_id";
    $result= mysqli_query($connect,$query);
    if($result){
        echo "true";
    }else{
        echo "false";
    }
}

require_once 'productclass.php';
$product = new Product();
if(isset($_POST['signup']))
{
    //echo $product->validate_products();
    echo $product->validate_products();
    $product->set_product_name($_POST['product_name']);
    $product->get_product_name();
    $product->set_product_price($_POST['product_price']);
    $product->set_product_img($_FILES['categoryImg']['name']);
    if($product->validate_products()==0)
        $product-> addItem();

    else {
        header("Location:products.php");
    }

}
