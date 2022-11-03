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

if(isset($_POST["submit"])) { 

	$admin_name = trim($_POST['name']);
    $admin_phone = trim($_POST['phone']);
    $admin_email = trim($_POST['email']);
    $admin_username = trim($_POST['username']);
    $admin_password= trim($_POST['password']);

	//upload image
	if(isset($_FILES['image']['name'])){
		$filename=$_FILES['image']['name'];

		$location="../../images/admins/".$filename;

		move_uploaded_file($_FILES['image']['tmp_name'],$location);
	}


	$query = "INSERT INTO administrator(`admin_name`, `admin_phone`,`admin_email`, `admin_image`,`admin_username`, `admin_password`) 
              VALUES ('$admin_name','$admin_phone','$admin_email','$filename','$admin_username','$admin_password')";

	mysqli_query($conn,$query);

	header("Refresh: 0;");

} 

if(isset($_POST["update_info"])) { 

	$new_name=trim($_POST["an"]);
	$new_phone=trim($_POST["ap"]);
	$new_email=trim($_POST["ae"]);
	$new_username=trim($_POST["au"]);
	$new_password=trim($_POST["apass"]);

	$id = $_POST['hidden_id'];


	if($_FILES['new_image']['size'] > 0){
		$filename=$_FILES['new_image']['name'];

		$location="../../images/admins/".$filename;

		// if folder doesn't exist -> create one
        if(!file_exists("../../images/admins")){
			mkdir("../../images/admins",0700,true);                
		 }

		move_uploaded_file($_FILES['new_image']['tmp_name'],$location);

		$query = "UPDATE administrator set admin_image='".$filename."' WHERE admin_id=$id";

		mysqli_query($conn,$query);
	}

	$query = "UPDATE administrator set admin_name='".$new_name."', 
									 admin_phone='".$new_phone."', 
									 admin_email='".$new_email."',
									 admin_username='".$new_username."',  
									 admin_password='".$new_password."' 
						WHERE admin_id=$id";

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
			$section="Administrators";
			
			include('../includes/top_navbar.php'); ?>
		
			<div class="main-content">
				<div id="tabbed_box" class="tabbed_box">
					
					<h4>Manage Administrators</h4>
					<hr />

					<div class="tabbed_area">

						<ul class="tabs">
							<li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">View Administrators</a></li>
							<li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">Add Administrator</a></li>
						</ul>

<!--##################################################################################### 
	View all administrators
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
														<th>Name</th>
														<th>Phone </th> 
														<th>Email </th> 
														<th>Username </th>
														<th>Password </th>
														<th></th>
														<th></th>
													</tr>
												</thead>
												<tbody>
				
													<?php
														$result = mysqli_query($conn,"SELECT * FROM administrator"); 
														while ($row = mysqli_fetch_assoc($result)) { ?>

															<tr>
																<td><img src="../../images/admins/<?php echo $row['admin_image']; ?>" class="round_img"  id="image_<?php echo $row['admin_id'] ?>" /></td>
																<td id="name_<?php echo $row['admin_id'] ?>"><?php echo $row['admin_name']; ?></td>
																<td id="phone_<?php echo $row['admin_id'] ?>"><?php echo $row['admin_phone']; ?></td>
																<td id="email_<?php echo $row['admin_id'] ?>"><?php echo $row['admin_email']; ?></td>
																<td id="username_<?php echo $row['admin_id'] ?>"><?php echo $row['admin_username']; ?></td>
																<td id="password_<?php echo $row['admin_id'] ?>"><?php echo $row['admin_password']; ?></td>
														
																<td>
																	<button class="update_admin" id="<?php echo $row['admin_id'] ?>">
																		<span class="iconify" data-icon="bx:edit" style="color: green;" data-width="30" data-height="30"></span>
																	</button>
																</td>
																<td>
																	<button class="delete_admin" id="<?php echo $row['admin_id'] ?>">
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
	add a new administrator
	##################################################################################### -->
						
						<div id="content_2" class="content">
						
							<form  action="" method="post" enctype="multipart/form-data">
								<table width="220" height="106" border="0">
									<tr>
										<td align="center"><input name="image" type="file" style="width:100%"  required="required" id="uploadFile" accept=".jpg, .jpeg, .png" /></td>
									</tr>
									<tr>
										<td align="center"><input name="name" type="text" style="width:100%" placeholder="Admin Name" required="required" id="add_admin_name" /></td>
									</tr>
									<tr>
										<td align="center"><input name="phone" type="text" style="width:100%" placeholder="Phone Number" required="required" id="add_admin_phone" /></td>
									</tr>
									<tr>
										<td align="center"><input name="email" type="email" style="width:100%" placeholder="Email" required="required" id="add_admin_email" /></td>
									</tr>
									<tr>
										<td align="center"><input name="username" type="text" style="width:100%" placeholder="Username" required="required" id="add_admin_username" /></td>
									</tr>
									<tr>
										<td align="center"><input name="password" type="text" style="width:100%" placeholder="Password" required="required" id="add_admin_password" /></td>
									</tr>
									<tr>
										<td align="right"><input type="submit" value="add" name="submit" class="add_admin" /></td>
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
        a popup modal appears -> let the admin update other admin's details
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
															<img class="image" id="ai" src="" />
															<label class="col-sm-3 control-label">Click to change photo</label>
															<div class="col-sm-8">
																<input type="file" class="form-control new_image" name="new_image" id="new_image">                     
															</div>
														</div>

														<div class="form-group"> 
															<label class="col-sm-3 col-md-4 control-label">Admin Name</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="an" id="an"  required="required">                     
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-3 col-md-4 control-label">Admin Phone</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="ap" id="ap"  required="required">                     
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-3 col-md-4 control-label">Admin email</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="ae" id="ae" required="required">                     
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-3 col-md-4 control-label">Admin username</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="au" id="au" required="required">                     
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-3 col-md-4 control-label">Admin password</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="apass" id="apass" required="required">                     
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


