<?php session_start();
  $currency_logo = $_SESSION["currency"]["logo"];
  $currency_price = $_SESSION["currency"]["price"];
?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1, maximum-scale=1">
    <title>Wishlist</title>

    <!-- font awesome css cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    

    <!-- bootstrap css file -->
    <link rel="stylesheet" href="./plugins/bootstrap-5.1.3/css/bootstrap.min.css">

    <!-- aos css file -->
    <link rel="stylesheet" href="./plugins/aos-2.3.4/css/aos.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/toppings_modal.css">
    <link rel="stylesheet" href="./css/wishlist.css">

</head>

<body>
   <?php include_once('./includes/db_connect.php'); ?> 

   <input type="hidden" id="currency_list" value="<?php echo $currency_logo; ?>" >
   <input type="hidden" id="wishlist_section" value="wishlist" >

    <header>
        <a href="./index.php" class="logo"><i class="fas fa-utensils"></i>Coffee Shop.</a>

        <div class="icons">
            <a href="#" class="fas fa-heart"></a>
            <a href="./cart.php" class="fas fa-shopping-cart"></a>
        </div>
    </header>  

    <?php

    // if wishlist not empty
    if(isset($_COOKIE['Wishlist'])){ ?>

    <section class="wishlist">

        <div class="products-container">

            <h3 class="title"><a href="./index.php"><i class="fas fa-arrow-left"></i></a> Wishlist</h3>

            <div class="box-container">

                <?php 
                     $cookie_data = stripcslashes($_COOKIE['Wishlist']);   
                     $wishlist_data =json_decode($cookie_data,true);    

                     foreach($wishlist_data as $keys => $values){ ?>

                        <div class="box">
                            <i class="fas fa-times" id="<?php echo $values['product_id'] ?>"></i>

                            <img src="<?php echo $values['product_image'] ?>" id="image_<?php echo $values['product_id'] ?>" alt="">

                            <div class="content">
                                <h3 id="name_<?php echo $values['product_id'] ?>"><?php echo $values['product_name'] ?></h3>
                               
                                <span> quantity : </span>
                                <input type="number" value="1" id="quantity_<?php echo $values['product_id'] ?>">
                                
                                <br>

                                <span> price : </span>
                                <span class="price"> 
                                    <?php echo $currency_logo; ?> 
                                    <span class="price" id="price_<?php echo $values['product_id']; ?>"> 
                                        <?php echo $values['product_price'] ?> 
                                    </span> 
                                </span>
                                <button class="btn addItemToCart"  id="<?php echo $values['product_id'] ?>"><i class="fas fa-cart-plus"></i> Add To Cart</button>
                            </div>  
                        </div>
                    <?php } ?>

                
            </div>
        </div>
    </section>

    <?php }
         
         else{ ?>

         <!-- if wishlist is empty -->

            <div class="empty_wishlist">
                <i class="fas fa-heart"></i>
                <h1>
                    <a href="index.php"><i class="fas fa-arrow-left"></i></a>Your Wishlist is Empty!
                </h1>
            </div>
    <?php } 
    
    
    // PopUp toppings modal section 
    include('./sections/toppings_modal.php');
    
    
    ?>


<!-- jquery js file  -->
<script src="./plugins/jquery-3.6.0/jquery.min.js"></script>

<!-- bootstrap js file-->
<script src="./plugins/bootstrap-5.1.3/js/bootstrap.min.js"></script>

<!-- sweetalert2 js file -->
<script src="./plugins/sweetalert2/sweetalert2.js"></script>

<!-- aos js file -->
<script src="./plugins/aos-2.3.4/js/aos.js"></script>

<script src="js/addToCart.js"></script>
<script src="js/wishlist.js"></script>

</body>
</html>