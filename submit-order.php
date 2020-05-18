<?php include('includes/db.php') ?>
<?php include('includes/head.php') ?>
<?php 
    if(isset($_SESSION['name'])){
        
    }else{
      header("location: login.php");
    }


?>
<style type="text/css">
    .td-custom{

        padding    :  0px !important;
        max-height :  90px !important;
        font-size  :  small !important;
    }
    table.ps-block__product td{

        padding: 0px;
        border: none;
    }
    table.ps-block__product th{

        font-weight: bold;
        border-bottom: 1px solid #dee2e6 !important;
    }
    table.ps-block__product .total{

        font-weight: bold;
        border-top: 1px solid #dee2e6 !important;
        border-bottom: none;
        color: red;
        font-size: 20px;
    }
    .address{

        position: relative;
        left: 10px;
        padding: 5px;
    }
    .none-address{

        border-bottom: 1px solid #dee2e6 !important;
        border-bottom: 1px solid #dee2e6 !important;
    }
    .usraddress{

        border-bottom: 1px solid #dee2e6 !important;
    }
    .wallet{
        background: #ffb7b76e;
        padding: 5px;
    }
    .debit_visa {

        position: relative;
        top: 10px;
    }
    .master {

        position: relative;
        top: 20px;
    }
    .ozow {

        position: relative;
        top: 18px;
    }
    .visa {

        position: relative;
        top: 15px;
    }
</style>
    <div class="ps-page--simple">
        <div class="ps-breadcrumb">
            <div class="container">
                <ul class="breadcrumb">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="#">Shop</a></li>
                    <li>Submit order</li>
                </ul>
            </div>
        </div>
        <div class="ps-section--shopping ps-shopping-cart">
            <div class="container">
 
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                    
                    <div class="ps-block--shopping-total">
                        <h3><b>Your order Submitted successfully!</b></h3><br>
                    </div>
                </div>  
            </div>
        </div>
    </div>


<?php include('includes/footer.php'); ?>
