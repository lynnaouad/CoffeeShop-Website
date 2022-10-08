<?php session_start();

unset($_SESSION['admin_id']);
unset($_SESSION['manager_id']);
unset($_SESSION['admin_username']);
unset($_SESSION['admin_image']);
unset($_SESSION['manager_username']);
unset($_SESSION['manager_image']);

header("location:index.php");
exit();



?>