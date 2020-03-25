<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php'); 


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
                                        <li><a href="#">Forms</a></li>
                                        <li class="active">Multiple File Upload</li>
                                    </ol>
                                    <h4 class="page-title">Multiple File Upload</h4>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 portlets">
                                <!-- Your awesome content goes here -->
                                <div class="m-b-30">
                                    <form action="#" class="dropzone" id="dropzone">
                                      <div class="fallback">
                                        <input name="file" type="file" multiple />
                                      </div>

                                    </form>
                                    <div class="clearfix pull-right m-t-15">
                                      	<button type="button" class="btn btn-pink btn-rounded waves-effect waves-light">Submit</button>
                                  </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->



                    </div>
                    <!-- end container -->

                </div>
                <!-- end content -->



                <!-- FOOTER -->
                <?php 
                     include('includes/footer.php');
                ?>
