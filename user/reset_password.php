<?php 
$id =$_GET['id'];
	include('include/header.php');
  include('../includes/db.php');
  $obj = new connection();
  $record = $obj->reset_pass($id);
  $fetch = mysqli_fetch_array($record);
?>
<div class="ps-page--my-account">
      <div class="ps-breadcrumb">
        <div class="container">
          <ul class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li>My account</li>
          </ul>
        </div>
      </div>
      <div class="ps-my-account">
        <div class="container">
          <form class="ps-form--account ps-tab-root" action="php/update_password.php" method="post">
            <ul class="ps-tab-list">
              <li class="active"><a href="#sign-in">Change Password</a></li>
            </ul>
            <div class="ps-tabs">
              <div class="ps-tab active" id="sign-in">
                <div class="ps-form__content">
                  <h5>Password Reset</h5>
                   <div class="form-group">
                    <input type="hidden"  name="email" value="<?=$fetch[1] ?>" >
                                <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md" data-placement="bottom" data-toggle="popover" data-container="body" type="button" data-html="true">
                                <div id="popover-password">
                                    <p>Password Strength: <span id="result"> </span></p>
 <div class="progress">
 <div id="password-strength" class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                                        </div>
                                    </div>
                                <ul class="list-unstyled">
                                        <li class=""><span class="low-upper-case"><i class="fa fa-file-text" aria-hidden="true"></i></span>&nbsp; 1 lowercase &amp; 1 uppercase</li>
                                        <li class=""><span class="one-number"><i class="fa fa-file-text" aria-hidden="true"></i></span> &nbsp;1 number (0-9)</li>
                                        <li class=""><span class="one-special-char"><i class="fa fa-file-text" aria-hidden="true"></i></span> &nbsp;1 Special Character (!@#$%^&*).</li>
                                        <li class=""><span class="eight-character"><i class="fa fa-file-text" aria-hidden="true"></i></span>&nbsp; Atleast 8 Character</li>
                                    </ul>
                                </div>
                  <div class="form-group submtit">
                    <button type="submit" name="btnsub" id="btnsub" class="ps-btn ps-btn--fullwidth">Reset</button>
                  </div>
                </div>
                <div class="ps-form__footer">
                  <p>Connect with:</p>
                  <ul class="ps-list--social">
                    <li><a class="facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a class="google" href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a class="twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php include('include/footer.php'); ?>
<script>
    $(document).ready(function() {
        $('#email').blur(function() {
            var email = $('#email').val();
            if (IsEmail(email) == false) {
                $('#sign-up').attr('disabled', true);
                $('#popover-email').removeClass('hide');
            } else {
                $('#popover-email').addClass('hide');
            }
        });
        $('#password').keyup(function() {
            var password = $('#password').val();
            if (checkStrength(password) == false) {
                $('#sign-up').attr('disabled', true);
            }
        });
        $('#confirm-password').blur(function() {
            if ($('#password').val() !== $('#confirm-password').val()) {
                $('#popover-cpassword').removeClass('hide');
                $('#sign-up').attr('disabled', true);
            } else {
                $('#popover-cpassword').addClass('hide');
            }
        });
        $('#contact-number').blur(function() {
            if ($('#contact-number').val().length != 10) {
                $('#popover-cnumber').removeClass('hide');
                $('#sign-up').attr('disabled', true);
            } else {
                $('#popover-cnumber').addClass('hide');
                $('#sign-up').attr('disabled', false);
            }
        });
        $('#sign-up').hover(function() {
            if ($('#sign-up').prop('disabled')) {
                $('#sign-up').popover({
                    html: true,
                    trigger: 'hover',
                    placement: 'below',
                    offset: 20,
                    content: function() {
                        return $('#sign-up-popover').html();
                    }
                });
            }
        });

        function IsEmail(email) {
            var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!regex.test(email)) {
                return false;
            } else {
                return true;
            }
        }

        function checkStrength(password) {
            var strength = 0;


            //If password contains both lower and uppercase characters, increase strength value.
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) {
                strength += 1;
                $('.low-upper-case').addClass('text-success');
                $('.low-upper-case i').removeClass('fa-file-text').addClass('fa-check');
                $('#popover-password-top').addClass('hide');


            } else {
                $('.low-upper-case').removeClass('text-success');
                $('.low-upper-case i').addClass('fa-file-text').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }

            //If it has numbers and characters, increase strength value.
            if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/)) {
                strength += 1;
                $('.one-number').addClass('text-success');
                $('.one-number i').removeClass('fa-file-text').addClass('fa-check');
                $('#popover-password-top').addClass('hide');

            } else {
                $('.one-number').removeClass('text-success');
                $('.one-number i').addClass('fa-file-text').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }

            //If it has one special character, increase strength value.
            if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) {
                strength += 1;
                $('.one-special-char').addClass('text-success');
                $('.one-special-char i').removeClass('fa-file-text').addClass('fa-check');
                $('#popover-password-top').addClass('hide');

            } else {
                $('.one-special-char').removeClass('text-success');
                $('.one-special-char i').addClass('fa-file-text').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }

            if (password.length > 7) {
                strength += 1;
                $('.eight-character').addClass('text-success');
                $('.eight-character i').removeClass('fa-file-text').addClass('fa-check');
                $('#popover-password-top').addClass('hide');

            } else {
                $('.eight-character').removeClass('text-success');
                $('.eight-character i').addClass('fa-file-text').removeClass('fa-check');
                $('#popover-password-top').removeClass('hide');
            }




            // If value is less than 2

            if (strength < 2) {
                $('#result').removeClass()
                $('#password-strength').addClass('progress-bar-danger');

                $('#result').addClass('text-danger').text('Very Week');
                $('#password-strength').css('width', '10%');
            } else if (strength == 2) {
                $('#result').addClass('good');
                $('#password-strength').removeClass('progress-bar-danger');
                $('#password-strength').addClass('progress-bar-warning');
                $('#result').addClass('text-warning').text('Week')
                $('#password-strength').css('width', '60%');
                return 'Week'
            } else if (strength == 4) {
                $('#result').removeClass()
                $('#result').addClass('strong');
                $('#password-strength').removeClass('progress-bar-warning');
                $('#password-strength').addClass('progress-bar-success');
                $('#result').addClass('text-success').text('Strength');
                $('#password-strength').css('width', '100%');

                return 'Strong'
            }

        }

    });
  </script>
 