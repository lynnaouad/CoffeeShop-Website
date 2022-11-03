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
							<li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">View Orders</a></li>						
						</ul>

<!--##################################################################################### 
	View order info
	##################################################################################### -->

						<div id="content_1" class="content">
                            <div class="row ">
								<div class="col-lg-12 col-md-12">
									<div class="card">
										
										<div class="card-content table-responsive">
											<table class="table table-hover">
												<thead class="text-primary">
													<tr>
														<th>order id</th> 
														<th>name</th>
														<th>email </th> 
														<th>phone </th> 
														<th>address </th>
														<th>city </th>
														<th>zip</th>
														<th>state</th>
                                                        <th>country</th>
                                                        <th>total</th>
														<th>currency</th>
                                                        <th>date</th>
													</tr>
												</thead>
												<tbody>
				
													<?php
														$result = mysqli_query($conn,"SELECT * FROM orderinfo"); 
														while ($row = mysqli_fetch_assoc($result)) { ?>

															<tr>
																<td><?php echo $row['order_id']; ?></td>
                                                                <td><?php echo $row['customer_name']; ?></td>
                                                                <td><?php echo $row['customer_email']; ?></td>
                                                                <td><?php echo $row['customer_phone']; ?></td>
                                                                <td><?php echo $row['customer_address']; ?></td>
                                                                <td><?php echo $row['customer_city']; ?></td>
                                                                <td><?php echo $row['customer_zip']; ?></td>
                                                                <td><?php echo $row['customer_state']; ?></td>
                                                                <td><?php echo $row['customer_country']; ?></td>
                                                                <td><?php echo $row['order_total']; ?></td>
                                                                <td><?php echo $row['order_currency']; ?></td>
                                                                <td><?php echo $row['order_date']; ?></td>


																<td>
                                                                    <a class="view_orderInfo" id="<?php echo $row['order_id'] ?>" href="view_orderItems.php?id=<?php echo $row['order_id'] ?>">
                                                                    <span class="iconify-inline" data-icon="akar-icons:eye" style="color: blue;" data-width="30"></span>
																	</a>

																</td>
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


