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
    <title>Cart</title>

    <!-- font awesome css cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- bootstrap css file -->
    <link rel="stylesheet" href="./plugins/bootstrap-5.1.3/css/bootstrap.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/cart.css">

</head>

<body>
  <?php include_once('./includes/db_connect.php'); ?> 
  
    <header>

        <a href="./index.php" class="logo"><i class="fas fa-utensils"></i>Coffee Shop.</a>

        <div class="icons">
            <a href="./wishlist.php" class="fas fa-heart"></a>
            <a href="#" class="fas fa-shopping-cart"></a>
        </div>

    </header>  

    

<?php

    // if we don't have empty cart
    if(!empty($_SESSION["shopping_cart"])){       
        
    $_SESSION["cart_page"]="not empty"; ?>


    <div class="cart">

        <h3>
            <a href="index.php"><i class="fas fa-arrow-left"></i></a>
            Cart(<?php echo count($_SESSION["shopping_cart"]) ?>)
        </h3>

        <div class="table-responsive" id="order_table">
            <table class="table table-bordered table-stripped">
                <tr>
                    <th width="25%">Product Name</th>
                    <th width="25%">Toppings</th>        
                    <th width="10%">Price</th>           
                    <th width="10%">Quantity</th>                
                    <th width="10%">Extra</th>
                    <th width="10%">Total</th>
                    <th width="10%">
                        <button class="btn2 btn-default btn-xs clear"> Clear </button>
                    </th>
                   
                </tr>

                <?php 
                   
                        $total=0;               
                        
                        // we loop the ShoppingCart to display the items
                        foreach($_SESSION["shopping_cart"] as $keys => $values){ 
                            $toppings_price=0 ?>
                           
                           

                            <tr>
                                <td class="product_list">
                                    <div class="ImageAndName">
                                        <div class="image">
                                            <img src="<?php echo $values['product_image'] ?>">
                                        </div>

                                        <?php echo $values["product_name"] ?>
                                    </div>
                                </td>

                                <td class="toppings_list">
                                <?php

                                    // if client didn't select any toppings
                                    if( $values['product_toppings'] == '') 
                                        echo "No Toppings Selected";
                                    else{
                                   
                                        // loop the toppings list and fetch the toppings image and price.
                                        for($i=0; $i< count($values['product_toppings']); $i++){
      
                                            $query = "SELECT topping_image,topping_price FROM toppings WHERE topping_name=?";
                                            $stmt = mysqli_prepare($conn,$query);
                                            mysqli_stmt_bind_param($stmt,"s",$values['product_toppings'][$i]);
                                            mysqli_stmt_execute($stmt);
                                            $result = mysqli_stmt_get_result($stmt);
                                            $row = mysqli_fetch_assoc($result);   ?>

                                            <div class="image">
                                                <img src="<?php echo $row['topping_image'] ?>">
                                            </div>

                                        <?php   

                                            // calculate the total price of all toppings added in shopping cart for quantity=1  
                                            $toppings_price += floatval($row['topping_price'])*$currency_price;
                                    
                                            }
                                    } 

                                    // calculate the total price of all toppings added in shopping cart for quantity>1  
                                    if($values["product_quantity"] > 1){
                                        $toppings_price *= intval($values["product_quantity"]);
                                    }
                                    

                                    // save the price of all toppings added in shopping cart  
                                    $_SESSION["shopping_cart"][$keys]['toppings_price']=$toppings_price;      

                                    // total item price (price*qty + extra) 
                                    $total_item_price= intval($values["product_quantity"])*floatval($values["product_price"])+$toppings_price;

                                    // save the total of each item in shopping cart
                                    $_SESSION["shopping_cart"][$keys]['product_total']=$total_item_price;
                                            
                                ?>

                                </td>

                                <td><?php echo $currency_logo." ".$values["product_price"] ?></td>

                                <td><?php echo $values["product_quantity"] ?></td>
                                
                                <td><?php echo $currency_logo." ".$toppings_price ?></td>

                                <td style="color: var(--green)"><b><?php echo $currency_logo." ".$total_item_price ?> </b></td>

                                <td>
                                <!-- we put the id of the delete button equal to the id of the item 
                                     so in jquery, when we click this button we know which item to remove                      -->
                                    <button class="delete" id="<?php echo $values['product_id'] ?>"> <i class="fas fa-trash"></i> </button>
                                </td>
                            </tr>

                        <?php    
                                
                            // total price of all items in cart
                            $total += $total_item_price;  
                        } 
                                
                        // save the total into new session
                        $_SESSION["shopping_cart_total"]=$total;
                                
                        ?>

                            <tr>
                                <td colspan="5" align="right"><b>Total</b></td>
                                <td style="color: var(--green)"><b> <?php echo $currency_logo." ".$total ?> </b></td>    
                            </tr>

            </table>  
        </div>   
      
        <div class="place_order">
            <button class="btn" id="check_out">Checkout</button>
        </div>

    </div>   

    <?php }
                    
    else{ unset($_SESSION["cart_page"]); ?>
        
        <!-- if the cart is empty -->
        <div class="empty_cart">
            <i class="fas fa-shopping-bag"></i>
            <h1>
                <a href="index.php"><i class="fas fa-arrow-left"></i></a>Your Cart is Empty!
            </h1>
        </div>

    <?php } ?>


<!-- jquery js file  -->
 <script src="./plugins/jquery-3.6.0/jquery.min.js"></script>

<!-- bootstrap js file-->
<script src="./plugins/bootstrap-5.1.3/js/bootstrap.min.js"></script>

<!-- sweetalert2 js file-->
<script src="./plugins/sweetalert2/sweetalert2.js""></script>

<!-- custom js file-->
<script src="js/checkout.js"></script>
<script src="js/addToCart.js"></script>

</body>

</html>
