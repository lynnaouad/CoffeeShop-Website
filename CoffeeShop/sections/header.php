<!--################################################################################################# 
        when user selects the desired currency:
            -> send an ajax request to php script 'currency.php'.
            -> change the values of the $_SESSION["currency"]["logo"] and $_SESSION["currency"]["price"].
            -> refresh the page to get the changes.

    #################################################################################################-->

<header>
   <a href="#" class="logo"><i class="fas fa-utensils"></i>Coffee Shop.</a>

    <nav class="navbar">
        <a class="active" href="#home">home</a>
        <a href="#offers">offers</a>
        <a href="#about">about</a>
        <a href="#menu">menu</a>
        <a href="#extra">toppings</a>
        <a href="#review">reviews</a>
    </nav>

    <div class="icons">
      
    <?php

        if(isset($_SESSION["currency"])){

            $currency_logo = $_SESSION["currency"]["logo"];
            $currency_price = $_SESSION["currency"]["price"]; }

        else{
            
            // if the user didn't change the currency.
            // initial currency on our website is in $ (all prices are in $).

            $currency_logo = $_SESSION["currency"]["logo"]="$"; 
            $currency_price = $_SESSION["currency"]["price"]=1;
        }


            // All currencies are in the table "Currency".
            // we want to fill the SELECT options.

            $query="SELECT to_currency FROM currency";
            $result=mysqli_query($conn,$query);  ?>

            <select id="currency_list">
           
                <?php while($row=mysqli_fetch_assoc($result)){   
                    
                        if($currency_logo == $row['to_currency']){ ?>
                            <option value="<?php echo $row['to_currency'] ?>" selected> <?php echo $row['to_currency'] ?> </option>   <?php  }
                        else{   ?>
                            <option value="<?php echo $row['to_currency'] ?>" > <?php echo $row['to_currency'] ?> </option>   <?php  }

                } ?>  
            
            </select>
                

            <a href="./wishlist.php" class="fas fa-heart"></a>
            <a href="./cart.php" class="fas fa-shopping-cart"></a>
        
            <i class="fas fa-bars" id="menu-bars"></i>
    </div>

</header>





    
