<?php session_start();

//  #####################################################################################################
//  after the client chose the item and the toppings -> data will be sent to this PHP script. 
//  We'll write all the actions like add, remove, clear items from cart, checkout etc..
//  we will store the cart items in SESSIONS to be used across multiple pages
//  So, when page has refreshed shopping cart details will not be lost 
//  and we can easily fetch shopping cart details from $_SESSION variable.
//  #####################################################################################################


if (isset($_POST['action'])) {

    // Add products into the cart
    if ($_POST["action"] == "add") {

        // if there is already items in the cart
        if (isset($_SESSION['shopping_cart'])) {

            $is_available = 0;

            // if we added the same product into shopping cart having the same toppings-> we increase the quantity
            foreach ($_SESSION["shopping_cart"] as $keys => $values) {

                if($values['product_id'] == $_POST['pid']) {
                    if($values['product_toppings'] == $_POST['toppings']){
                        $is_available = 1;
                        $_SESSION["shopping_cart"][$keys]['product_quantity'] += $_POST['pqty'];
                    }
                }
            }
                   

            // if we didn't add the same product into shopping cart
            if ($is_available == 0) {

                $item_array = array(
                    'product_id' => $_POST['pid'],
                    'product_name' => $_POST['pname'],
                    'product_image' => $_POST['pimage'],
                    'product_price' => $_POST['pprice'],
                    'currency_price' => $_SESSION["currency"]["price"],
                    'product_quantity' => $_POST['pqty'],
                    'product_toppings' => $_POST['toppings']
                );

                // Associative array: $key -> 0 - $values -> item_array[] , $key -> 1 - $values -> item_array[] ...
                $_SESSION["shopping_cart"][] = $item_array;
            }

        }
        else {

            // if this is the first item -> store it inside shopping_cart session
            $item_array = array(
                'product_id' => $_POST['pid'],
                'product_name' => $_POST['pname'],
                'product_image' => $_POST['pimage'],
                'product_price' => $_POST['pprice'],
                'currency_price' => $_SESSION["currency"]["price"],
                'product_quantity' => $_POST['pqty'],
                'product_toppings' => $_POST['toppings']
            );

            // Associative array: $key -> 0 - $values -> item_array[] , $key -> 1 - $values -> item_array[] ...
            $_SESSION["shopping_cart"][] = $item_array; // array of associative arrays

        }
    }



    // remove product from cart
    if ($_POST["action"] == "remove") {

        // we loop the shopping cart to find the item to delete
        foreach ($_SESSION["shopping_cart"] as $keys => $values) {
            if ($values["product_id"] == $_POST["product_id"]) {

                // remove particular element from session
                unset($_SESSION["shopping_cart"][$keys]);
            }
        }
    }


    // clear products from cart
    if ($_POST["action"] == "clear") {

        // we loop the shopping cart to delete all items
        foreach ($_SESSION["shopping_cart"] as $keys => $values) 
                unset($_SESSION["shopping_cart"][$keys]);
             
    }

}

?>