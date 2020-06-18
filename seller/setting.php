<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php'); 


     if(isset($_POST['update'])){

        $id           = $_POST['id'];
        $bank_name    = $_POST['bank_name'];
        $bank_account = $_POST['bank_account'];
        $bank_branch  = $_POST['bank_branch'];
        $branch_code  = $_POST['branch_code'];
        $password     = $_POST['password'];

            if (empty($password)) {
              
              $sql = "update vendor SET bank_name='".$bank_name."',bank_account='".$bank_account."',bank_branch='".$bank_branch."',branch_code='".$branch_code."',t_permission='N' Where id='".$id."'";
            }else{

              $sql = "update vendor SET bank_name='".$bank_name."',bank_account='".$bank_account."',bank_branch='".$bank_branch."',branch_code='".$branch_code."',t_permission='N',pasword='".md5($password)."' Where id='".$id."'";
            }
            if (mysqli_query($con,$sql)) {

              $vaSql = mysqli_query($con,"INSERT into vendor_activity (description,ven_id) VALUES ('You changed your Bank Settings.','$id')");
              echo "<script>window.location.assign('setting.php?msg=success');</script>";
            }

     }

?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
 <!-- Start Showing success or warning Msg -->
<?php
if (isset($_GET['msg']) && $_GET['msg'] =="error") {?>
    <div class="row">
        <div class="col-lg-4 col-sm-offset-3">
            <div class="alert alert-danger msg">    
              <span>These values are already Exists.</span>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
if (isset($_GET['msg']) && $_GET['msg'] =="success") { ?>
<div class="row">
    <div class="col-lg-6 col-sm-offset-3">
        <div class="alert alert-success msg">    
          <span>Values are added successfully.</span>
        </div>
    </div>
</div>
<?php 
}
?>
<?php 

$vSql = mysqli_query($con,"SELECT * FROM vendor where id='$vendor_id'");
while ($vRes = mysqli_fetch_array($vSql)) {
 
            $bank_name            = $vRes['bank_name'];
            $bank_account         = $vRes['bank_account'];
            $bank_branch          = $vRes['bank_branch'];
            $branch_code          = $vRes['branch_code'];
}

?>
<!-- End Message Alert --> 

          <form action=""  method="post" >           
            <div class="row">
              <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                      <h4>Edit Your Bank Details</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <input type="hidden" name="id" value="<?=$vendor_id?>">
                        <label>Bank Name</label>
                        <input type="text" name="bank_name" class="form-control" value="<?=$bank_name?>">
                      </div>
                      <div class="form-group">
                        <label>Bank Branch</label>
                        <input type="text" name="bank_branch" class="form-control" value="<?=$bank_branch?>">
                      </div>
                      <div class="form-group">
                        <label>Account Number</label>
                        <input type="text" name="bank_account" class="form-control" value="<?=$bank_account?>">
                      </div>
                      <div class="form-group">
                        <label>Branch Code</label>
                        <input type="text" name="branch_code" class="form-control" value="<?=$branch_code?>">
                      </div>
                    </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                      <h4>Change Your Password</h4>
                    </div>
                    <div class="card-body">
                      <div class="form-group">
                        <input type="hidden" name="id" value="<?=$vendor_id?>">
                        <label>Change Password</label>
                        <input type="password" name="password" id="ven_password" class="form-control" onkeyup="CheckPasswordStrength(this.value)" maxlength="18">
                        <span id="password_strength" style="font-size:18px"></span>
                      </div>
                      <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password"  class="form-control" oninput="abc()"  id="con_ven_password">
                        <span id="errormsg" class="text text-danger"></span>
                      </div>
                    </div>
                    <div class="card-footer text-right">
                      <button class="btn btn-primary" type="submit" name="update">Submit</button>
                    </div>
                </div>
              </div>
          </div>
         </form>
        </section>
      </div>  
        <?php include('includes/footer.php') ?>
<script type="text/javascript">
    $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
    });
    function abc(){

        var ven_password          = $("#ven_password").val();
        var con_ven_password      = $("#con_ven_password").val();

        if( ven_password != ""  ){
          if( ven_password != con_ven_password ){

            $('#errormsg').html("Please note password and confirm password should match");
          }
          
        }
    }
function CheckPasswordStrength(password) {
      var password_strength = document.getElementById("password_strength");

 
        //if textBox is empty
        if(password.length==0){
            password_strength.innerHTML = "";
            return;
        }

        //Regular Expressions
        var regex = new Array();
        regex.push("[A-Z]"); //For Uppercase Alphabet
        regex.push("[a-z]"); //For Lowercase Alphabet
        regex.push("[0-9]"); //For Numeric Digits
        regex.push("[$@$!%*#?&]"); //For Special Characters

        var passed = 0;

        //Validation for each Regular Expression
        for (var i = 0; i < regex.length; i++) {
            if((new RegExp (regex[i])).test(password)){
                passed++;
            }
        }

        //Validation for Length of Password
        if(passed > 2 && password.length > 8){
            passed++;
        }

        //Display of Status
        var color = "";
        var passwordStrength = "";
        switch(passed){
            case 0:
                break;
            case 1:
                passwordStrength = "Weak";
                color = "Red";
                break;
            case 2:
                passwordStrength = "Good";
                color = "darkorange";
                break;
            case 3:
                break;
            case 4:
                passwordStrength = "Strong";
                color = "Green";
                break;
            case 5:
                passwordStrength = "Excellent";
                color = "darkgreen";
                break;
        }
       
      $("#password_strength_chk").val( passwordStrength );
      password_strength.innerHTML = passwordStrength;
        password_strength.style.color = color;
    }

    
</script>        