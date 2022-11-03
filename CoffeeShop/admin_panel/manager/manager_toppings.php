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

	$topping_name = trim($_POST['name']);
    $topping_price = trim($_POST['price']);
    $topping_cat = trim($_POST['menu']);

	//upload image
	if(isset($_FILES['image']['name'])){
		$filename=$_FILES['image']['name'];

        $img = "images/toppings/".$filename;
		$location="../../images/toppings/".$filename;

		// if folder doesn't exist -> create one
        if(!file_exists("../../images/toppings")){
           mkdir("../../images/toppings",0700,true);                
        }

		move_uploaded_file($_FILES['image']['tmp_name'],$location);
	}

    $query = "SELECT topping_category_id FROM toppingscategory where topping_category_name= '$topping_cat'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);

    $cat_id = $row["topping_category_id"];


	$query = "INSERT INTO `toppings` (`topping_name`,`topping_image`,`topping_price`,`topping_category_id`) VALUES ('$topping_name','$img','$topping_price','$cat_id')";

	mysqli_query($conn,$query);
	header("Refresh: 0;");

} 

if(isset($_POST["update_info"])) { 

	$new_topping_name = trim($_POST['tn']);
    $new_topping_price = trim($_POST['tp']);

    $new_topping_cat= trim($_POST['tc']);


	$id = $_POST['hidden_id'];

        // manager didn't change topping category
        if($new_item_menu != "select..."){

            $query = "SELECT topping_category_id from toppingscategory where topping_category_name='$new_topping_cat'";
            $result = mysqli_query($conn,$query);
            $row = mysqli_fetch_assoc($result);

            $query = "UPDATE toppings set topping_category_id='".$row['topping_category_id']."' WHERE topping_id=$id";

            mysqli_query($conn,$query);

        }
        
        // manager changed the photo
        if($_FILES['new_image']['size'] > 0){
            $filename=$_FILES['new_image']['name'];

            $location="../../images/toppings/".$filename;
            $img = "images/toppings/".$filename;

            move_uploaded_file($_FILES['new_image']['tmp_name'],$location);

            $query = "UPDATE toppings set topping_image='".$img."' WHERE topping_id=$id";

            mysqli_query($conn,$query);
		}

		// update all other infos
		$query = "UPDATE toppings set topping_name='".$new_topping_name."',
									topping_price='".$new_topping_price."'
									WHERE topping_id=$id";

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
			$section="Toppings";
			
			include('../includes/top_navbar.php'); ?>
		
			<div class="main-content">
				<div id="tabbed_box" class="tabbed_box">
					
					<h4>Manage Toppings</h4>
					<hr />

					<div class="tabbed_area">

						<ul class="tabs">
							<li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">View Toppings</a></li>
							<li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">Add Topping</a></li>
						</ul>

<!--##################################################################################### 
	View toppings
	##################################################################################### -->

						<div id="content_1" class="content">
							<div class="row ">
								<div class="col-lg-12 col-md-12">
									<div class="card">
										
										<div class="card-content">
                                        

                                        
                                        <?php 

                                        // fetch all toppings items
                                        $query = "SELECT topping_category_name FROM toppingscategory";
                                        $result = mysqli_query($conn,$query); 

                                            
                                        echo "<select class='menu-tabs2'>";
                                        while($row = mysqli_fetch_assoc($result)){ ?>
                                                    <option class="menu-tab-item" data-target="#<?php echo $row['topping_category_name'] ?>">
                                                        <?php echo $row['topping_category_name'] ?>
                                                    </option> 
                                                    
                                        <?php }

                                       echo "</select>";


                                         $query = "SELECT topping_id, topping_name, topping_price, topping_image,t1.topping_category_id,topping_category_name 
                                       FROM toppings t1,toppingscategory t2 WHERE t1.topping_category_id=t2.topping_category_id";


                                        $result = mysqli_query($conn,$query);   ?>

                                        <div class="toppings">
                                    

                                        <?php
                                        while($row = mysqli_fetch_assoc($result)){ ?>
                                                
                                            
                                                    <div class="toppings_info topping_<?php echo $row['topping_id']; ?> <?php if($row['topping_category_id'] == 1){echo 'show';} ?>"  id="<?php  echo $row['topping_category_name']; ?>">
                                                        <div class="topping-img">
                                                            <img id="image_<?php  echo $row['topping_id']; ?>" src="../../<?php echo $row['topping_image'] ?>">
                                                        </div>

                                                        <div class="card-title">
                                                            <span  id="name_<?php echo $row['topping_id']; ?>"><?php echo $row['topping_name'] ?></span>
                                                        
                                                            <span>price:<span class="topping-price" id="price_<?php  echo $row['topping_id']; ?>"><?php echo $row['topping_price'] ?>$</span></span>
                                                        </div>

                                                        <div class="card-button">
                                                            <button class="update_topping" id="<?php echo $row['topping_id'] ?>">
                                                                <span class="iconify" data-icon="bx:edit" style="color: green;" data-width="30" data-height="30"></span>
                                                            </button> 
                                                            <button class="delete_topping" id="<?php echo $row['topping_id'] ?>">
                                                                <span class="iconify" data-icon="fluent:delete-24-filled" style="color: red;" data-width="30" data-height="30"></span>
                                                            </button>
                                                            
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
	add a new topping
	##################################################################################### -->
						
						<div id="content_2" class="content">
						
							<form  action="" method="post" enctype="multipart/form-data">
								<table width="220" height="106" border="0">
                                    <tr>
										<td align="center"><input name="image" type="file" style="width:100%"  required="required" id="uploadFile" accept=".jpg, .jpeg, .png" /></td>
									</tr>
									<tr>
										<td align="center"><input name="name" type="text" style="width:100%" placeholder="Topping Name" required="required" id="add_topping_name" /></td>
									</tr>
									<tr>
										<td align="center"><input name="price" type="text" style="width:100%" placeholder="Price" required="required" id="add_topping_price" /></td>
									</tr>
								
                                    <tr>
                                        <td>
                                    <?php
                                        $query = "SELECT topping_category_name FROM toppingscategory";
                                        $result = mysqli_query($conn,$query); 
                                        echo "Topping category: ";    
                                        echo "<select name='menu'>";
                                        while($row = mysqli_fetch_assoc($result)){ ?>
                                                    <option>
                                                        <?php echo $row['topping_category_name'] ?>
                                                    </option> 
                                                    
                                        <?php }  
                                        
                                        echo "</select>";?>
                                        </td>
                                    </tr>
									

									<tr>
										<td align="right"><input type="submit" value="add" name="submit" class="add_topping" /></td>
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
        a popup modal appears -> let the manager update a topping
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
															<label class="col-sm-3 col-md-4 control-label">Topping Name</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="tn" id="tn"  required="required">                     
															</div>
														</div>

                                                        <div class="form-group"> 
															<label class="col-sm-3 col-md-4 control-label">Topping price</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="tp" id="tp"  required="required">                     
															</div>
														</div>

                                                    
                                                        <div class="form-group"> 
															<label class="col-sm-3 col-md-4 control-label">Topping category:</label>
															<div class="col-sm-8">
                                                            <?php
                                                                $query = "SELECT topping_category_name FROM toppingscategory";
                                                                $result = mysqli_query($conn,$query); 
                            
                                                                echo "<select name='tc' id='tc'>";
                                                                echo "<option style='display:none;'>select...</option>";
                                                                while($row = mysqli_fetch_assoc($result)){ ?>
                                                                            <option>
                                                                                <?php echo $row['topping_category_name'] ?>
                                                                            </option> 
                                                                            
                                                                <?php }  
                                                                
                                                                echo "</select>";?>
																                     
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




<!-- toppings select -->
<script>

const menuTabs2 = document.querySelector('.menu-tabs2');

menuTabs2.addEventListener("change",function(e){
    if(e.target.options[e.target.options.selectedIndex].classList.contains("menu-tab-item") && !e.target.options[e.target.options.selectedIndex].classList.contains("show")){
    const target = e.target.options[e.target.options.selectedIndex].getAttribute("data-target");

    const toppingsSection = document.querySelector('.toppings');

    //select all specific items of the old menu and remove the class show 
    toppingsSection.querySelectorAll(".toppings_info.show").forEach(function(e){
      e.classList.remove("show");
    });

    //select all specific items of the targeted menu and add the class show 
    toppingsSection.querySelectorAll(target).forEach(function(e){
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


