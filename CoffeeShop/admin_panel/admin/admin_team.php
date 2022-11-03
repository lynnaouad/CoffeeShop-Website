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

	$member_name = trim($_POST['name']);
	$member_role = trim($_POST['role']);
    $member_phone = trim($_POST['phone']);
    $member_email = trim($_POST['email']);
	$member_salary = trim($_POST['salary']);
    $member_username = trim($_POST['username']);
    $member_password= trim($_POST['password']);

	if(isset($_FILES['image']['name'])){
		$filename=$_FILES['image']['name'];

		$location="../../images/team/".$filename;

		// if folder doesn't exist -> create one
        if(!file_exists("../../images/team")){
			mkdir("../../images/team",0700,true);                
		 }

		move_uploaded_file($_FILES['image']['tmp_name'],$location);
	}


	$query = "INSERT INTO `team` (`member_name`,`member_image`,`member_role`,`member_phone`,`member_email`,`member_salary`,`member_username`,`member_password`) VALUES 
	('$member_name','$filename','$member_role','$member_phone','$member_email','$member_salary','$member_username','$member_password')";

	mysqli_query($conn,$query);
	header("Refresh: 0;");
} 

if(isset($_POST["update_info"])) { 

	$new_name=trim($_POST["mn"]);
	$new_role=trim($_POST["mr"]);
	$new_phone=trim($_POST["mp"]);
	$new_email=trim($_POST["me"]);
	$new_salary=trim($_POST["ms"]);
	$new_username=trim($_POST["mu"]);
	$new_password=trim($_POST["mpass"]);

	$id = $_POST['hidden_id'];

	if($_FILES['new_image']['size'] > 0){
		$filename=$_FILES['new_image']['name'];

		$location="../../images/team/".$filename;

		move_uploaded_file($_FILES['new_image']['tmp_name'],$location);

		$query = "UPDATE `team` set member_image='".$filename."' WHERE member_id=$id";

		mysqli_query($conn,$query);
	}

	$query = "UPDATE `team` set member_name='".$new_name."', 
							  member_role='".$new_role."', 
							  member_phone='".$new_phone."', 
							  member_email='".$new_email."',
							  member_salary='".$new_salary."',
							  member_username='".$new_username."',  
							  member_password='".$new_password."' 
					WHERE member_id=$id";

	if(mysqli_query($conn,$query)){
	    header("Refresh: 0;");
	}
	else{
	    echo mysqli_error($conn);
	}
	

}

?>


<div class="wrapper">
	<div class="body-overlay"></div>


        <?php 

        // sidebar
		include('../includes/admin_sidebar.php'); 
		?>

        <div id="content">
		
        <?php 
			$section="Team Members";
			
			include('../includes/top_navbar.php'); 
			?>
		
			<div class="main-content">
	
				<div id="tabbed_box" class="tabbed_box">
					
					<h4>Manage Team Members</h4>
					<hr />

					<div class="tabbed_area">

						<ul class="tabs">
							<li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">View Team</a></li>
							<li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">Add Member</a></li>
						</ul>

<!--##################################################################################### 
	View all team members
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
                                                        <th>Role</th>
														<th>Phone </th> 
														<th>Email </th> 
                                                        <th>Salary</th>
														<th>Username </th>
														<th>Password </th>
														<th></th>
														<th></th>
													</tr>
												</thead>
												<tbody>
				
													<?php
														$result = mysqli_query($conn,"SELECT * FROM team"); 
														while ($row = mysqli_fetch_assoc($result)) { ?>

															<tr>
																<td><img src="../../images/team/<?php echo $row['member_image']; ?>" class="round_img"  id="image_<?php echo $row['member_id'] ?>" /></td>
																<td id="name_<?php echo $row['member_id'] ?>"><?php echo $row['member_name']; ?></td>
																<td id="role_<?php echo $row['member_id'] ?>"><?php echo $row['member_role']; ?></td>
																<td id="phone_<?php echo $row['member_id'] ?>"><?php echo $row['member_phone']; ?></td>
																<td id="email_<?php echo $row['member_id'] ?>"><?php echo $row['member_email']; ?></td>
																<td id="salary_<?php echo $row['member_id'] ?>"><?php echo $row['member_salary']."$"; ?></td>
																<td id="username_<?php echo $row['member_id'] ?>"><?php echo $row['member_username']; ?></td>
																<td id="password_<?php echo $row['member_id'] ?>"><?php echo $row['member_password']; ?></td>
														
																<td>
																	<button class="update_member" id="<?php echo $row['member_id'] ?>">
																		<span class="iconify" data-icon="bx:edit" style="color: green;" data-width="30" data-height="30"></span>
																	</button>
																</td>
																<td>
																	<button class="delete_member" id="<?php echo $row['member_id'] ?>">
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
	Add a new team member
	##################################################################################### -->						
						
						<div id="content_2" class="content">
						
							<form  action="" method="post" enctype="multipart/form-data">
								<table width="220" height="106" border="0">
									<tr>
										<td align="center"><input name="image" type="file" style="width:100%"  required="required" id="uploadFile" accept=".jpg, .jpeg, .png" /></td>
									</tr>
									<tr>
										<td align="center"><input name="name" type="text" style="width:100%" placeholder="Member Name" required="required" id="add_member_name" /></td>
									</tr>
									<tr>
										<td align="center"><input name="role" type="text" style="width:100%" placeholder="Role" required="required" id="add_member_role" /></td>
									</tr>
									<tr>
										<td align="center"><input name="phone" type="text" style="width:100%" placeholder="Phone Number" required="required" id="add_member_phone" /></td>
									</tr>
									<tr>
										<td align="center"><input name="email" type="email" style="width:100%" placeholder="Email" required="required" id="add_member_email" /></td>
									</tr>
									<tr>
										<td align="center"><input name="salary" type="text" style="width:100%" placeholder="Salary" required="required" id="add_member_salary" /></td>
									</tr>
									<tr>
										<td align="center"><input name="username" type="text" style="width:100%" placeholder="Username" required="required" id="add_member_username" /></td>
									</tr>
									<tr>
										<td align="center"><input name="password" type="text" style="width:100%" placeholder="Password" required="required" id="add_member_password" /></td>
									</tr>
									<tr>
										<td align="right"><input type="submit" value="add" name="submit" class="add_member" /></td>
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
        a popup modal appears -> let the admin update a member's details
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
															<img class="image" id="mi" src="" />
															<label class="col-sm-3 control-label">Click to change photo</label>
															<div class="col-sm-8">
																<input type="file" class="form-control new_image" name="new_image" id="new_image">                     
															</div>
														</div>

														<div class="form-group"> 
															<label class="col-sm-3 col-md-4 control-label">Member Name</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="mn" id="mn"  required="required">                     
															</div>
														</div>

														<div class="form-group"> 
															<label class="col-sm-3 col-md-4 control-label">Member Role</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="mr" id="mr"  required="required">                     
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-3 col-md-4 control-label">Member Phone</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="mp" id="mp"  required="required">                     
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-3 col-md-4 control-label">Member email</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="me" id="me" required="required">                     
															</div>
														</div>

														<div class="form-group"> 
															<label class="col-sm-3 col-md-4 control-label">Member Salary</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="ms" id="ms"  required="required">                     
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-3 col-md-4 control-label">Member username</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="mu" id="mu" required="required">                     
															</div>
														</div>

														<div class="form-group">
															<label class="col-sm-3 col-md-4 control-label">Member password</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="mpass" id="mpass" required="required">                     
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


