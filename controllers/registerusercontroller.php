<?php

$emptyArray = [];

echo "<pre>";
print_r($_POST);
echo "</pre>";

if (isset($_POST['signup'])) {
    $connect = mysqli_connect("localhost", "root", "", "cafeedb");


    if ($connect) {

        $username = $_POST['name'];
        $email = $_POST['email'];
        $password = md5($_POST['pass']);
        $confirm_pass = md5($_POST['re_pass']);
        $roomNumber = $_POST['number'];
        $imgName = $_FILES['imgFile']['name'];
        $ptmpname = $_FILES['imgFile']["tmp_name"];
        $ext = $_POST['Ext'];


        if (empty($username))
            $emptyArray[] = "username";
        if (empty($email))
            $emptyArray[] = "email";
        if (empty($password))
            $emptyArray[] = "password";
        if ($password !== $confirm_pass)
            $emptyArray[] = "repeat_password";

        if (empty($roomNumber))
            $emptyArray[] = "room";
        if (empty($imgName))
            $emptyArray[] = "img";
        if (empty($ext))
            $emptyArray[] = "ext";

        if (count($emptyArray) > 0) {
            header("Location:../admin_1/addUser.php?error=" . implode(",", $emptyArray));
        } else {
            $insert_res = mysqli_query($connect, "insert into users(user_name,email,password,room_id,user_img,ext) values('$username','$email','$password','$roomNumber','$imgName','$ext')");
            if ($insert_res) {
                move_uploaded_file($ptmpname, "../assets/Images/$imgName");
                header("Location:../admin_1/users.php");
            } else {
                echo "not Done";
            }
        }

    }
}

if (isset($_POST['reset'])) {
    header("Location:../admin_1/addUser.php");
}