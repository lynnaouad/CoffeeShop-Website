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

    <!-- font awesome css cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

	<!--  Iconify SVG framework link -->
    <script src="https://code.iconify.design/2/2.2.1/iconify.min.js"></script>

	<!-- custom css file link  -->
    <link rel="stylesheet" href="../css/custom.css">
	<link rel="stylesheet" href="../css/sidebar.css">
	<link rel="stylesheet" href="../css/top_navbar.css">

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
		include('../includes/manager_sidebar.php'); ?>


        <div id="content">
		
        <?php 
			$section="Reviews";
			
			include('../includes/top_navbar.php'); ?>
		
			<div class="main-content">
                <h4>View All Reviews</h4>
				<hr />

                <div class="stars_container">
                    <div class="star_element">
                        <i class="fas fa-star submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                        <span> 1 star reviews</span>
                    </div>

                    <div class="star_element">
                         <i class="fas fa-star submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                         <span> 2 star reviews </span>
                        </div>

                    <div class="star_element">
                      <i class="fas fa-star submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                      <span> 3 star reviews </span>
                    </div>

                    <div class="star_element">
                         <i class="fas fa-star submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                         <span> 4 star reviews </span>
                    </div>
                    
                    <div class="star_element">
                         <i class="fas fa-star submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                         <span> 5 star reviews </span>
                    </div>
                 
                </div>

                <hr />
                <h4>Statistics & Reports</h4>
				<hr />

                <div class="reviews_stat">

                    <?php

                        // get the nb of people who rated in a specific month
                        // get the nb of stars

                        $month_array = array_fill(0,12,0);
                        $average_rating_month_array = array_fill(0,12,0);
                        $star_array = array_fill(0,5,0);
                        
                        $query = "SELECT user_rating,datetime From review_table where datetime LIKE CONCAT('%-%-',YEAR(CURRENT_DATE));";
                        $result = mysqli_query($conn,$query);

                        while($row = mysqli_fetch_assoc($result)){
                            $values = explode('-',$row["datetime"]);    // date: 3-6-2022
                            $monthValue = $values[1];
                            $starValue = $row["user_rating"];
                            
                            switch($monthValue){
                                case 1: $month_array[0]++; $average_rating_month_array[0]+=$starValue; break;
                                case 2: $month_array[1]++; $average_rating_month_array[1]+=$starValue; break;
                                case 3: $month_array[2]++; $average_rating_month_array[2]+=$starValue; break;
                                case 4: $month_array[3]++; $average_rating_month_array[3]+=$starValue; break;
                                case 5: $month_array[4]++; $average_rating_month_array[4]+=$starValue; break;
                                case 6: $month_array[5]++; $average_rating_month_array[5]+=$starValue; break;
                                case 7: $month_array[6]++; $average_rating_month_array[6]+=$starValue; break;
                                case 8: $month_array[7]++; $average_rating_month_array[7]+=$starValue; break;
                                case 9: $month_array[8]++; $average_rating_month_array[8]+=$starValue; break;
                                case 10: $month_array[9]++;$average_rating_month_array[9]+=$starValue; break;
                                case 11: $month_array[10]++; $average_rating_month_array[10]+=$starValue; break;
                                case 12: $month_array[11]++; $average_rating_month_array[1]+=$starValue; break;
                            }

                            

                            switch($starValue){
                                case 1: $star_array[0]++; break;
                                case 2: $star_array[1]++; break;
                                case 3: $star_array[2]++; break;
                                case 4: $star_array[3]++; break;
                                case 5: $star_array[4]++; break;    
                            }
                        }

                        for($i=0; $i<12; $i++){

                            if($month_array[$i] != 0)
                                 $average_rating_month_array[$i] = number_format($average_rating_month_array[$i]/$month_array[$i],1);
                                
                            }

                        $month_array = implode('-',$month_array);
                        $star_array = implode('-',$star_array); 
                        $average_rating_month_array = implode('-',$average_rating_month_array);   
                    ?>

                    <input type="hidden" id="hidden-year" value=<?php echo $values[2]; ?> />
                    <input type="hidden" id="hidden-stats" value=<?php echo $month_array; ?> />
                    <input type="hidden" id="hidden-stars" value=<?php echo $star_array; ?> />
                    <input type="hidden" id="hidden-average" value=<?php echo $average_rating_month_array; ?> />
                    
                    <div class="container1">
                        <div> 
                            <canvas id="myChart" style="width:40vw; "></canvas>
                        </div>

                        <button class="status">
                            <span class="shadow"></span>
                            <span class="edge"></span>
                            <span class="front text"> View Status
                            </span>
                        </button>

                    </div>

                    <div style="position:relative; width:40vw; "> 
                        <canvas id="myChart2" ></canvas>
                    </div>

                </div>

                


			</div>
		</div>
</div>


<!--##################################################################################### 
        when the manager click on star button
        a popup modal appears -> let the manager view all reviews
    ##################################################################################### -->

    <div id="add_modal" class="modal fade" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">

            <!-- modal title -->
            <div class="modal-header">
                <h3 class="modal-title" id="NAME"></h3>
	      	</div>

            <!--  modal body -->
			<form method="post" class="form-horizontal">
				<div class="modal-body">   
					<div class="content-wrapper">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">	
									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-default">
												<div class="panel-body">
		
                                                    <div class="review"> </div>
                 	
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> 					
					</div>

					<div class="modal-footer">
						<input class="btn btn-primary" type="button" name="cancel" id="cancel" value="Cancel">
					</div>
				</div>
			</form>
    	</div>
  	</div>
</div>

<!--##################################################################################### 
        when the manager click on status button
        a popup modal appears -> let the manager view shop status
    ##################################################################################### -->

    <div id="add_modal2" class="modal fade" tabindex="-1" role="dialog">
  	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    	<div class="modal-content">

            <!-- modal title -->
            <div class="modal-header">
                <h3 class="modal-title" id="NAME"></h3>
	      	</div>

            <!--  modal body -->
			<form method="post" class="form-horizontal">
				<div class="modal-body">   
					<div class="content-wrapper">
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">	
									<div class="row">
										<div class="col-md-12">
											<div class="panel panel-default">
												<div class="panel-body">
		
                                                <div style="position:relative; width:50vw; "> 
                                                    <canvas id="myChart3" ></canvas>
                                                </div>

                                                <div class="status_info">
                                                    <h2 class="status_elm">Total average</h2>
                                                    <hr />

                                                    <h3 class="status_elm2"></h3>

                                                </div>
                                                
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> 					
					</div>

					<div class="modal-footer">
						<input class="btn btn-primary" type="button" name="cancel" id="cancel2" value="Cancel">
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

<!-- chart.js file -->
<script src="../../plugins/chart.js-3.7.1/chart.min.js"></script>

<script src="../js/script.js" type="text/javascript"></script>
<script src="../js/charts.js" type="text/javascript"></script>
  

</body>
  
</html>


