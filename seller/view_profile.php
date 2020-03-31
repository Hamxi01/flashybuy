<?php
session_start();
$_SESSION['id'];
include('../includes/db.php');
    $obj = new connection();
  $edit = mysqli_query($obj->connect(),"select * from vendor where id = ".$_SESSION['id']." ");  
  $row = mysqli_fetch_array($edit);

include('include/header.php') ;
include('include/nav.php');
?>

 <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <ol class="breadcrumb pull-right">
                                        <li><a href="#">Minton</a></li>
                                        <li><a href="#">Extras</a></li>
                                        <li class="active">Profile</li>
                                    </ol>
                                    <h4 class="page-title">Profile</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="text-center card-box">
                                    <div class="member-card">
                                        <div class="thumb-xl member-thumb m-b-10 center-block">
                                            <img src="<?php echo "profile/$row[20]" ?>" class="img-circle img-thumbnail" alt="profile-image">
                                        </div>

                                        <div class="">
                                            <h4 class="m-b-5"><?php echo $row[1] ?></h4>
                                            <p class="text-muted">@webdesigner</p>
                                        </div>

                                        <button type="button" class="btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light">Follow</button>
                                        <button type="button" class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light">Message</button>


                                        <div class="text-left m-t-40">
                                            <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">Johnathan Deo</span></p>

                                            <p class="text-muted font-13"><strong>Mobile :</strong><span class="m-l-15">(123) 123 1234</span></p>

                                            <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">coderthemes@gmail.com</span></p>

                                            <p class="text-muted font-13"><strong>Location :</strong> <span class="m-l-15">USA</span></p>
                                        </div>

                                        <ul class="social-links list-inline m-t-30">
                                            <li>
                                                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Facebook"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li>
                                                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Twitter"><i class="fa fa-twitter"></i></a>
                                            </li>
                                            <li>
                                                <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="" data-original-title="Skype"><i class="fa fa-skype"></i></a>
                                            </li>
                                        </ul>

                                    </div>

                                </div> <!-- end card-box -->

                                <div class="card-box">
                                    <h4 class="m-t-0 m-b-20 header-title">Skills</h4>

                                    <div class="p-b-10">
                                        <p>HTML5</p>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                            </div>
                                        </div>
                                        <p>PHP</p>
                                        <div class="progress progress-sm">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                            </div>
                                        </div>
                                        <p>Wordpress</p>
                                        <div class="progress progress-sm m-b-0">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end col -->


                            <div class="col-md-6">
                            	<h1>Vendor Detail</h1>
                            	<table class="table">
                            			<tr>
                            				<th>Name</th>
                            				<th><?php echo $row[1] ?></th>
                            			</tr>

                            			<tr>
                            				<th>Last Name</th>
                            				<th><?php echo $row[2] ?></th>
                            			</tr>

                            			<tr>
                            				<th>Last Name</th>
                            				<th><?php echo $row[2] ?></th>
                            			</tr>

                            			<tr>
                            				<th>Last Name</th>
                            				<th><?php echo $row[2] ?></th>
                            			</tr>

                            			<tr>
                            				<th>Last Name</th>
                            				<th><?php echo $row[2] ?></th>
                            			</tr>

                            			<tr>
                            				<th>Last Name</th>
                            				<th><?php echo $row[2] ?></th>
                            			</tr>

                            			<tr>
                            				<th>Last Name</th>
                            				<th><?php echo $row[2] ?></th>
                            			</tr>

                            			<tr>
                            				<th>Last Name</th>
                            				<th><?php echo $row[2] ?></th>
                            			</tr>

                            			<tr>
                            				<th>Last Name</th>
                            				<th><?php echo $row[2] ?></th>
                            			</tr>

                            	</table>
                                </div>

                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->



                    </div>
                    <!-- end container -->

                </div>
                <!-- end content -->



                <!-- FOOTER -->
                <footer class="footer text-right">
                    2017 © Minton.
                </footer>
                <!-- End FOOTER -->

            </div>

<?php include('include/nav.php') ?>