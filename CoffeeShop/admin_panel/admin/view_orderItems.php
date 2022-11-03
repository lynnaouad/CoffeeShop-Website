<?php session_start();

if (!isset($_SESSION['admin_id'])) {
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
    <title>Admin</title>
	    
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


?>


  
<div class="wrapper">
	<div class="body-overlay"></div>


        <?php 
	
		// sidebar
		include('../includes/admin_sidebar.php'); ?>


        <div id="content">
		
        <?php 
			$section="Orders";
			
			include('../includes/top_navbar.php'); ?>
		
			<div class="main-content">
				<div id="tabbed_box" class="tabbed_box">
					
					<h4>View Orders Information</h4>
					<hr />

					<div class="tabbed_area">

						<ul class="tabs">
							<li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">Items</a></li>						
						</ul>

<!--##################################################################################### 
	View order Items
	##################################################################################### -->

						<div id="content_1" class="content">
                            <div class="row ">
								<div class="col-lg-12 col-md-12">
									<div class="card">
										
										<div class="card-content table-responsive">
											<table class="table table-hover">
												<thead class="text-primary">
													<tr>
                                                        <th></th>
														<th>name</th> 
														<th>price</th>
														<th>quantity</th>
														<th>toppings</th>
														<th>toppings price</th>
														<th>total </th>  
														<th>currency</th>
													</tr>
												</thead>
												<tbody>
													
												<?php
														$id = $_GET["id"];
														$result = mysqli_query($conn,"SELECT order_item_id, order_items.order_id, item_name, item_quantity, toppings_price, item_total, order_currency FROM orderinfo , order_items WHERE orderinfo.order_id=$id and order_items.order_id=$id;"); 
														while ($row = mysqli_fetch_assoc($result)) { 
															
															$query2="SELECT item_image,item_price From menuitem where item_name='".$row['item_name']."'";
															$result2= mysqli_query($conn,$query2);
															$row2=mysqli_fetch_assoc($result2);
															?>

															<tr>
																<td><img src="../../<?php echo $row2['item_image']; ?>" class="round_img" /></td>
																<td><?php echo $row['item_name']; ?></td>
																<td><?php echo $row2['item_price']; ?></td>
                                                                <td><?php echo $row['item_quantity']; ?></td>

																<td>
																<?php 

																	$query3="SELECT topping_image From toppings,extra_toppings where toppings.topping_name = extra_toppings.topping_name and order_item_id =".$row['order_item_id'];
																	$result3= mysqli_query($conn,$query3);
																	while($row3=mysqli_fetch_assoc($result3)){?>

																<img src="../../<?php echo $row3['topping_image']; ?>" class="img_toppings" >

																<?php } ?>

																</td>
                                                                <td><?php echo $row['toppings_price']?></td>
                                                                <td><?php echo $row['item_total']; ?></td>
																<td><?php echo $row['order_currency'] ?></td>

														<?php } ?>
				
													
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>




					</div>

				</div>
			</div>
		</div>
</div>




					

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


