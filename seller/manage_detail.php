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
                                        <li><a href="#">Manage Bank Detail</a></li>
                                        <li class="active">Manage Detail</li>
                                    </ol>
                                    <h4 class="page-title">Manage Bank Details</h4>
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
                                    $rec = $obj->get_bank_detail($id);
                                     while($fetch = mysqli_fetch_row($rec)){ ?>
                                                    <tr>
                                                    <th>S.No</th>
                                                    <th>1</th>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th>Acount Holder Name</th>
                                                        <td><?php echo $fetch[1] ?></td>
                                                    </tr>

                                                    <tr>
                                                    <th>Bank</th>
                                                    <td><?php echo $fetch[2] ?></td>
                                                    </tr>
                                                    <tr>
                                                    <th>Branch Name</th>
                                                    <td><?php echo $fetch[3] ?></td>    
                                                    </tr>
                                                    <tr>
                                                    <th>Branch Code</th>
                                                    <td><?php echo $fetch[4] ?></td>
                                                    </tr>
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
<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Update Bank Detail <i class="fa fa-bank"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="#">
            <div class="row">
            <div class="col-md-12">
            <div class="form-group">
                <label>Account Holder Name</label>
                <input type="hidden" name="detail_id" id="detail_id">
                <input type="text" name="acount_holder" id="acount_holder" class="form-control">
            </div>

             <div class="form-group">
                <label>Bank</label>
                <input type="text" name="bank" id="bank" class="form-control">
            </div>

             <div class="form-group">
                <label>Branch Name</label>
                <input type="text" name="branch_name" id="branch_name" class="form-control">
            </div>

             <div class="form-group">
                <label>Branch Code</label>
                <input type="text" name="branch_code" id="branch_code" class="form-control">
            </div>
                 <div class="modal-footer">
        
        <button style="float: left;" type="button" class="btn btn-warning">Save changes</button>
      </div>
            </div>
        </div>
        </div>
        </form>
      </div>
     
    </div>
  </div>
</div>


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