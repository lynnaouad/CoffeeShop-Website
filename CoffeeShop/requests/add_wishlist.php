<?php session_start();

//  #####################################################################################################
//  after the client chose the item to add on wishlist -> data will be sent to this PHP script. 
//  We'll write all the actions like add, remove, clear items from wishlist, etc..
//  we will store the wishlist items in COOKIES so when we revisit the website the wishlist will not be cleared
//  and we can easily fetch wishlist details from $_COOKIE variable.
//  #####################################################################################################

if(isset($_POST['action'])){

    // Add products into wishlist
    if($_POST['action'] == "add wishlist"){

        $ppid= trim($_POST['pid']);

        $pname= trim($_POST['pname']);
        $pimage= trim($_POST['pimage']);
        $pprice= trim($_POST['pprice']);

        $is_available=0;

        // if wishlist not empty
        if(isset($_COOKIE['Wishlist'])){

            // remove backslashes added when converting to json string
            $cookie_data = stripcslashes($_COOKIE['Wishlist']);

            // convert from json string to associative array
            $wishlist_data = json_decode($cookie_data,true);    
            
            // if item already in wishlist --> get list of product_id added into wishlist and check
            // array_column --> returns an array of values having $key = product_id
            $product_id_list = array_column($wishlist_data,'product_id');  

            if(in_array($ppid,$product_id_list)){
                echo "Item already in wishlist!";
                $is_available = 1;
            } 

        }
   
        // if item not available in wishlist
        if($is_available == 0){    
            $item_array = array(
                'product_id' => $ppid,
                'product_name' => $pname,
                'product_image' => $pimage,
                'product_price' => $pprice,
                'currency_price' => $_SESSION["currency"]["price"]
            );
    
            // Associative array: $key -> 0 - $values -> item_array[] , $key -> 1 - $values -> item_array[] ...
            $wishlist_data[] = $item_array;  

            // to save associative array inside a cookie we need to convert into json string
            $cookie_data =json_encode($wishlist_data);
    
            setcookie('Wishlist',$cookie_data,time()+(86400*30),'/');  //expire after 30 days

            echo "Item added to wishlist!";  
        }
    }


    // remove item from wishlist
    if($_POST['action'] == "remove wishlist"){
        $ppid= trim($_POST['product_id']);

        $cookie_data = stripcslashes($_COOKIE['Wishlist']);   
        $wishlist_data =json_decode($cookie_data,true);  

        // if it's the last item in wishlist
        if( count($wishlist_data) == 1 ){
            setcookie('Wishlist','',time()-3600,'/');
        }
        else{

        foreach($wishlist_data as $keys => $values){
            if($values["product_id"]==$ppid){
                unset($wishlist_data[$keys]);
                $cookie_data = json_encode($wishlist_data);  
                setcookie('Wishlist',$cookie_data,time()+(86400*30),'/'); 
                break;         
            }
        }
        }
    }
}

?>
