<?php
session_start();
session_destroy();
header("Location:../admin_1/login.php");
