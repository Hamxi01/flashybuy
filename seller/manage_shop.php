<?php 
session_start();
$id = $_SESSION['id'];
/*exit();*/
include('../includes/db.php');
    $obj = new connection();
include('include/header.php');
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
                                        <li><a href="#">Flashy Buy</a></li>
                                        <li><a href="#">Manage Shop Detail</a></li>
                                        <li class="active">Manage Detail</li>
                                    </ol>
                                    <h4 class="page-title">Manage Shop Details</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
							<div class="col-lg-12">
								<div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>
                                    	<?php $count = $obj->check_record($id);
                                    	 	if ($count==true) 
                                    	 	{
                                    			echo ""; 		
                                    	 	}
                                    	 	else
                                    	 	{
                                    	 		echo "<a href='bank_detail.php' class='btn btn-success'>ADD<i class='fa fa-plus'></i></a></b></h4>";
                                    	 	}
                                    	 ?>
                                    <div class="table-responsive">
                                        <table class="table m-0">
                                            <thead>
                                                <tr>

                                    <?php
                                    $rec = $obj->get_shop_detail($id);
                                     while($fetch = mysqli_fetch_array($rec)){ ?>
                                                    <tr>
                                                    <th>S.No</th>
                                                    <th>1</th>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th>Address</th>
                                                        <td><?php echo $fetch[1] ?></td>
                                                    </tr>

                                                    <tr>
                                                    <th>Street</th>
                                                    <td><?php echo $fetch[2] ?></td>
                                                    </tr>
                                                    <tr>
                                                    <th>Rout</th>
                                                    <td><?php echo $fetch[3] ?></td>    
                                                    </tr>
                                                    <tr>
                                                    <th>Subrub</th>
                                                    <td><?php echo $fetch[4] ?></td>
                                                    </tr>
                                                     <tr>
                                                    <th>Postal Code</th>
                                                    <td><?php echo $fetch[5] ?></td>
                                                    </tr>
                                                     <tr>
                                                    <th>Country</th>
                                                    <td><?php echo $fetch[6] ?></td>
                                                    </tr>
                                                     <tr>
                                                    <th>City</th>
                                                    <td><?php echo $fetch[7] ?></td>
                                                    </tr>
                                                     <tr>
                                                    <tr>
                                                    <th>Action</th>
                                    <td><button type="button" id="<?php $fetch[0] ?>" class="btn btn-warning edit"><i class="fa fa-edit"></i></button></td>
                                                    </tr>
                                            </thead>
                                                <?php }?>
                                         <tbody>
                                          
                                        </table>
                                    </div>
								</div>
							</div>
						</div>
                    </div>
                    <!-- end container -->
                </div>
                <!-- end content -->

<!-- Update Modal -->



<!-- Modal -->



<!-- Update Modal End -->
                <!-- FOOTER -->
                <footer class="footer text-right">
                    2017 © Minton.
                </footer>
                <!-- End FOOTER -->

            </div>

            <div class="modal fade" id="message_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Warning Message</p>
      </div>

      <!--Body-->
      <div class="modal-body">

      <p>Your Are already enter bank detail..!</p>

      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        
        <a type="button" class="btn  btn-success waves-effect" data-dismiss="modal">Ok</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>


<script>
    $(document).ready(function(){
            $("#edit").click(function(){
                $("#update_modal").modal("show");
            });
    });

</script>
<?php include('include/footer.php') ?>