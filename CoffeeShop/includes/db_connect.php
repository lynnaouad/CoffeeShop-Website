<?php 
    $servername="localhost";
    $username="root";
    $password="";
    $database="coffeeshop";

    $conn = mysqli_connect($servername,$username,$password,$database);
    
    if(mysqli_connect_errno($conn))
       die("Connection failed!".mysqli_connect_error());
?>

