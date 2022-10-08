
<nav id="sidebar">
            <div class="sidebar-header">
                <h3><img src="../../images/managers/<?php echo $_SESSION['manager_image'] ?>" class="img-fluid"/><span><?php echo $_SESSION['manager_username'] ?></span></h3>
            </div>

            <ul class="list-unstyled components">
                <li  class="active">
                        <a href="manager_dashboard.php" class="dashboard"><i class="material-icons">dashboard</i><span>Dashboard</span></a>
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
                    <a href="manager_menu.php"><i class="material-icons">menu_book</i><span>Menu Categories</span></a>
                </li>

                <li class="">
                    <a href="manager_menuItems.php"><i class="material-icons">coffee</i><span>Menu Items</span></a>
                </li>

                <li class="">
                    <a href="manager_toppingsCategory.php"><i class="material-icons">menu</i><span>Toppings Categories</span></a>
                </li>

                <li class="">
                    <a href="manager_toppings.php"><i class="material-icons">widgets</i><span>Toppings Items</span></a>
                </li>

                 <li class="">
                    <a href="manager_addOffers.php"><i class="material-icons">menu</i><span>Offers</span></a>
                </li>

                <li class="">
                    <a href="view_reviews.php"><i class="material-icons">reviews</i><span>Reviews</span></a>
                </li>





				
				
				
               
               
               
               
            </ul>
</nav>

