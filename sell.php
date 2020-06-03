<style>
    /********US-changes*****/
.ps-page--my-account.sell-pages a.logo-lg span {
  font-size: 24px;
  color: #000;
  margin-top: 0;
  margin-bottom: 20px;
  font-weight: 700;
  display: block;
}
.ps-page--my-account.sell-pages form .form-holder {
  display: flex;
  justify-content: center;
  align-items: flex-start;
  flex-wrap: wrap;
  margin: 0 -10px;
}
.ps-page--my-account.sell-pages form .form-holder .form-control {
    padding-left: 30px;
}
.ps-page--my-account.sell-pages form .form-holder .form-group {
  width: 50%;
  padding: 0 10px;
}
.ps-page--my-account.sell-pages form .form-holder .form-group .col-xs-12 {
    position: relative;
}
.ps-page--my-account.sell-pages form .form-holder .form-group i {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    left: 11px;
}
.ps-page--my-account.sell-pages form .heading {
    margin-bottom: 10px;
}
.radio-holder .form-group .radio-area {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    flex-wrap: wrap;
}
.radio-holder .form-group .radio-area .radio {
    width: 25%;
    display: flex;
    align-items: flex-start;
    margin-bottom: 5px;
}
.radio-holder .form-group .radio-area .radio label {
    margin: 0;
    padding-left: 7px;
}
@media (max-width:767.98px){
    .ps-page--my-account.sell-pages form .form-holder .form-group {
    width: 100%;
}
.ps-page--my-account.sell-pages .radio-holder .form-group .radio-area .radio {
    width: 50%;
}
.ps-page--my-account.sell-pages .form-group.submit {
    text-align: center;
}
}
</style>
<?php 
 include('includes/head.php');
include('includes/db.php');
?>
    <body>


    <div class="ps-page--my-account sell-pages">
     <div class="ps-my-account-2">
            <div class="container">
            <div class="ps-section__right">
                
                        
            <div class="text-center">
                <a href="#" class="logo-lg"><i class="md md-equalizer"></i> <span>Flashy Buy</span> </a>
            </div>

            <form class="ps-form--checkout" id="form_register" method="post" action="actions/seller_register.php">
                <div class="form-holder">
                <div class="form-group">
                    <div class="col-xs-12">
                        
                        <input class="form-control" type="text" id="firstname" name="firstname"placeholder="Firstname" tabindex="1">
                        <span id="lblError" class="text-danger"></span>
                        <p id="lbl_error"></p>

                        <i class="fa fa-user form-control-feedback l-h-34"></i>
                    </div>
                </div>


                 <div class="form-group">
                    <div class="col-xs-12">
                        
                        <input class="form-control" type="text"  id="lastname" name="lastname" placeholder="Lastname">
                        <span id="lastname" class="text-danger"></span>
                        <i class="fa fa-user form-control-feedback l-h-34"></i>
                    </div>
                </div>

                 <div class="form-group">
                    <div class="col-xs-12">
                        
                        <input class="form-control" type="text"  id="shp_name" name="shp_name" placeholder="Shop Name">
                        <span id="lastname" class="text-danger"></span>
                        <i class="fa fa-user form-control-feedback l-h-34"></i>
                    </div>
                </div>


                 <div class="form-group">
                    <div class="col-xs-12">
                        
                        <input class="form-control" type="email" id="email" name="email" onblur="checkMailStatus()"  placeholder="Email">
                              <span id="availability"></span>

                        <i class="fa fa-envelope form-control-feedback l-h-34"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">



                        <input class="form-control" type="text" data-mask="+27 000 000" id="mobile_number" name="mobile_number"  placeholder="Cell Phone Number (optional)">
                        <i class="fa fa-mobile form-control-feedback l-h-34"></i>
                    </div>
                </div>
                <div class="form-group">

                    <div class="col-xs-12">
                        <input class="form-control" type="text"  id="phone_number" name="phone_number" placeholder="Phone Number (optional)">
                        <i class="fa fa-phone form-control-feedback l-h-34"></i>
                    </div>
                </div>
                </div>
                <div class="heading">
                <h4>Tell us about your business</h4>
                </div>
                <div class="form-holder">
                <div class="form-group">
                    <div class="col-xs-12">
                        
                        <input class="form-control" type="text"  id="company" name="company" placeholder="Company Name">
                          <span id="lblcompany" class="text-danger"></span>
                        <i class="fa fa-bank form-control-feedback l-h-34"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        
                        <select name="category" id="category" class="form-control">
                        	<option value="">Select Category</option>
                        	<?php 
                        			$rec = mysqli_query($con,"select * from categories");
                        		while ($fetch= mysqli_fetch_array($rec)) 
                        		{
                        			echo "<option value='$fetch[0]'>$fetch[1]</option>";
                        		}
                        	?>

                        </select>
                        <i class="fa fa-list form-control-feedback l-h-34"></i>
                    </div>
                </div>

                 <div class="form-group">
                    <div class="col-xs-12">
                        
                        <input class="form-control" name="web" type="text" placeholder="Website">
                        <i class="fa fa-globe form-control-feedback l-h-34"></i>
                    </div>
                </div>

                   <div class="form-group">
                    <div class="col-xs-12">
                        
                        <input class="form-control" name="s_media" type="text"  placeholder="Social Media">
                        <i class="fa fa-circle form-control-feedback l-h-34"></i>
                    </div>
                </div>
                </div>
               <div class="radio-holder">
                    <div class="form-group">
                        <div class="col-xs-12">
                            <label>Are you VAT registered?</label>
                        <div class="radio-area">
                        <div class="radio">
                        <input type="radio" name="radio1" id="radio11" value="YES" >
                        <label for="radio11">
                        YES
                        </label>
                        </div>

                        <div class="radio">
                        <input type="radio" name="radio1" id="radio11" value="NO" >
                        <label for="radio11">
                        NO
                        </label>
                        </div>
                        </div>
                        </div>
                    </div>
               </div>

                <div class="form-group" style="display:none" id="vat">
                    <div class="col-xs-12">
                        
                        <input class="form-control" name="v_number" type="text"  placeholder="Vat Number">
                        <i class="fa fa-gg-circle form-control-feedback l-h-34"></i>
                    </div>
                </div>


                <div class="radio-holder">
                <div class="form-group">
                    <div class="col-xs-12">
                        <label>Monthly Revenue</label><br>
                      <div class="radio-area">
                      <div class="radio">
                      
                      <input type="radio" name="r_amount" id="r_amount" value="YES" >
                      <label for="radio11">
                      Less than R20k
                      </label>
                      </div>

                     <div class="radio">
                      <input type="radio" name="r_amount" id="r_amount" value=" R20k - R50k" >
                      <label for="radio11">
                      R20k - R50k
                      </label>
                      </div>

                       <div class="radio">
                      <input type="radio" name="r_amount" id="r_amount" value=" R50k - R100k" >
                      <label for="radio11">
                      R50k - R100k
                      </label>
                      </div>

                       <div class="radio">
                      <input type="radio" name="r_amount" id="r_amount" value=" R100 - R500k" >
                      <label for="radio11">
                      R100 - R500k
                      </label>
                      </div>

                       <div class="radio">
                      <input type="radio" name="r_amount" id="r_amount" value="More than R500k" >
                      <label for="radio11">
                      More than R500k
                      </label>
                      </div>

                       <div class="radio">
                      <input type="radio" name="r_amount" id="r_amount" value=" Less than R20k" >
                      <label for="radio11">
                      Less than R20k
                      </label>
                      </div>
                      </div>
                    </div>
                </div>
                </div>


                 <div class="form-group">
                    <div class="col-xs-12">
                      <label>Business Registration Number</label>  
             <input class="form-control" type="text"  name="b_number" id="b_number" placeholder="Business Registration Number">
                  </div>
                </div>


                <div class="form-group text-right m-t-20">
                	<div class="col-xs-12">
                		<textarea class="form-control" name="extra_comment" placeholder="Do you have any additional comments?" style="height:90px; resize: none;"></textarea>
                </div>

                                    <div class="form-group submit">      
                        <button style="margin-top: 20px;" class="ps-btn" id="btnsub" name="btnsub" type="submit">Apply To Sell</button>
                    
                        </div>  


            </form>
            <div class="modal fade" id="message_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
    <!--Content-->
    <div class="modal-content text-center">
      <!--Header-->
      <div class="modal-header d-flex justify-content-center">
        <p class="heading">Success Message</p>
      </div>

      <!--Body-->
      <div class="modal-body">

      <p>Account Created Succssfullt</p>

      </div>

      <!--Footer-->
      <div class="modal-footer flex-center">
        
        <a type="button" class="btn  btn-success waves-effect" data-dismiss="modal">Ok</a>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
            </div>
        </div>
        </div>  </div>




        <script type="text/javascript">
function checkMailStatus(){
    //alert("came");
var email=$("#email").val();// value in field email
$.ajax({
    type:'post',
        url:'actions/seller_email_check.php',// put your real file name 
        data:{email: email},
        success:function(msg){
        $("#availability").html(msg)
        }
 });
}

</script>



<?php if(isset($_GET['msg']))
{
	 echo "<script>$('#message_modal').modal('show')</script>";
}
?>
        
	<script>
	$("#radio11").change(function(){

   if($(this).val()=="YES")
   {
      $("#vat").show();
   }
   else
   {
       $("#vat").hide(); 
   }

});

    </script>
     <?php include('includes/footer.php'); ?>
	</body>
</html>