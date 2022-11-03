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

	$toppingCat_name = trim($_POST['name']);

	$query = "INSERT INTO toppingscategory(`topping_category_name`) 
              VALUES ('$toppingCat_name')";

	mysqli_query($conn,$query);
	header("Refresh: 0;");

} 


if(isset($_POST["update_info"])) { 

	$new_name=trim($_POST["tn"]);

	$id = $_POST['hidden_id'];

	$query = "UPDATE toppingscategory set topping_category_name='".$new_name."' WHERE topping_category_id=$id";

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
			$section="Toppings Categories";
			
			include('../includes/top_navbar.php'); ?>
		
			<div class="main-content">
				<div id="tabbed_box" class="tabbed_box">
					
					<h4>Manage Toppings Categories</h4>
					<hr />

					<div class="tabbed_area">

						<ul class="tabs">
							<li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">View Toppings Categories</a></li>
							<li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">Add Category</a></li>
						</ul>

<!--##################################################################################### 
	View toppings categories
	##################################################################################### -->

						<div id="content_1" class="content">
							<div class="row ">
								<div class="col-lg-12 col-md-12">
									<div class="card">

                                    <div class="card-content table-responsive">
											<table class="table table-hover">
												<thead class="text-primary">
													<tr>
														
														<th>Toppings Categories</th>											
														<th></th>
														<th></th>
													</tr>
												</thead>
												<tbody>
				
													<?php
														$result = mysqli_query($conn,"SELECT * FROM toppingscategory"); 
														while ($row = mysqli_fetch_assoc($result)) { ?>

															<tr>
																
																<td id="name_<?php echo $row['topping_category_id'] ?>"><?php echo $row['topping_category_name']; ?></td>
															
																<td>
																	<button class="update_toppingCat" id="<?php echo $row['topping_category_id'] ?>">
																		<span class="iconify" data-icon="bx:edit" style="color: green;" data-width="30" data-height="30"></span>
																	</button>
																</td>
																<td>
																	<button class="delete_toppingCat" id="<?php echo $row['topping_category_id'] ?>">
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


<!--##################################################################################### 
	add a new topping category
	##################################################################################### -->
						
						<div id="content_2" class="content">
						
							<form  action="" method="post" enctype="multipart/form-data">
								<table width="220" height="106" border="0">
								
									<tr>
										<td align="center"><input name="name" type="text" style="width:100%" placeholder="Topping Category Name" required="required" id="add_toppingCat_name" /></td>
									</tr>			
									<tr>
										<td align="right"><input type="submit" value="add" name="submit" class="add_toppingCat" /></td>
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
        when the manager click on edit button
        a popup modal appears -> let the manager update a menu details
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

														<div class="form-group"> 
															<label class="col-sm-3 col-md-4 control-label">Topping Category Name (no space)</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="tn" id="tn"  required="required">                     
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


