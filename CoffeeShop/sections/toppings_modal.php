<!--##################################################################################### 
        when the client click on addToCart button
        a popup modal appears -> let the client choose his favorites toppings
    ##################################################################################### -->

<div id="addToCart_modal" class="modal fade" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">

            <!-- modal title -->
            <div class="modal-header">
                <h3 class="modal-title" id="ITEM_NAME"></h3>
	      	</div>

            <!--  modal body -->
	      	<div class="modal-body">   

	        	<div class="items">
                    <div class="items_info">
                        <div class="image">
                            <img id="ITEM_IMAGE" src="">
                        </div>

                        <h3 id="ITEM_QUANTITY"></h3>
                    </div>


                    <div>
                        <h3 id="TOPPINGS">Choose your Toppings (optional):</h3>

                        <?php

                        // fetch from database the toppings categories
                        $query="SELECT * FROM toppingscategory";
                        $result=mysqli_query($conn,$query);

                        while($row=mysqli_fetch_assoc($result)){    ?>


                        <div class="ToppingsBox">
                            <h3><?php echo $row["topping_category_name"] ?></h3>
                            
                            <div class="ToppingsChoices">
                                <?php

                                // fetch all items in this category
                                $query2="SELECT topping_name,topping_image,topping_price FROM toppings WHERE topping_category_id=?";
                                $stmt2=mysqli_prepare($conn,$query2);
                                mysqli_stmt_bind_param($stmt2,"i",$row['topping_category_id']);
                                mysqli_stmt_execute($stmt2);
                                $result2=mysqli_stmt_get_result($stmt2);
                                
                                while($row2 = mysqli_fetch_assoc($result2)){    ?>
                        
                                    <div class="topping_item">
                                        <!-- checkboxes -->
                                        <label class="container2">
                                            <input type="checkbox" class="checkitem" value="<?php echo $row2['topping_name'] ?>">
                                            <div class="checkmark"></div>        
                                        </label> 
                                        <?php echo $row2['topping_name'] ?>
                                    </div>
                        
                                <?php } ?>
                            </div>   
                        </div>
                        <?php } ?>
                    </div>   
                </div>

	        	<div class="modal-footer">
                    <button type="button" class="btn-secondary" id="btn-close" data-dismiss="modal">Close</button>
                    <button type="button" class="btn-primary" id="btn-addToCart" > <i class="fas fa-cart-plus"></i> Cart</button>
                </div>
	      	</div>
    	</div>
  	</div>
</div>