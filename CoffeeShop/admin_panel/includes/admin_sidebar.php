
<nav id="sidebar">
            <div class="sidebar-header">
                <h3><img src="../../images/admins/<?php echo $_SESSION['admin_image'] ?>" class="img-fluid"/><span><?php echo $_SESSION['admin_username'] ?></span></h3>
            </div>

            <ul class="list-unstyled components">
			<li  class="active">
                    <a href="admin_dashboard.php" class="dashboard"><i class="material-icons">dashboard</i><span>Dashboard</span></a>
            </li>
		
		    <div class="small-screen navbar-display">
                <li class="dropdown d-lg-none d-md-block d-xl-none d-sm-block">
                    <a href="#homeSubmenu0" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
					<i class="material-icons">notifications</i><span> 4 notification</span></a>
                    <ul class="collapse list-unstyled menu" id="homeSubmenu0">
                                    <li>
                                    <a href="#">You have 5 new messages</a>
                                    </li>
                                    <li>
                                        <a href="#">You're now friend with Mike</a>
                                    </li>
                                    <li>
                                        <a href="#">Wish Mary on her birthday!</a>
                                    </li>
                                    <li>
                                        <a href="#">5 warnings in Server Console</a>
                                    </li>
                    </ul>
                </li>
				
				<li  class="d-lg-none d-md-block d-xl-none d-sm-block">
                    <a href="#"><i class="material-icons">apps</i><span>apps</span></a>
                </li>
				
				 <li  class="d-lg-none d-md-block d-xl-none d-sm-block">
                    <a href="#"><i class="material-icons">person</i><span>user</span></a>
                 </li>
				
			   	 <li  class="d-lg-none d-md-block d-xl-none d-sm-block">
                    <a href="#"><i class="material-icons">settings</i><span>setting</span></a>
                 </li>
			</div>

                <li class="">
                    <a href="admin_managers.php"><i class="material-icons">people</i><span>Managers</span></a>
                </li>

                <li  class="">
                    <a href="admin_administrators.php"><i class="material-icons">people</i><span>Administrators</span></a>
                </li>
				
				<li  class="">
                    <a href="admin_team.php"><i class="material-icons">people</i><span>Team Members</span></a>
                </li>

                <li  class="">
                    <a href="view_reviews.php"><i class="material-icons">reviews</i><span>Reviews</span></a>
                </li>

                
			

			
               
               
               
               
            </ul>
</nav>