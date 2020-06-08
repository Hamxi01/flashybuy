<style>

</style>
<?php 
include('includes/db.php');
include('includes/head.php');
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
                        
                        <input class="form-control" type="text" id="firstname" name="firstname"placeholder="Firstname" tabindex="1" required>
                        <span id="lblError" class="text-danger"></span>
                        <p id="lbl_error"></p>

                        <i class="fa fa-user form-control-feedback l-h-34"></i>
                    </div>
                </div>


                 <div class="form-group">
                    <div class="col-xs-12">
                        
                        <input class="form-control" type="text"  id="lastname" name="lastname" placeholder="Lastname" required>
                        <span id="lastname" class="text-danger"></span>
                        <i class="fa fa-user form-control-feedback l-h-34"></i>
                    </div>
                </div>

                 <div class="form-group">
                    <div class="col-xs-12">
                        
                        <input class="form-control" type="text"  id="shp_name" name="shp_name" placeholder="Shop Name" required>
                        <span id="lastname" class="text-danger"></span>
                        <i class="fa fa-user form-control-feedback l-h-34"></i>
                    </div>
                </div>


                 <div class="form-group">
                    <div class="col-xs-12">
                        
                        <input class="form-control" type="email" id="email" name="email" onblur="checkMailStatus()"  placeholder="Email" required>
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
                        
                        <input class="form-control" type="text"  id="company" name="company" placeholder="Company Name" required>
                          <span id="lblcompany" class="text-danger"></span>
                        <i class="fa fa-bank form-control-feedback l-h-34"></i>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        
                        <select name="category" id="category" class="form-control" required>
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
                        
                        <input class="form-control" name="web" type="text" placeholder="Website" required>
                        <i class="fa fa-globe form-control-feedback l-h-34"></i>
                    </div>
                </div>

                   <div class="form-group">
                    <div class="col-xs-12">
                        
                        <input class="form-control" name="s_media" type="text"  placeholder="Social Media" required>
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
                        <input type="radio" name="radio1" id="radio11" value="YES">
                        <label for="radio11">
                        YES
                        </label>
                        </div>

                        <div class="radio">
                        <input type="radio" name="radio1" id="radio11" value="NO">
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
                        
                        <input class="form-control" name="v_number" type="text"  placeholder="Vat Number" required>
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
             <input class="form-control" type="text"  name="b_number" id="b_number" placeholder="Business Registration Number" required>
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