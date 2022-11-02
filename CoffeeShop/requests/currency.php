<?php  session_start();

include('../includes/db_connect.php');


if(isset($_POST["action"])){
    if($_POST["action"] == "check currency"){

        $_SESSION["currency"]["logo"]= $_POST["currency_logo"];

        // get the currency price assigned to the chosen currency logo
        if($_POST["currency_logo"] == "$")
            $new_currency_price = $_SESSION["currency"]["price"]=1;
        else{

            // Select the currency price from table 'Currency'
            $query = "SELECT convert_price FROM currency WHERE to_currency=?";         
            $stmt=mysqli_prepare($conn,$query);
            mysqli_stmt_bind_param($stmt,"s",$_POST["currency_logo"]);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
           
            if($result)
                $row = mysqli_fetch_assoc($result);

            $new_currency_price = $_SESSION["currency"]["price"] = $row["convert_price"];
        }

  
        // ################################################################
        // When we change the currency --> change prices inside wishlist
        // we will change the price values inside the cookie wishlist...
        // ################################################################

        if(isset($_COOKIE['Wishlist'])){

            // remove backslashes added when converting to json string
            $cookie_data = stripcslashes($_COOKIE['Wishlist']);
            
            
            // convert from json string to associative array
            $wishlist_data = json_decode($cookie_data,true);
            
            foreach($wishlist_data as $key => &$values){
            
                // convert price to new currency
                $values['product_price'] = ($values['product_price']/$values['currency_price'])*$new_currency_price;
        
                // update currency price in cookie
                $values['currency_price'] = $new_currency_price;
        
            }
            
            // after changing all prices -> set cookie
            $cookie_data =json_encode($wishlist_data); 
            setcookie('Wishlist',$cookie_data,time()+(86400*30),'/');
    
        }

        // ################################################################
        // When we change the currency --> change prices inside shopping cart
        // we will change the price values inside the session shopping cart...
        // ################################################################

        if(isset($_SESSION["shopping_cart"])){

            foreach ($_SESSION["shopping_cart"] as $keys => &$values) { 
               
                // convert price to new currency
                $values['product_price'] = (floatval($values['product_price'])/$values['currency_price'])*$new_currency_price;
                echo $values['product_price'];
        
                // update currency price in session
                $values['currency_price'] = $new_currency_price;
            }
        }
    }
}

?>
