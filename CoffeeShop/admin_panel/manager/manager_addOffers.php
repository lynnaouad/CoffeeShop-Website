<?php session_start();

if (!isset($_SESSION['manager_id'])) {
	header("location:../index.php");
	exit();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <title>Manager</title>
	    
	<!-- Bootstrap css file -->
	<link rel="stylesheet" href="../../plugins/bootstrap-5.1.3/css/bootstrap.min.css">


	<!--  Iconify SVG framework link -->
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>

	<!-- custom css file link  -->
    <link rel="stylesheet" href="../css/custom.css">
	<link rel="stylesheet" href="../css/sidebar.css">
	<link rel="stylesheet" href="../css/top_navbar.css">
	<link rel="stylesheet" href="../css/tabbed_box.css">
	
	<!--google material icon-->
        <link href="https://fonts.googleapis.com/css2?family=Material+Icons"
      rel="stylesheet">

	  
</head>
<body>

<?php

include_once('../../includes/db_connect.php');

if(isset($_POST["submit"])) { 

    $item_name = trim($_POST['item']);
	$pourcentage = trim($_POST['pourcentage']);
    $start_date = trim($_POST['start_date']);
    $end_date = trim($_POST['end_date']);

    $query="SELECT item_id,item_price  FROM menuitem WHERE item_name='$item_name'";
    $result = mysqli_query($conn,$query); 
    $row = mysqli_fetch_assoc($result);

    $item_id=$row['item_id'];

    $new_price = $row['item_price'] - $row['item_price']*($pourcentage/100);

	$query = "INSERT INTO `offer` (`item_id`, `new_price`,`pourcentage`,`start_date`,`end_date`) 
              VALUES ('$item_id','$new_price','$pourcentage','$start_date','$end_date')";

	mysqli_query($conn,$query);
	header("Refresh: 0;");

} 

if(isset($_POST["update_info"])) { 

	$offer_pourcentage = trim($_POST['p']);
    $end_date = trim($_POST['ed']);

	$id = $_POST['hidden_id'];
    $old_price = $_POST['hidden_price'];

    $new_price = $old_price - $old_price*($offer_pourcentage/100);


      
	$query = "UPDATE offer set new_price='".$new_price."',
									pourcentage='".$offer_pourcentage."',
									end_date='".$end_date."'
									WHERE offer_id=$id";

	mysqli_query($conn,$query);
	header("Refresh: 0;");


    }



?>


  
<div class="wrapper">
	<div class="body-overlay"></div>


        <?php 
	
		// sidebar
		include('../includes/manager_sidebar.php'); ?>


        <div id="content">
		
        <?php 
			$section="Offers";
			
			include('../includes/top_navbar.php'); ?>
		
			<div class="main-content">
				<div id="tabbed_box" class="tabbed_box">
					
					<h4>Manage Offers</h4>
					<hr />

					<div class="tabbed_area">

						<ul class="tabs">
							<li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">View Offers</a></li>
							<li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">Add Offer</a></li>
						</ul>

<!--##################################################################################### 
	View Offers
	##################################################################################### -->

						<div id="content_1" class="content">
							<div class="row ">
								<div class="col-lg-12 col-md-12">
									<div class="card">
										
										<div class="card-content">

                                            <input type="button" id="delete_finished_offers" value="delete finished offers" />
                                            <input type="button" id="delete_all_offers" value="delete all offers" />

                                        
                                        <?php 

                                       

                                        $query = "SELECT offer_id, item_name, item_price,item_image, new_price, pourcentage, start_date, end_date FROM offer,menuitem WHERE offer.item_id = menuitem.item_id";
                                        $result = mysqli_query($conn,$query);   ?>

                                        <div class="offer">

                                        <?php
                                        while($row = mysqli_fetch_assoc($result)){ 
                                            $message = null;

                                            $todaydate = date("Y")."-".date("m")."-".date("d");

                                            // if offer is finished
                                            if($row['end_date'] < $todaydate){
                                                $message = "Offer finished - Delete";
                                            }
                                            ?>
                                                
                                                <div class="item_card">
                                                    <div class="card-img">
                                                        <img id="image_<?php echo $row['offer_id']; ?>" src="../../<?php echo $row['item_image'] ?>">
                                                    </div>
                                                    <div class="card-info">
                                                        <p class="text-title" id="name_<?php echo $row['offer_id']; ?>" ><?php echo $row['item_name'] ?></p>
                                                      </div>

                                                    <div class="prices">
                                                        <span class="new_price">
                                                            <span>
                                                                <?php echo $row["new_price"] ?>$
                                                            </span> 
                                                        </span>

                                                        <span class="old_price">
                                                            <?php echo $row["item_price"] ?>$
                                                            <span></span>
                                                        </span> 

                                                        <span class="pourcentage">
                                                            -<?php echo $row["pourcentage"] ?>%
                                                        </span>
                                                            
                                                    </div>

                                                    <input type="hidden" value="<?php echo $row['pourcentage'] ?>" id="pourcentage_<?php echo $row['offer_id']; ?>" />
                                                    <input type="hidden" value="<?php echo $row['item_price'] ?>" id="oldprice_<?php echo $row['offer_id']; ?>" />

                                                    <div class="card-footer">

                                                        <span class="text-title" >Start date: <span id="sd_<?php  echo $row['offer_id']; ?>"><?php echo $row['start_date'] ?></span></span>
                                                        <span class="text-title" >End date: <span id="ed_<?php  echo $row['offer_id']; ?>"><?php echo $row['end_date'] ?></span></span>
                                                        <span class="warning_mess" ><?php echo $message; ?></span>
                                                      
                                                        <div class="card-button">
                                                            <button class="update_offer" id="<?php echo $row['offer_id'] ?>">
                                                                <span class="iconify" data-icon="bx:edit" style="color: green;" data-width="30" data-height="30"></span>
                                                            </button> 
                                                            <button class="delete_offer" id="<?php echo $row['offer_id'] ?>">
                                                                <span class="iconify" data-icon="fluent:delete-24-filled" style="color: red;" data-width="30" data-height="30"></span>
                                                            </button>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                        <?php } ?>
                                        </div>
											
										</div>
									</div>
								</div>
							</div>
						</div>


<!--##################################################################################### 
	add a new offer
	##################################################################################### -->
						
						<div id="content_2" class="content">
						
							<form  action="" method="post" enctype="multipart/form-data">
								<table width="220" height="106" border="0">
                                    <tr>
                                        <td>
                                    <?php
                                       $query="SELECT item_name,item_id,item_price
                                       FROM menuitem
                                       WHERE item_id NOT IN (SELECT item_id FROM todayoffer)";

                                        $result = mysqli_query($conn,$query); 
                                        echo "Item: ";    
                                        echo "<select name='item'>";
                                        while($row = mysqli_fetch_assoc($result)){ ?>
                                                    <option>
                                                        <?php echo $row['item_name'] ?>
                                                    </option> 
                                                    
                                        <?php }  
                                        
                                        echo "</select>";?>
                                        </td>
                                    </tr>
									<tr>
										<td align="center"><input name="pourcentage" type="text" style="width:100%" placeholder="pourcentage" required="required" /></td>
									</tr>
									<tr>
										<td align="center"><input name="start_date" type="date" style="width:100%"  required="required"  /></td>
									</tr>
									<tr>
										<td align="center"><input name="end_date" type="date" style="width:100%"  required="required"  /></td>
									</tr>

                                    

                                    
									

									<tr>
										<td align="right"><input type="submit" value="add" name="submit" class="add_item" /></td>
									</tr>
								</table>
							</form>
						</div>

					</div>

				</div>
			</div>
		</div>
</div>


<!--##################################################################################### 
        when the admin click on edit button
        a popup modal appears -> let the admin update an offer
    ##################################################################################### -->

<div id="add_modal" class="modal fade" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">

            <!-- modal title -->
            <div class="modal-header">
                <h3 class="modal-title" id="NAME"></h3>
	      	</div>

            <!--  modal body -->
			<form method="post" action="" enctype="multipart/form-data" class="form-horizontal">
				<div class="modal-body">   
					<div class="content-wrapper">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">	
									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-default">
												<div class="panel-body">
                                                    <form action="" method="post" enctype="multipart/form-data" >
														<div class="hr-dashed"></div>

														<input type="hidden" name="hidden_id" id="hidden_id" value="" />
                                                        <input type="hidden" name="hidden_price" id="hidden_price" value="" />

														<div class="form-group">
															<img class="image" id="mi" src="" />
                                                            	<label class="col-sm-3 col-md-4 control-label" id="on"></label>
														</div>

														<div class="form-group"> 
															<label class="col-sm-3 col-md-4 control-label">Pourcentage</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="p" id="p"  required="required">                     
															</div>
														</div>

                                                        <div class="form-group"> 
															<label class="col-sm-3 col-md-4 control-label">end date</label>
															<div class="col-sm-8">
																<input type="date" class="form-control" name="ed" id="ed">                     
															</div>
														</div>

														
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> 					
					</div>

					<div class="modal-footer">
						<input class="btn btn-primary" type="submit" name="update_info" id="update_info" value="Update">
						<input class="btn btn-primary" type="submit" name="cancel" id="cancel" value="Cancel">
					</div>
				</div>
			</form>
    	</div>
  	</div>
</div>


<!-- menu items select -->
<script>

const menuTabs = document.querySelector('.menu-tabs');

menuTabs.addEventListener("change",function(e){
    if(e.target.options[e.target.options.selectedIndex].classList.contains("menu-tab-item") && !e.target.options[e.target.options.selectedIndex].classList.contains("show")){
    const target = e.target.options[e.target.options.selectedIndex].getAttribute("data-target");

    const menuSection = document.querySelector('.menuItems');

    //select all specific items of the old menu and remove the class show 
    menuSection.querySelectorAll(".item_card.show").forEach(function(e){
      e.classList.remove("show");
    });

    //select all specific items of the targeted menu and add the class show 
    menuSection.querySelectorAll(target).forEach(function(e){
      e.classList.add("show");
    });
}
  
});

</script>

					

<script src="js/popper.min.js"></script>

<!-- bootstrap js file-->
<script src="../../plugins/bootstrap-5.1.3/js/bootstrap.min.js"></script>

<!-- jquery js file  -->
<script src="../../plugins/jquery-3.6.0/jquery.min.js"></script>

<!-- sweetalert2 js file -->
<script src="../../plugins/sweetalert2/sweetalert2.js"></script>

<script src="../js/script.js" type="text/javascript"></script>
<script src="../js/update_delete.js" type="text/javascript"></script>
  

</body>
  
</html>


