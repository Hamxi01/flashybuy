<?php
include('include/header.php'); 
include('include/nav.php');
?>
<div class="main-content">
<section class="section">
   <div class="section-body">
   <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
         <form method="post" action="">
         <div class="card">
            <div class="card-header">
               <h4>Vendor Information <i class="fa fa-user"></i></h4>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <label>Store Display Name</label>
                        <input type="text" name="store_name" placeholder="Store Display Name" class="form-control col-md-12">
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="card">
            <div class="card-header">
               <h4>Contact Details <i class="fa fa-user"></i></h4>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="name" placeholder="First Name" class="form-control col-md-12">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lastname" placeholder="Last Name" class="form-control col-md-12">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Telephone Number</label>
                        <input type="text" name="name" placeholder="Telephone Number" class="form-control col-md-12">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Cell Phone</label>
                        <input type="text" name="name" placeholder="Cell Phone" class="form-control col-md-12">
                     </div>
                  </div>
               </div>
            </div>
         </div>
          <div class="card">
            <div class="card-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Seller Id</label>
                        <input type="text" name="seller_id" placeholder="Seller Id" class="form-control col-md-12">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Seller Email</label>
                        <input type="text" name="bank" placeholder="Bank" class="form-control col-md-12">
                     </div>
                  </div>
                  <div class="card-header">
               <h4>Busineess Details  <i class="fa fa-user"></i></h4>
            </div>
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Legal Name</label>
                        <input type="text" name="legal_name" placeholder="Legal Name" class="form-control col-md-12">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Registration Number</label>
                        <input type="text" name="cr_number" placeholder="Company Registration Number" class="form-control col-md-12">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>VAT Number</label>
                        <input type="text" name="vat_number" placeholder="VAT Number" class="form-control col-md-12">
                     </div>
                  </div>

                   <div class="card-header">
               		<h4>Active  <i class="fa fa-user"></i></h4>
            		</div>

            		<div class="col-md-6">
                     <div class="form-group">
                        <label>Active</label>
                        <select class="form-control" name="cmb_acctive">
                        	<option value="">Select Active</option>
                        	<option value="1">YES</option>
                        	<option value="0">NO</option>
                        </select>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Courier Permision</label>
                        <select class="form-control" name="cmb_courier">
                        	<option value="">Select Active</option>
                        	<option value="1">YES</option>
                        	<option value="0">NO</option>
                        </select>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Bulk Upload Permision</label>
                        <select class="form-control" name="bulk_perm">
                        	<option value="">Select Active</option>
                        	<option value="1">YES</option>
                        	<option value="0">NO</option>
                        </select>
                     </div>
                  </div>


                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Second Hand Product</label>
                        <select class="form-control" name="second_hand">
                        	<option value="">Select Active</option>
                        	<option value="1">YES</option>
                        	<option value="0">NO</option>
                        </select>
                     </div>
                  </div>


	               <div class="col-md-6">
	               	<button type="submit" class="btn btn-warning">Transaction</button>
	               	<button type="submit" class="btn btn-warning">Inventory</button>
	               	<button type="submit" class="btn btn-warning">Orders</button>
	               </div>   

               </div>
            </div>
         </div>



         <div class="card">
            <div class="card-header">
               <h4>Bank Details  <i class="fa fa-user"></i></h4>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Account Holder</label>
                        <input type="text" name="account_holder" placeholder="Account Holder" class="form-control col-md-12">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Bank</label>
                        <input type="text" name="bank" placeholder="Bank" class="form-control col-md-12">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Bank Account</label>
                        <input type="text" name="account" placeholder="Bank Account" class="form-control col-md-12">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Branch Name</label>
                        <input type="text" name="branch" placeholder="Branch Name" class="form-control col-md-12">
                     </div>
                  </div>

                   <div class="col-md-6">
                     <div class="form-group">
                        <label>Branch Code</label>
                        <input type="text" name="branch" placeholder="Branch Name" class="form-control col-md-12">
                     </div>
                  </div>


               </div>
            </div>
         </div>

         <div class="card">
            <div class="card-header">
               <h4>Business Address  <i class="fa fa-location-picker"></i></h4>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Address</label>
                        <textarea name="account_holder" placeholder="Address"class="form-control col-md-12" style="resize: none"></textarea>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Street</label>
                        <input type="text" name="street" placeholder="Enter Street" class="form-control col-md-12">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Route</label>
                        <input type="text" name="street" placeholder="Street" class="form-control col-md-12">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>State</label>
                        <input type="text" name="state" placeholder="State" class="form-control col-md-12">
                     </div>
                  </div>

                   <div class="col-md-6">
                     <div class="form-group">
                        <label>Postal Code</label>
                        <input type="text" name="postal_code" placeholder="Postal Code" class="form-control col-md-12">
                     </div>
                 </div>

                     <div class="col-md-6">
                     <div class="form-group">
                        <label>Country</label>
                        <input type="text" name="country" placeholder="Country" class="form-control col-md-12">
                     </div>

                  </div>


               </div>
            </div>
         </div>


          <div class="card">
            <div class="card-header">
               <h4>Wear House Detail/Collection Address  <i class="fa fa-location-picker"></i></h4>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Address</label>
                        <textarea name="account_holder" placeholder="Address"class="form-control col-md-12" style="resize: none"></textarea>
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Street</label>
                        <input type="text" name="street" placeholder="Enter Street" class="form-control col-md-12">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Route</label>
                        <input type="text" name="street" placeholder="Street" class="form-control col-md-12">
                     </div>
                  </div>

                  <div class="col-md-6">
                     <div class="form-group">
                        <label>State</label>
                        <input type="text" name="state" placeholder="State" class="form-control col-md-12">
                     </div>
                  </div>

                   <div class="col-md-6">
                     <div class="form-group">
                        <label>Postal Code</label>
                        <input type="text" name="postal_code" placeholder="Postal Code" class="form-control col-md-12">
                     </div>
                 </div>

                     <div class="col-md-6">
                     <div class="form-group">
                        <label>Country</label>
                        <input type="text" name="country" placeholder="Country" class="form-control col-md-12">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         </div>


      </div>   
</section>
</div>

<?php include('include/footer.php'); ?>