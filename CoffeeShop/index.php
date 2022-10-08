<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1">
    <title></title>

    <!-- swiper css file -->
    <link rel="stylesheet" href="./plugins/swiper-8.0.7/css/swiper.min.css">

    <!-- font awesome css cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- bootstrap css file -->
    <link rel="stylesheet" href="./plugins/bootstrap-5.1.3/css/bootstrap.min.css">

    <!-- aos css file -->
    <link rel="stylesheet" href="./plugins/aos-2.3.4/css/aos.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./css/offer.css">
    <link rel="stylesheet" href="./css/about.css">
    <link rel="stylesheet" href="./css/menu.css">
    <link rel="stylesheet" href="./css/toppings_modal.css">
    <link rel="stylesheet" href="./css/extra.css">
    <link rel="stylesheet" href="./css/review.css">
    <link rel="stylesheet" href="./css/order.css">

   
</head>
<body>

<!-- ######################################################################################
     we divided the index file into several php files, to organize and simplify the code.
     all the php files are under the FOLDER: 'sections'.

     we used jquery for:
        - adding data to cart.
        - adding reviews.
        - placing orders.
        - changing the currency.

     all the jquery files are under the FOLDER: 'js'

     all requests are sent to php scripts -> under FOLDER: 'scripts'.
     ###################################################################################### -->


<!-- Database connection -->
<?php include_once('./includes/db_connect.php'); ?>    

    
<!-- header section -->
<?php include('./sections/header.php'); ?> 


<!-- home section  -->
<?php include('./sections/home.php'); ?> 


<!-- offers section  -->
<?php include('./sections/offer.php'); ?> 


<!-- about section  -->
<?php include('./sections/about.php'); ?> 


<!-- menu section  -->
<?php include('./sections/menu.php'); ?> 


<!-- PopUp toppings modal section  -->
<?php include('./sections/toppings_modal.php'); ?> 


<!-- extras section  -->
<?php include('./sections/extras.php'); ?> 


<!-- review section  -->
<?php include('./sections/review.php'); ?> 


<!-- footer section  -->
<?php include('./sections/footer.php'); ?> 



<!-- loader part  -->
<div class="loader-container">
    <img src="images/loader.gif" alt="">
</div>


<!-- jquery js file  -->
<script src="./plugins/jquery-3.6.0/jquery.min.js"></script>

<!-- bootstrap js file-->
<script src="./plugins/bootstrap-5.1.3/js/bootstrap.min.js"></script>

<!-- swiper js file -->
<script src="./plugins/swiper-8.0.7/js/swiper.min.js"></script>

<!-- aos js file -->
<script src="./plugins/aos-2.3.4/js/aos.js"></script>

<!-- sweetalert2 js file -->
<script src="./plugins/sweetalert2/sweetalert2.js"></script>
 
    
<script src="js/script.js"></script>
<script src="js/currency.js"></script>
<script src="js/addToCart.js"></script>
<script src="js/wishlist.js"></script>
<script src="js/reviews.js"></script>

</body>
</html>