<?php session_start(); ?>
 <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">

                    <div id="sidebar-menu">
                        <ul>
                            <li class="menu-title">Main</li>

                            <li>
                                <a href="index.html" class="waves-effect waves-primary"><i
                                        class="md md-dashboard"></i><span> Dashboard </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect waves-primary"><i class="fa fa-user"></i> <span>Profile Management </span>
                                 <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="manage_detail.php">Bank Details</a></li>
                                    <li><a href="manage_shop.php">Shop Details</a></li>
                                    <li><a href="profile.php">Profile Detail</a></li>
                                    
                                    
                                </ul>
                            </li>

                            
                           

                        </ul>
                        <div class="clearfix"></div>
                    </div>

                    <div class="clearfix"></div>
                </div>

                <div class="user-detail">
                    <div class="dropup">
                        <a href="" class="dropdown-toggle profile" data-toggle="dropdown" aria-expanded="true">
                            <?php if (isset($_SESSION['img'])=='') 
                            {
                               echo "<img  src='assets/images/users/avatar-2.jpg' alt='user-img' class='img-circle'>";
                            } 
                            else
                            {
                                echo "<img  src='profile/".$_SESSION['img']."' alt='user-img' class='img-circle'>";
                            }
                            ?>
                            
                            <span class="user-info-span">
                                <h5 class="m-t-0 m-b-0"><?= ucfirst($_SESSION['name']) ?></h5>
                                <p class="text-muted m-b-0">
                                    <small><i class="fa fa-circle text-success"></i> <span>Online</span></small>
                                </p>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)"><i class="md md-face-unlock"></i> Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="md md-settings"></i> Settings</a></li>
                            <li><a href="javascript:void(0)"><i class="md md-lock"></i> Lock screen</a></li>
                            <li><a href="javascript:void(0)"><i class="md md-settings-power"></i> Logout</a></li>
                        </ul>

                    </div>
                </div>
            </div>