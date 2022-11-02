<!-- #################################################################################################
     this is the offers section:

     -> when the admin add an offer on an item:
            * item is removed from menu section and added to the offers section with the new price
     -> when the admin remove the offer on an item:
            * item is removed from offers section and added to the menu section with the old price
     #################################################################################################-->

<?php session_start(); ob_start();
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
    <title>Cart</title>
    

    <!-- font awesome css cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- bootstrap css file -->
    <link rel="stylesheet" href="./plugins/bootstrap-5.1.3/css/bootstrap.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/offer.css">
    <link rel="stylesheet" href="./css/toppings_modal.css">

</head>

<body>
  <?php include_once('./includes/db_connect.php'); ?> 

   <input type="hidden" id="currency_list" value="<?php echo $currency_logo; ?>" >

    <header>
        <a href="./index.php" class="logo"><i class="fas fa-utensils"></i>Coffee Shop.</a>

        <div class="icons">
            <a href="./wishlist.php" class="fas fa-heart"></a>
            <a href="./cart.php" class="fas fa-shopping-cart"></a>
        </div>
    </header>  
    
    <section class="offer" id="offer"> 
   
         <h1 align="center">
             <a href="index.php"><i class="fas fa-arrow-left"></i></a>Offers
         </h1>       
          

<?php
if(isset($_GET["section"])){
    if($_GET["section"] == 1){
        //  Select items in OFFER TABLE having max pourcentage
        $query="SELECT item_id,new_price,pourcentage FROM todayoffer WHERE pourcentage = (SELECT max(pourcentage) FROM offer)";
        $result=mysqli_query($conn,$query);
    }
    else if($_GET["section"] == 2){
        //  Select all items in OFFER TABLE not having max pourcentage
        $query="SELECT item_id,new_price,pourcentage FROM todayoffer WHERE pourcentage != (SELECT max(pourcentage) FROM offer)";
        $result=mysqli_query($conn,$query);
    }
} ?>
 
        <div class="box-container" >

    <?php

        while($row=mysqli_fetch_assoc($result)){

            // get all informations of the item from table 'MENUITEM'
            $query2="SELECT * FROM menuitem WHERE item_id= ".$row['item_id'];
            $result2=mysqli_query($conn,$query2);
            $row2=mysqli_fetch_assoc($result2);

            // if user changes the currency --> convert prices 
            // else --> $currency_price=1, the prices doesn't change.

            $old_p =  $row2["item_price"]*$currency_price;
            $new_p =  $row["new_price"]*$currency_price;
 
            ?>

            
                    <div class="box" id="box">

                        <!-- we added for each of the fields: product name, price, quantity, image and addToCart
                             a unique id (?_item_id) so that when we click addToCart we know which item is added in jquery 
                             because we are using a while loop to fetch all the items -->   

                        <!-- item image -->     
                        <div class="image">
                            <i class="fas fa-heart AddWishlist" id="<?php echo $row['item_id'] ?>" aria-hidden="true"></i>
                            <i class="fas fa-eye" aria-hidden="true"></i>

                            <img id="image_<?php echo $row2['item_id'] ?>" src="./<?php echo $row2["item_image"] ?>" alt="product image">
                        </div>

                        <div class="content">

                            <!-- item name -->
                            <h3  id="name_<?php echo $row2['item_id'] ?>" >
                                <?php echo $row2["item_name"] ?>
                            </h3>

                            <!-- item price -->
                            <div class="prices">
                                <span class="new_price">
                                    <?php echo $currency_logo ?> 
                                    <span id="price_<?php echo $row2['item_id'] ?>" >
                                        <?php echo $new_p ?>
                                    </span> 
                                </span>

                                <span class="old_price">
                                    <?php echo $currency_logo.$old_p ?>
                                    <span></span>
                                </span> 

                                <span class="pourcentage">
                                    -<?php echo $row["pourcentage"] ?>%
                                </span>
                                    
                            </div>

                            <!-- item description -->
                            <div class="description" id="description">
                                <div>
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i>
                                    <h3>Description</h3>
                                </div>
                                    
                                <p><?php echo $row2['item_description'] ?></p>
                            </div>

                            <!-- quantity buttons -->
                            <div class="qtybtns">
                                <div class="QTY" id="sus" ><i class="fas fa-minus"></i></div>
                                <span class="counter" id="quantity_<?php echo $row['item_id'] ?>" > 1 </span>
                                <div class="QTY" id="addq"><i class="fas fa-plus"></i></div>
                            </div> 

                            <!-- add to cart buttons -->
                            <button id="<?php echo $row2['item_id'] ?>" class="btn addItemToCart"><i class="fas fa-cart-plus"></i> Add To Cart</button>
                        </div>
                    </div>
    <?php  } ?>
        </div>

</section>

<!-- PopUp toppings modal section  -->
<?php include('./sections/toppings_modal.php'); ?> 


<!-- jquery js file  -->
<script src="./plugins/jquery-3.6.0/jquery.min.js"></script>

<!-- bootstrap js file-->
<script src="./plugins/bootstrap-5.1.3/js/bootstrap.min.js"></script>

<!-- sweetalert2 js file -->
<script src="./plugins/sweetalert2/sweetalert2.js"></script>
 
<script src="js/addToCart.js"></script>  
<script src="js/wishlist.js"></script>  
<script src="js/script.js"></script>


</body>
</html>
