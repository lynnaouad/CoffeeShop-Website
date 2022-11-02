<section class="menu" id="menu">
    <h3 class="sub-heading" data-aos="fade-up"> our menu </h3>
    <h1 class="heading" data-aos="fade-up"> today's speciality </h1>
  
    <div class="menu-tabs" data-aos="fade-up">
<?php 

//fetch list of menues from database 
$query="SELECT * FROM menu";
$result=mysqli_query($conn,$query);

if($result){
    while($row = mysqli_fetch_assoc($result)){ 
?>
        
    <!-- apply class show on the first menu -->
    <!-- set data-target=#name_of_menu so later we can target the items having the id=#menu_name  -->
    <div class="tabs">
        <img src="./images/menu/<?php echo $row['menu_logo'] ?>" alt="">
       
        <button  type="button" class="menu-tab-item <?php if($row['menu_id'] == 1){echo 'show';} ?>" 
                              data-target="#<?php echo $row['menu_name'] ?>">
                <?php echo $row['menu_name'] ?>
        </button>
    </div>

<?php }} ?> 

    </div>   

<!---------------------------------------------------------------------------------------------->

    <div class="box-container">

<?php 

// Select all items in all menues
// we want to check first if the item have an offer
// then we don't display it in the menu section, we display it in the offer section 

$query="SELECT m1.item_id,item_name,item_price,item_image,item_description,m1.menu_id,menu_name 
        FROM menuitem m1,menu m2
        WHERE m1.menu_id=m2.menu_id AND item_id NOT IN (SELECT item_id FROM todayoffer)";

$result=mysqli_query($conn,$query);

if($result){
    while($row = mysqli_fetch_assoc($result)){ 

        // convert price to the selected currency
        $price =  $row["item_price"]*$currency_price;
?>

        <!-- all items in the beginning are hidden -->
        <!-- if the item is in menu1 -> apply class show -->
        <!-- set id = #menu_name to target them in js-->

        <div class="box menu-tab-content <?php if($row['menu_id'] == 1){echo 'show';} ?>" data-aos="fade-up"  id="<?php  echo $row['menu_name']; ?>" >

            <!-- we added to each of the product name, price, quantity, image fields and addToCart button a unique id so that
                 when we click addToCart we know which item in jquery-->    

            <!-- item image -->
            <div class="image">
                <i class="fas fa-heart AddWishlist" id="<?php echo $row['item_id'] ?>" aria-hidden="true"></i>
                <i class="fas fa-eye" aria-hidden="true"></i>

                <img id="image_<?php echo $row['item_id'] ?>" src="./<?php echo $row['item_image'] ?>" alt="">
            </div>

            
            <div class="content">

                <!-- item name -->
                <h3 id="name_<?php echo $row['item_id'] ?>">
                    <?php echo $row['item_name'] ?>
                </h3>

                <!-- Description info -->
                <div class="description" id="description">
                    <div>
                        <i class="fas fa-arrow-left" aria-hidden="true"></i>
                        <h3>Description</h3>
                    </div>
                                
                    <p><?php echo $row['item_description'] ?></p>
                </div>

                <!-- item price and quantity -->
                <div class="priceInfo">
                    <span class="price"> 
                        <span id="price_<?php echo $row['item_id'] ?>"> 
                            <?php echo $price ?> 
                        </span> <?php echo $currency_logo ?>
                    </span>

                    <div class="separator"></div>

                    <div class="qtybtns">
                        <div class="QTY" id="sus" ><i class="fas fa-minus"></i></div>
                        <span class="counter" id="quantity_<?php echo $row['item_id'] ?>" > 1 </span>
                        <div class="QTY" id="addq"><i class="fas fa-plus"></i></div>
                    </div>  
                </div>
      
                <!-- add to cart button -->
                <button class="btn addItemToCart" id="<?php echo $row['item_id'] ?>"><i class="fas fa-cart-plus"></i> Add To Cart</button>  

            </div>
        </div>
<?php }} ?>
       

    </div>
</section>




