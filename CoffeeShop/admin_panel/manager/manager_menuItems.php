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

	$item_name = trim($_POST['name']);
    $item_price = trim($_POST['price']);
    $item_description = trim($_POST['description']);
    $item_menu = trim($_POST['menu']);

	//upload image
	if(isset($_FILES['image']['name'])){
		$filename=$_FILES['image']['name'];

        $img = "images/".$item_menu."/".$filename;
		$location="../../images/".$item_menu."/".$filename;

		// if folder doesn't exist -> create one
        if(!file_exists("../../images/".$item_menu)){
           mkdir("../../images/".$item_menu,0700,true);
                 
        }

		move_uploaded_file($_FILES['image']['tmp_name'],$location);
	}

    $query = "SELECT menu_id FROM menu where menu_name = '$item_menu'";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);

    $menu_id = $row["menu_id"];


	$query = "INSERT INTO menuitem(`item_name`, `item_price`,`item_image`,`item_description`,`menu_id`) 
              VALUES ('$item_name','$item_price','$img','$item_description','$menu_id')";

	mysqli_query($conn,$query);
	header("Refresh: 0;");

} 

if(isset($_POST["update_info"])) { 

	$new_item_name = trim($_POST['in']);
    $new_item_price = trim($_POST['ip']);
    $new_item_description = trim($_POST['id']);

    $new_item_menu = trim($_POST['mc']);
    $old_item_menu = $_POST['hidden_menu'];

    $old_image_path= $_POST['hidden_image'];
	$old_image_name= explode('/',$old_image_path);

	$id = $_POST['hidden_id'];

    if($new_item_menu == "select..."){
        // manager didn't change menu category -> add new image into old category folder

		// if the image is changed 
		//     -> upload new image
		//     -> update image in database

        if($_FILES['new_image']['size'] > 0){
            $filename=$_FILES['new_image']['name'];

            $location="../../images/".$old_item_menu."/".$filename;
            $img = "images/".$old_item_menu."/".$filename;

            move_uploaded_file($_FILES['new_image']['tmp_name'],$location);

            $query = "UPDATE menuitem set item_image='".$img."' WHERE item_id=$id";

            mysqli_query($conn,$query);
		}

		// update all other infos
		$query = "UPDATE menuitem set item_name='".$new_item_name."',
									item_price='".$new_item_price."',
									item_description='".$new_item_description."'
									WHERE item_id=$id";

		mysqli_query($conn,$query);
		header("Refresh: 0;");
        
    }
    else{
        // manager did change menu category -> add new image into new category file


		// if the image is changed 
		//     -> upload new image
		//     -> update image in database

        if($_FILES['new_image']['size'] > 0){
            $filename=$_FILES['new_image']['name'];

            $location="../../images/".$new_item_menu."/".$filename;
            $img = "images/".$new_item_menu."/".$filename;

            move_uploaded_file($_FILES['new_image']['tmp_name'],$location);

            $query = "UPDATE menuitem set item_image='".$img."' WHERE item_id=$id";

            mysqli_query($conn,$query);
			header("Refresh: 0;");
	    }
        else{

			// if the image is changed 
			// 	   -> move image from old category folder to new category folder
			//     -> update image in database
					
			rename($old_image_path , "../../images/".$new_item_menu."/".$old_image_name[4]);
			$img = "images/".$new_item_menu."/".$old_image_name[4];

            $query = "UPDATE menuitem set item_image='".$img."' WHERE item_id=$id";

            mysqli_query($conn,$query);
			header("Refresh: 0;");

        }

        $query = "SELECT menu_id from menu where menu_name='$new_item_menu'";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_assoc($result);

	    $query = "UPDATE menuitem set item_name='".$new_item_name."',
                                  item_price='".$new_item_price."',
                                  item_description='".$new_item_description."',
                                  menu_id=".$row['menu_id']."
                        WHERE item_id=$id";

	mysqli_query($conn,$query);
	header("Refresh: 0;");

    }

}

?>


  
<div class="wrapper">
	<div class="body-overlay"></div>


        <?php 
	
		// sidebar
		include('../includes/manager_sidebar.php'); ?>


        <div id="content">
		
        <?php 
			$section="Menu Items";
			
			include('../includes/top_navbar.php'); ?>
		
			<div class="main-content">
				<div id="tabbed_box" class="tabbed_box">
					
					<h4>Manage Menu Items</h4>
					<hr />

					<div class="tabbed_area">

						<ul class="tabs">
							<li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">View Menu Items</a></li>
							<li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">Add Menu Item</a></li>
						</ul>

<!--##################################################################################### 
	View Menu Items
	##################################################################################### -->

						<div id="content_1" class="content">
							<div class="row ">
								<div class="col-lg-12 col-md-12">
									<div class="card">
										
										<div class="card-content">

                                        
                                        <?php 

                                        // fetch all menu items
                                        $query = "SELECT menu_name FROM menu";
                                        $result = mysqli_query($conn,$query); 
                                            
                                        echo "<select class='menu-tabs'>";
                                        while($row = mysqli_fetch_assoc($result)){ ?>
                                                    <option class="menu-tab-item" data-target="#<?php echo $row['menu_name'] ?>">
                                                        <?php echo $row['menu_name'] ?>
                                                    </option> 
                                                    
                                        <?php }

                                       echo "</select>";

                                       $query = "SELECT item_id,item_name,item_price,item_image,item_description,m1.menu_id,menu_name 
                                       FROM menuitem m1,menu m2 WHERE m1.menu_id=m2.menu_id";
                                        $result = mysqli_query($conn,$query);   ?>

                                        <div class="menuItems">

                                        <?php
                                        while($row = mysqli_fetch_assoc($result)){ ?>
                                                
                                                <div class="item_card item_<?php echo $row['item_id']; ?> <?php if($row['menu_id'] == 1){echo 'show';} ?>"  id="<?php  echo $row['menu_name']; ?>">
                                                    <div class="card-img">
                                                        <img id="image_<?php  echo $row['item_id']; ?>" src="../../<?php echo $row['item_image'] ?>">
                                                    </div>
                                                    <div class="card-info">
                                                        <p class="text-title" id="name_<?php echo $row['item_id']; ?>" ><?php echo $row['item_name'] ?></p>
                                                        <p class="text-body" id="desc_<?php  echo $row['item_id']; ?>"><?php echo $row['item_description'] ?></p>
                                                    </div>
                                                    <div class="card-footer">
                                                        <span class="text-title" >$<span id="price_<?php  echo $row['item_id']; ?>"><?php echo $row['item_price'] ?></span></span>
                                                        <div class="card-button">
                                                            <button class="update_item" id="<?php echo $row['item_id'] ?>">
                                                                <span class="iconify" data-icon="bx:edit" style="color: green;" data-width="30" data-height="30"></span>
                                                            </button> 
                                                            <button class="delete_item" id="<?php echo $row['item_id'] ?>">
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
	add a new menu item
	##################################################################################### -->
						
						<div id="content_2" class="content">
						
							<form  action="" method="post" enctype="multipart/form-data">
								<table width="220" height="106" border="0">
                                    <tr>
										<td align="center"><input name="image" type="file" style="width:100%"  required="required" id="uploadFile" accept=".jpg, .jpeg, .png" /></td>
									</tr>
									<tr>
										<td align="center"><input name="name" type="text" style="width:100%" placeholder="Item Name" required="required" id="add_item_name" /></td>
									</tr>
									<tr>
										<td align="center"><input name="price" type="text" style="width:100%" placeholder="Price" required="required" id="add_item_price" /></td>
									</tr>
									<tr>
										<td align="center"><input name="description" type="text" style="width:100%" placeholder="Description" required="required" id="add_item_description" /></td>
									</tr>

                                    <tr>
                                        <td>
                                    <?php
                                        $query = "SELECT menu_name FROM menu";
                                        $result = mysqli_query($conn,$query); 
                                        echo "Menu category: ";    
                                        echo "<select name='menu'>";
                                        while($row = mysqli_fetch_assoc($result)){ ?>
                                                    <option>
                                                        <?php echo $row['menu_name'] ?>
                                                    </option> 
                                                    
                                        <?php }  
                                        
                                        echo "</select>";?>
                                        </td>
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
        when the manager click on edit button
        a popup modal appears -> let the manager update an item in menu 
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
														<input type="hidden" name="hidden_image" id="hidden_image" value='' />  

														<div class="form-group">
															<img class="image" id="mi" src="" />
															<label class="col-sm-3 control-label">Click to change photo</label>
															<div class="col-sm-8">
																<input type="file" class="form-control new_image" name="new_image" id="new_image">                           
															</div>
														</div>

														<div class="form-group"> 
															<label class="col-sm-3 col-md-4 control-label">Item Name</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="in" id="in"  required="required">                     
															</div>
														</div>

                                                        <div class="form-group"> 
															<label class="col-sm-3 col-md-4 control-label">Item price</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="ip" id="ip"  required="required">                     
															</div>
														</div>

                                                        <div class="form-group"> 
															<label class="col-sm-3 col-md-4 control-label">Item description</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" name="id" id="id"  required="required">                     
															</div>
														</div>

                                                        <input type="hidden" value="" id="hidden_menu" name="hidden_menu" />

                                                        <div class="form-group"> 
															<label class="col-sm-3 col-md-4 control-label">Menu category:</label>
															<div class="col-sm-8">
                                                            <?php
                                                                $query = "SELECT menu_name FROM menu";
                                                                $result = mysqli_query($conn,$query); 
                            
                                                                echo "<select name='mc' id='mc'>";
                                                                echo "<option style='display:none;'>select...</option>";
                                                                while($row = mysqli_fetch_assoc($result)){ ?>
                                                                            <option>
                                                                                <?php echo $row['menu_name'] ?>
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


