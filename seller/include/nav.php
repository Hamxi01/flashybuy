 <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> 
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Bank Details</li>
            <li class="dropdown active">
              <a href="index.html" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
          
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Seller</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="chat.html">Seller Details</a></li>
                
                <li><a class="nav-link" href="blog.html">Blog</a></li>
                <li><a class="nav-link" href="calendar.html">Calendar</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Products</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="products.php">Products</a></li>
                <li><a class="nav-link" href="addingproduct.php">Add new Products</a></li>
                <li><a class="nav-link" href="pendingProduct.php">Pending Products</a></li>
              </ul>
            </li>
              <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Admin</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="Permissions.php">Permissions</a></li>
                <li><a class="nav-link" href="blog.html">View Update Request</a></li>
                <li><a class="nav-link" href="blog.html">Seller Verification Form</a></li>
              </ul>
            </li>


             <li class="dropdown">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Front End</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="view_crousel.php">Main Banners</a></li>
                <li><a class="nav-link" href="view_banner.php">Banner</a></li>
                <li><a class="nav-link" href="view_social.php">Social Media</a></li>
                <li><a class="nav-link" href="signup_page_content.php">Signup Form Content</a></li>
                
                <li><a class="nav-link" href="manage_footer.php">Footer</a></li>
              </ul>
            </li>
            <?php 

                $sql = mysqli_query($con, "SELECT * From vendor where id = $vendor_id");
                $row = mysqli_num_rows($sql);
                while ($row = mysqli_fetch_array($sql)){
                  if($row['courier_permission']=='Y'){
            ?>
              <li class="dropdown">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="command"></i><span>Courier Sizes</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="addcouriersizes.php">Add Courier Sizes</a></li>
                  <li><a class="nav-link" href="couriersizes.php">Courier Sizes</a></li>
                </ul>
              </li>
            <?php } } ?>


          </ul>
        </aside>
      </div>