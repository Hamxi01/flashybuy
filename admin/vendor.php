<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php'); 


    $id = $_GET['vendor_id'];
     if(isset($_POST['edit-vendor'])){

            $id                 = $_POST['id'];
            $shop_name          = $_POST['shop_name'];
            $name               = $_POST['name'];
            $lastname           = $_POST['lastname'];
            $mobile             = $_POST['mobile'];
            $bank_name          = $_POST['bank_name'];
            $bank_account       = $_POST['bank_account'];
            $bank_branch        = $_POST['bank_branch'];
            $branch_code        = $_POST['branch_code'];
            $email              = $_POST['email'];
            $courier_permission = $_POST['courier_permission'];
            $exclusive          = $_POST['exclusive'];
            $second_product     = $_POST['second_product'];
            $company            = $_POST['company_name'];
            $registration_no    = $_POST['registration_no'];
            $vat_number         = $_POST['vat_number'];
            $address            = $_POST['address'];
            $city               = $_POST['city'];
            $state              = $_POST['state'];
            $street             = $_POST['street'];
            $subrub             = $_POST['subrub'];
            $zip                = $_POST['zip'];
            $country            = $_POST['country'];
            $waddress           = $_POST['waddress'];
            $wcity              = $_POST['wcity'];
            $wstate             = $_POST['wstate'];
            $wstreet            = $_POST['wstreet'];
            $wsubrub            = $_POST['wsubrub'];
            $wzip               = $_POST['wzip'];
            $wcountry           = $_POST['wcountry']; 

        $query = "update vendor SET name='".$name."',lastname='".$lastname."',shop_name='".$shop_name."',email='".$email."',mobile='".$mobile."',bank_name='".$bank_name."',bank_account='".$bank_account."',bank_branch='".$bank_branch."',branch_code='".$branch_code."',courier_permission='".$courier_permission."',exclusive_permission='".$exclusive."',s_p_permission='".$second_product."',company='".$company."',vat_number='".$vat_number."',business_reg='".$registration_no."',address='".$address."',city='".$city."',state='".$state."',street='".$street."',subrub='".$subrub."',zip='".$zip."',country='".$country."',waddress='".$waddress."',wcity='".$wcity."',wstate='".$wstate."',wstreet='".$wstreet."',wsubrub='".$wsubrub."',wzip='".$wzip."',wcountry='".$wcountry."' Where id='".$id."'";       
        
        if (mysqli_query($con,$query)){

            $sC = mysqli_query( $con , "DELETE FROM vendor_category WHERE ven_id = '$id'");
            
            $cat_chk  = $_REQUEST['cat_chk'];
            if( !empty( $cat_chk )){
              foreach( $cat_chk as $chk){
              
                $cat_price = $_REQUEST['cat_rate_' . $chk];
                $cv = "INSERT INTO vendor_category SET cat_id = '$chk' ,ven_id = '$id' , cat_percent = '$cat_price' ";
                mysqli_query( $con , $cv );
              }
            }

            echo "<script>window.location.assign('view-vendor.php');</script>";        }
        else{ 
            header("location:vendor.php?vendor_id=".$id);
        }

     }
        
$sR = mysqli_query( $con , "SELECT * FROM vendor_category WHERE ven_id = '$id'");
while( $rR = mysqli_fetch_array( $sR )){
  
  $venC[$rR["cat_id"]] = $rR["cat_percent"];
  $venCS[] = $rR["cat_id"];
}
//  Get brands data bases on id /////

     $sql = mysqli_query($con, "SELECT * From vendor WHERE id='$id'");
        $row = mysqli_num_rows($sql);
        while ($row = mysqli_fetch_array($sql)){

            $id                   = $row['id'];
            $shop_name            = $row['shop_name'];
            $name                 = $row['name'];
            $lastname             = $row['lastname'];
            $mobile               = $row['mobile'];
            $bank_name            = $row['bank_name'];
            $bank_account         = $row['bank_account'];
            $bank_branch          = $row['bank_branch'];
            $branch_code          = $row['branch_code'];
            $company_name         = $row['company'];
            $vat_number           = $row['vat_number'];
            $registration_no      = $row['business_reg'];
            $email                = $row['email'];
            $courier_permission   = $row['courier_permission'];
            $exclusive_permission = $row['exclusive_permission'];
            $secondhand           = $row['s_p_permission'];
            $address              = $row['address'];
            $city                 = $row['city'];
            $state                = $row['state'];
            $street               = $row['street'];
            $subrub               = $row['subrub'];
            $zip                  = $row['zip'];
            $country              = $row['country'];
            $waddress             = $row['waddress'];
            $wcity                = $row['wcity'];
            $wstate               = $row['wstate'];
            $wstreet              = $row['wstreet'];
            $wsubrub              = $row['wsubrub'];
            $wzip                 = $row['wzip'];
            $wcountry             = $row['wcountry'];

        }


?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
 <!-- Start Showing success or warning Msg -->
<?php
if (isset($error)) {?>
    <div class="row">
        <div class="col-lg-6 col-sm-offset-3">
            <div class="alert alert-warning msg">    
    <?php echo $error; ?>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
if (isset($msg)) { ?>
<div class="row">
    <div class="col-lg-6 col-sm-offset-3">
        <div class="alert alert-success msg">    
    <?php echo $msg; ?>

        </div>
    </div>
</div>
<?php 
}
?>

<!-- End Message Alert --> 
          
          <form method="post" action="" enctype="multipart/form-data">           
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                      <h4>Vendor</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                          <input type="hidden" name="id" value="<?=$id?>">
                          <label>Shop Name*</label>
                          <input type="text" name="shop_name" value="<?=$shop_name?>" class="form-control" required="">
                        </div>
                        <label>Contact Details:</label>
                        <div class="form-group">
                          <label>Email</label>
                          <input type="text" name="email" value="<?=$email?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Name*</label>
                          <input type="text" name="name" value="<?=$name?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lastname" value="<?=$lastname?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Mobile</label>
                          <input type="text" name="mobile" value="<?=$mobile?>" class="form-control" required="">
                        </div>
                        <div class="card-header">
                          <h4>Active</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                              <label>Courier Permission*</label>
                              <select name="courier_permission" class="form-control">
                            <?php if ($courier_permission == 'Y') {
                              echo '<option value="Y" selected>YES</option><option value="N">NO</option>';
                            }else{

                              echo '<option value="N" selected>NO</option><option value="Y">YES</option>';
                            } ?> 
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Exclusive Permission</label>
                              <select name="exclusive" class="form-control">
                              <?php if ($exclusive_permission == 'Y') {
                              echo '<option value="Y" selected>YES</option><option value="N">NO</option>';
                            }else{

                              echo '<option value="N" selected>NO</option><option value="Y">YES</option>';
                            } ?> 
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Second Hand Product</label>
                              <select name="second_product" class="form-control">
                              <?php if ($secondhand == 'Y') {
                              echo '<option value="Y" selected>YES</option><option value="N">NO</option>';
                            }else{

                              echo '<option value="N" selected>NO</option><option value="Y">YES</option>';
                            } ?> 
                              </select>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                      <h4>Bank Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                          <label>Bank Name*</label>
                          <input type="text" name="bank_name" value="<?=$bank_name?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Account No.</label>
                          <input type="text" name="bank_account" value="<?=$bank_account?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Bank Brnach</label>
                          <input type="text" name="bank_branch" value="<?=$bank_branch?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Branch Code</label>
                          <input type="text" name="branch_code" value="<?=$branch_code?>" class="form-control" required="">
                        </div>
                        <br><br><div class="card-header">
                          <h4>Business Details</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                              <label>Company Name*</label>
                              <input type="text" name="company_name" value="<?=$company_name?>" class="form-control" required="">
                            </div>
                            <div class="form-group">
                              <label>Registration No.</label>
                              <input type="text" name="registration_no" value="<?=$registration_no?>" class="form-control" required="">
                            </div>
                            <div class="form-group">
                              <label>VAT Number</label>
                              <input type="text" name="vat_number" value="<?=$vat_number?>" class="form-control" required="">
                            </div>
                        </div>
                        <br><div class="form-group">
                          <!-- <button class="btn btn-primary">Inventory</button> -->
                          <button class="btn btn-primary" type="button" onclick="window.location.href='transaction_vendor.php?vendor_id=<?=$id?>'">Transactions</button>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                      <h4>Business Adress</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                          <label>Address</label>
                          <input type="text" name="address" value="<?=$address?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>City</label>
                          <input type="text" name="city" value="<?=$city?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>State*</label>
                          <input type="text" name="state" value="<?=$state?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Street</label>
                          <input type="text" name="street" value="<?=$street?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Subrub</label>
                          <input type="text" name="subrub" value="<?=$subrub?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Postal Code</label>
                          <input type="text" name="zip" value="<?=$zip?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Country</label>
                          <input type="text" name="country" value="<?=$country?>" class="form-control" required="">
                        </div>
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                      <h4>WareHouse Address</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                          <label>Address</label>
                          <input type="text" name="waddress" value="<?=$waddress?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>City</label>
                          <input type="text" name="wcity" value="<?=$wcity?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>State*</label>
                          <input type="text" name="wstate" value="<?=$wstate?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Street</label>
                          <input type="text" name="wstreet" value="<?=$wstreet?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Subrub</label>
                          <input type="text" name="wsubrub" value="<?=$wsubrub?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Postal Code</label>
                          <input type="text" name="wzip" value="<?=$wzip?>" class="form-control" required="">
                        </div>
                        <div class="form-group">
                          <label>Country</label>
                          <input type="text" name="wcountry" value="<?=$wcountry?>" class="form-control" required="">
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="row" >
              <div class="col-lg-4" style="height:35px; background:#0080FF; padding:10px; color:#FFFFFF" >Category</div>
              <div class="col-lg-1" style="height:35px;background:#0080FF;padding:10px;color:#FFFFFF">Suggested</div>
              <div class="col-lg-1" style="height:35px;background:#0080FF;padding:10px;color:#FFFFFF">Perc%</div>
              <div class="col-lg-4" style="height:35px;background:#0080FF;padding:10px;color:#FFFFFF" >Category</div>
              <div class="col-lg-1" style="height:35px;background:#0080FF;padding:10px;color:#FFFFFF">Suggested</div>
              <div class="col-lg-1" style="height:35px;background:#0080FF;padding:10px;color:#FFFFFF">Perc%</div>
            </div>
            <div class="row" >
              <div class="col-lg-12" style="font-size:18px; color:#BBDDFF; font-weight: bold;  padding:10px; background:#1A4383; color:#FFFFFF" >
                <input type="checkbox" id="checkedAll" name="checkedAll" onclick="checkAll()"   />
                &nbsp;Select All </div>
            </div>
            <div class="row" style="padding:10px; background:#1A4383; color:#FFFFFF" id="checkboxes" >
                <?php foreach( $catArr as $ct => $category ){?>
                <div class="col-lg-4" style="height:50px;" >
                  <input type="checkbox" id="cat_chk" name="cat_chk[]" class="checkSingle" value="<?=$ct?>" <?php if(in_array( $ct , $venCS )){ echo "checked=checked"; $bold = 1; }else{ $bold = 0;}?>  />
                  &nbsp;&nbsp;
                  <?=( $bold == 1 ? "<span style='font-size:24px;color:#BBDDFF'><B>".$category."</B></span>" : $category )?>
                </div>
                <div class="col-lg-1" style="height:50px;">
                  <input type="text" id="cat_rate" name="cat_rate" value="<?=$catP[$ct]?>" class="form-control" disabled="disabled"  />
                </div>
                <div class="col-lg-1" style="height:50px;">
                  <input type="text" id="cat_rate_<?=$ct?>" name="cat_rate_<?=$ct?>" value="<?=( $venC[$ct] == "" ? $catP[$ct] :  $venC[$ct]) ?>" class="form-control" />
                </div>
                <?php } ?>
              </div>
          <div class="card-footer text-right">
             <button class="btn btn-warning" type="Submit" name="edit-vendor">Submit</button>
          </div>
        </form>  
        </section>
      </div>  
        <?php include('includes/footer.php') ?>
<script type="text/javascript">
    $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
    });
    function checkAll(){

  $("#checkedAll").change(function(){
    if(this.checked){
      $(".checkSingle").each(function(){
        this.checked=true;
      })              
    }else{
      $(".checkSingle").each(function(){
        this.checked=false;
      })              
    }
  });

  $(".checkSingle").click(function () {
    if ($(this).is(":checked")){
      var isAllChecked = 0;
      $(".checkSingle").each(function(){
        if(!this.checked)
           isAllChecked = 1;
      })              
      if(isAllChecked == 0){ $("#checkedAll").prop("checked", true); }     
    }else {
      $("#checkedAll").prop("checked", false);
    }
  });
}
</script>        