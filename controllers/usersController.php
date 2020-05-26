<?php
include "../database/connection.php";
session_start();
if (isset($_POST['login'])) {
    if($_POST['email'] == "mohamedelnagar461@yahoo.com" && $_POST['password'] == "123456"){
        $_SESSION['username'] = "Mohamed Elnagar";
        $_SESSION['email'] = "mohamedelnagar461@yahoo.com";
        $_SESSION['status'] = "admin";
        header("Location:../admin_1/index.php");
    } else{
        $pdo = new PDO("mysql:host=localhost;dbname=cafeedb", "root", "");
        if ($pdo) {
            $password = md5($_POST["password"]);
            $stm = $pdo->query("select * from users where email='{$_POST['email']}' and password='{$password}'");
            if ($stm) {
                $result = $stm->fetchAll(PDO::FETCH_ASSOC);
                if ($result) {
                    $_SESSION['username'] = $result[0]["user_name"];
                    $_SESSION['email'] = $result[0]["email"];
                    $_SESSION['id'] = $result[0]["id"];
                    $_SESSION['status'] = "user";
                    header("Location:../admin_1/index.php");
                    echo "welecome user";
                }
                if (!$result) {
                    header("Location:../admin_1/login.php");
                    echo "errrorrrrr";
                }
            }
        }
    }
}

if (isset($_POST["saveEdit"])) {
    $target_dir = "../assets/Images/";
    $target_file = $target_dir . basename($_FILES["user_img"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $id = $_POST["id"];
    $user_name = $_POST["user_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $ext = $_POST["ext"];
    $room_id = $_POST["room_id"];
    if($_FILES["user_img"]["tmp_name"] !== ""){
        $temp = explode(".", $_FILES["user_img"]["name"]);
        $newfilename = 'image_'.time().'.' . end($temp);
        if (move_uploaded_file($_FILES["user_img"]["tmp_name"], $target_dir.$newfilename)) {
            echo "The file " . basename($_FILES["user_img"]["name"]) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        $query = "UPDATE users SET user_name = '$user_name',email = '$email', password = '$password',ext = '$ext',room_id = $room_id,user_img = '$newfilename' WHERE id = $id";
        $result= mysqli_query($connect,$query);
        if($result){
            header("location:../admin_1/users.php");
        }else{
            echo "false";
        }
    }else{
        $query = "UPDATE users SET user_name = '$user_name',email = '$email', password = '$password',ext = '$ext',room_id = $room_id WHERE id = $id";
        $result= mysqli_query($connect,$query);
        if($result){
            header("location:../admin_1/users.php");
        }else{
            echo "false";
        }
    }
}

if(isset($_POST['deleteUser'])){
    $user_id = $_POST["id"];
    $query = "DELETE FROM users WHERE id = $user_id";
    $result= mysqli_query($connect,$query);
    if($result){
        echo "true";
    }else{
        echo "false";
    }
}