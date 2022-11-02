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
    <link rel="stylesheet" href="../css/dashboard.css">
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

if(isset($_POST["update_info"])) { 

	$del = trim($_POST['del']);
      
	$query ="UPDATE delivery set delivery_cost=$del WHERE delivery_id=1";

	mysqli_query($conn,$query);
	header("Refresh: 0;");


    }

if(isset($_POST["update_cinfo"])) { 

    $price = trim($_POST['cp']);

    $id = $_POST['hidden_id'];
      
	$query ="UPDATE currency set  convert_price='".$price."' WHERE currency_id=$id";

	mysqli_query($conn,$query);
	header("Refresh: 0;");


    }


    if(isset($_POST["update_cinfo2"])) { 

        $to = trim($_POST['to']);
        $price = trim($_POST['cp']);
    
        $id = $_POST['hidden_id'];
        

        $query = "INSERT INTO `currency` (`from_currency`,`to_currency`, `convert_price`) 
                VALUES ('$','$to','$price')";

        mysqli_query($conn,$query);
		header("Refresh: 0;");
    
        }

?>


  
<div class="wrapper">
	<div class="body-overlay"></div>


        <?php 
        
	
		// sidebar
		include('../includes/admin_sidebar.php'); ?>


        <div id="content">
		
        <?php 
			$section="Dashboard";
			
			include('../includes/top_navbar.php'); ?>
		
			<div class="main-content">

                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <?php

                            $result = mysqli_query($conn,"SELECT count(*) as nb FROM review_table");
                            $row = mysqli_fetch_assoc($result);

                            ?>
                            <div class="card card-stats">
                                <div class="card-header">
                                    <div class="icon icon-warning">
                                       <span class="material-icons">equalizer</span>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>Reviews</strong></p>
                                    <h3 class="card-title"><?php echo $row['nb'] ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons text-info">info</i>
                                        <a href="view_reviews.php">See detailed report</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <?php

                            $result = mysqli_query($conn,"SELECT count(*) as nb FROM orderinfo");
                            $row = mysqli_fetch_assoc($result);

                            ?>
                            
                            <div class="card card-stats">
                                <div class="card-header">
                                    <div class="icon icon-rose">
                                       <span class="material-icons">shopping_cart</span>

                                    </div>
                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>Orders</strong></p>
                                    <h3 class="card-title"><?php echo $row['nb'] ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">local_offer</i>
										<a class="viewOrder" href="view_orders.php" id="orders">View</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6 col-sm-6">
                             <?php

                            $result = mysqli_query($conn,"SELECT SUM(order_total) as nb FROM orderinfo");
                            $row = mysqli_fetch_assoc($result);

                            ?>
                            <div class="card card-stats">
                                <div class="card-header">
                                    <div class="icon icon-success">
                                        <span class="material-icons">attach_money</span>

                                    </div>
                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>Revenue</strong></p>
                                    <h3 class="card-title">$<?php echo $row['nb'] ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">date_range</i> Weekly sales
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <?php

                            $result = mysqli_query($conn,"SELECT count(distinct customer_name) as nb FROM orderinfo;");
                            $row = mysqli_fetch_assoc($result);

                            ?>
                            <div class="card card-stats">
                                <div class="card-header">
                                    <div class="icon icon-info">
                                    
                                        <span class="material-icons">
                                        follow_the_signs
                                        </span>
                                    </div>
                                </div>
                                <div class="card-content">
                                    <p class="category"><strong>Costumers</strong></p>
                                    <h3 class="card-title">+<?php echo $row['nb'] ?></h3>
                                </div>
                                <div class="card-footer">
                                    <div class="stats">
                                        <i class="material-icons">update</i> Just Updated
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr />
                <h4>Delivery</h4>
				<hr />

                <div class="delivery_infos">

                <?php

                    $result = mysqli_query($conn,"SELECT delivery_cost FROM delivery");
                    $row = mysqli_fetch_assoc($result);

                ?>

                    <label class="col-sm-3 col-md-4 control-label">Delivery cost: <span id="cost"><?php echo $row['delivery_cost']; ?> </span>$ </label>     
                    <input type="button" id="delivery" value="change delivery cost" />

                </div>

                <hr />
                <h4>Currency (from $)</h4>
				<hr />

                <input type="button" id="curr" value="add new currency" />

                <div class="row ">
								<div class="col-lg-12 col-md-12">
									<div class="card">
										
										<div class="card-content table-responsive">
											<table class="table table-hover">
												<thead class="text-primary">
													<tr>
														<th>to currency</th>
														<th>convert </th> 
													</tr>
												</thead>
												<tbody>
				
													<?php
														$result = mysqli_query($conn,"SELECT * FROM currency"); 
														while ($row = mysqli_fetch_assoc($result)) { ?>

															<tr>
																
																<td id="to_<?php echo $row['currency_id'] ?>"><?php echo $row['to_currency']; ?></td>
																<td id="price_<?php echo $row['currency_id'] ?>"><?php echo $row['convert_price']; ?></td>
																
																<td>
																	<button class="update_currency" id="<?php echo $row['currency_id'] ?>">
																		<span class="iconify" data-icon="bx:edit" style="color: green;" data-width="30" data-height="30"></span>
																	</button>
																</td>
																<td>
																	<button class="delete_currency" id="<?php echo $row['currency_id'] ?>">
																		<span class="iconify" data-icon="fluent:delete-24-filled" style="color: red;" data-width="30" data-height="30"></span>
																	</button>
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
														

<!--##################################################################################### 
        when the admin click on edit button
        a popup modal appears -> let the admin update delivery cost
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
                                                    <form action="" method="post"  >
														
                                                    <div class="hr-dashed"></div>

														<div class="form-group"> 
															<label class="col-sm-3 col-md-4 control-label" >Delivery Cost</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="del" id="del"  required="required">                     
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


<!--##################################################################################### 
        when the admin click on edit button
        a popup modal appears -> let the admin update currency
    ##################################################################################### -->

    <div id="add_modal2" class="modal fade" tabindex="-1" role="dialog">
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
                                                    <form action="" method="post"  >
														
                                                    <div class="hr-dashed"></div>

                                                    <input type="hidden" name="hidden_id" id="hidden_id" value="" />

                                                        <div class="form-group"> 
															<label class="col-sm-3 col-md-4 control-label" >convert</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="cp" id="cp"  required="required">                     
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
						<input class="btn btn-primary" type="submit" name="update_cinfo" id="update_cinfo" value="Update">
						<input class="btn btn-primary" type="submit" name="cancel" id="cancel" value="Cancel">
					</div>
				</div>
			</form>
    	</div>
  	</div>
</div>


<!--##################################################################################### 
        when the admin click on edit button
        a popup modal appears -> let the admin add new currency
    ##################################################################################### -->

    <div id="add_modal3" class="modal fade" tabindex="-1" role="dialog">
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
                                                    <form action="" method="post"  >
														
                                                    <div class="hr-dashed"></div>

                                                    <input type="hidden" name="hidden_id" id="hidden_id" value="" />

                                                        <div class="form-group"> 
															<label class="col-sm-3 col-md-4 control-label" >to currency</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="to" id="to"  required="required">                     
															</div>
														</div>

                                                        <div class="form-group"> 
															<label class="col-sm-3 col-md-4 control-label" >convert</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="cp" id="cp"  required="required">                     
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
						<input class="btn btn-primary" type="submit" name="update_cinfo2" id="update_cinfo2" value="add">
						<input class="btn btn-primary" type="submit" name="cancel" id="cancel" value="Cancel">
					</div>
				</div>
			</form>
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
<script src="../js/charts.js" type="text/javascript"></script>
<script src="../js/update_delete.js" type="text/javascript"></script>
  

</body>
  
</html>


