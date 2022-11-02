<?php session_start();

//  #####################################################################################################
//  after the client filled his billing info and click on button place order. 
//  jquery will send the request to this php script 
//  and save all the informations given into database
//  #####################################################################################################


include('../includes/db_connect.php');


if (isset($_POST["action"])) 
{
    if($_POST["action"]=="place_order"){

        // customer info
        $customer_first_name = trim($_POST['customer_first_name']);
        $customer_last_name = trim($_POST['customer_last_name']);

        $customer_name = $customer_first_name." ".$customer_last_name;
        $customer_email = trim($_POST['email_address']);
        $customer_number = trim($_POST['mobile_number']);
        $customer_address = trim($_POST['customer_address']);
        $customer_city = trim($_POST['customer_city']);
        $customer_zip = trim($_POST['customer_zip']);
        $customer_state = trim($_POST['customer_state']);
        $customer_country = trim($_POST['customer_country']);


        $order_total = trim($_SESSION["shopping_cart_total"]);
        $order_date =  date('j')."-".date('n')."-".date('Y');


        // Insert order informations into table ORDERINFO
        $query = "INSERT INTO orderinfo(`customer_name`, `customer_email`,`customer_phone`, `customer_address`,`customer_city`, `customer_zip`, `customer_state`, `customer_country`, `order_total`,`order_currency`, `order_date`) 
                  VALUES ('$customer_name','$customer_email','$customer_number','$customer_address','$customer_city','$customer_zip','$customer_state','$customer_country',$order_total,\" ".$_SESSION['currency']['logo']." \",'$order_date')";

        if(mysqli_query($conn,$query))
            echo "Successfully Submitted"; //send response to ajax 
        else
            echo mysqli_error($conn);


        $order_id = mysqli_insert_id($conn); // get the last inserted id


        // foreach item in the cart
        foreach($_SESSION["shopping_cart"] as $keys => $values){

            $item_name = trim($values["product_name"]);
            $item_quantity = trim($values["product_quantity"]);
            $toppings_price = trim($values["toppings_price"]);
            $item_total = trim($values["product_total"]);

            // Insert item informations into table ORDER-ITEMS
            $query = " INSERT INTO order_items (`order_id`, `item_name`, `item_quantity`,`toppings_price`, `item_total`) VALUES ('$order_id','$item_name', '$item_quantity', '$toppings_price', '$item_total')";

            if (mysqli_query($conn, $query))
                echo "Successfully Submitted"; //send response to ajax 
            else
                echo mysqli_error($conn);

        
            $order_item_id = mysqli_insert_id($conn); // get the last inserted id


            // for keeping track of the extra toppings in each item we have the table "extra_toppings"
            foreach($values["product_toppings"] as $elm){

               

                // Insert the informations into table extra_toppings
                $query = " INSERT INTO extra_toppings (`order_item_id`, `topping_name`) VALUES ('$order_item_id', '$elm')";

                if (mysqli_query($conn, $query))
                    echo "Successfully Submitted"; //send response to ajax 
                else
                    echo mysqli_error($conn);       
            }
        }

        //clear the cart
        unset($_SESSION["shopping_cart"]);
        unset($_SESSION["cart_page"]);
        unset($_SESSION["shopping_cart_total"]);
        unset($_SESSION["shipping"]);

    }

}



?>
