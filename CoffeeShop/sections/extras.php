<section class="extra" id="extra">

    <h3 class="sub-heading" data-aos="fade-up"> <i class="fas fa-plus"></i> </h3>
    <h1 class="heading" data-aos="fade-up"> extra </h1>

<?php

// fetch from database the toppings categories
$query="SELECT * FROM toppingscategory";
$result=mysqli_query($conn,$query);

while($row=mysqli_fetch_assoc($result)){    ?>

    <div class="topping-box">

            <h3 class="topping-category">
                <i class="fas fa-cookie-bite" ></i>
                <?php echo $row["topping_category_name"] ?>
            </h3>

            <div class="topping-item-box">

                <?php

                // fetch all items in this category
                $query2="SELECT topping_name,topping_image,topping_price FROM toppings WHERE topping_category_id=?";
                $stmt2=mysqli_prepare($conn,$query2);
                mysqli_stmt_bind_param($stmt2,"i",$row['topping_category_id']);
                mysqli_stmt_execute($stmt2);
                $result2=mysqli_stmt_get_result($stmt2);
                
                while($row2 = mysqli_fetch_assoc($result2)){    

                    $topping_price=$row2["topping_price"]*$currency_price;                                    ?>

                    <div class="topping-item" data-aos="fade-right">
                        
                        <div class="topping-item-title">
                            <div class="image">
                                <img src="<?php echo $row2['topping_image'] ?>" alt="" />
                            </div>
                            <h3><?php echo $row2['topping_name'] ?></h3>
                        </div>
                        
                        <div class="topping-item-price">
                             <?php echo $topping_price ?><?php echo $currency_logo ?>
                        </div>
                    </div>

                <?php } ?>
            </div>  
    </div>

    <?php } ?>

</section>
