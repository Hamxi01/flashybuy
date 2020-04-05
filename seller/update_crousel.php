<?php
$id = base64_decode($_GET['id']);
include('include/header.php');
include('include/nav.php'); 
include_once('../includes/db.php');

$obj = new connection();
$query = $obj->get_crousel_by_id($id);
$fetch = mysqli_fetch_array($query);
 ?>
    <style>
        #img_contain{

  margin-top:10px;
  width:250px;
   margin-left: 20%;
}
#file-input{
  margin-left:7px;
  padding:10px;
  
}
#image-preview{
  height:250px;
  width:auto;
  display:block;
  margin-left: auto;
  margin-right: auto;
  padding:5px;
  
}

        
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        /* Hide default HTML checkbox */
        
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        /* The slider */
        
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }
        
        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }
        
        input:checked + .slider {
            background-color: #2196F3;
        }
        
        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }
        
        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }
        /* Rounded sliders */
        
        .slider.round {
            border-radius: 34px;
        }
        
        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <ol class="breadcrumb pull-right">
                                <li><a href="#">Flashy buy</a></li>
                                <li><a href="#">Crousel Management</a></li>
                                <li class="active">Crousel Upload</li>
                            </ol>
                            <h4 class="page-title">Upload Crousel</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="alert alert-success">
                                    <p class="text-center"><i class="fa fa-info-circle"></i>
                                        <b>Banner size must 1090x245 pixel</b></p>

                                </div>
                                <div class="col-md-12">
                                    <form class="form-horizontal" enctype="multipart/form-data" method="post" action="admin/update_record.php" role="form">
                                         <div class="form-group">
                                            <label class="col-md-2 control-label">Title</label>
                                            <div class="col-md-10">
                                              <input type="hidden" name="txtid" value="<?php echo $fetch[0] ?>">
                                                <textarea class="form-control" name="title" placeholder="Enter Title" style="resize: none;"><?php echo $fetch[1] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Url</label>
                                            <div class="col-md-10">
                                                <input type="text" name="url" placeholder="Enter Url" 
                                                value="<?php echo  $fetch[2] ?>" class="form-control">
                                            </div>

                                        </div>
                                       
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Upload Image
                                            </label>
                                            <div class="col-md-10">
                                                <input type='file' id="file-input" class="form-control" name="img" onchange="validateFileType()" />
                                                </p>
                                                <div class="quote-imgs-thumbs quote-imgs-thumbs--hidden" id="img_preview" aria-live="polite"></div>

                                                <p>

                                                </p>

                                            </div>
                                        </div>
                                        <div id='img_contain'>
      <img id="image-preview" align='middle'src="http://www.clker.com/cliparts/c/W/h/n/P/W/generic-image-file-icon-hi.png" alt="your image" title=''/>
    </div>
>


                                        <div class="form-group">
                                            <label class="col-md-2 control-label">View Old Banner</label>
                                            <div class="col-md-10">
                                                    <img src="admin/crousel/<?php echo $fetch[4];?>" height="250" width="250">
                                                <p>

                                                </p>

                                            </div>
                                        </div>

                                        <!--  <div class="form-group">
                                                        <label class="col-lg-4 control-label">Date Range With Time</label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control input-daterange-timepicker" name="daterange" value="01/01/2015 1:30 PM - 01/01/2015 2:00 PM"/>
                                                        </div>
                                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-border">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Sunday</th>
                                                    <th>Monday</th>
                                                    <th>Tuesday</th>
                                                    <th>Wednesday</th>
                                                    <th>thursday</th>
                                                    <th>Friday</th>
                                                    <th>Saturday</th>
                                            </thead>
                                            </tr>
                                            <tr>
                                            </tr>
                                             <tr>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" name="ch_sunday"  value="<?php echo $fetch[6] ?>" id="sunday" checked="">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" name="ch_monday"  value="<?php echo $fetch[7] ?>" id="monday" checked="">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" value="<?php echo $fetch[8] ?>" name="ch_tuesday" id="tuesday" checked="" >
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" name="ch_wednesday" id="wednesday" checked=""   value="<?php echo $fetch[9]?>">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" name="ch_thursday"  value="<?php echo $fetch[10]?>" id="thursday" checked="" >
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" name="ch_friday"  value="<?php echo $fetch[11]?>" id="frinday" checked="" >
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox"  name="ch_saturday" value="<?php echo $fetch[12]?>" id="saturday" checked="">
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- end container -->

                    </div>
                    <input type="submit" name="btnsub" class="btn btn-primary" value="Create Crousel">
                    </form>
                    <!-- end content -->

                    <!-- FOOTER -->
                    <footer class="footer text-right">
                        2017 © Minton.
                    </footer>
                    <!-- End FOOTER -->

                </div>

                <?php include('include/footer.php'); ?>

<script>
$('#monday').on('change', function(){
   this.value = this.checked ? 1 : 0;
});

$('#tuesday').on('change', function(){
   this.value = this.checked ? 1 : 0;
});

$('#wednesday').on('change', function(){
   this.value = this.checked ? 1 : 0;
});

$('#thursday').on('change', function(){
   this.value = this.checked ? 1 : 0;
});

$('#friday').on('change', function(){
   this.value = this.checked ? 1 : 0;
});

$('#saturday').on('change', function(){
   this.value = this.checked ? 1 : 0;
});

$('#sunday').on('change', function(){
   this.value = this.checked ? 1 : 0;
});

</script>
<script>
        function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#image-preview').attr('src', e.target.result);
      $('#image-preview').hide();
      $('#image-preview').fadeIn(650);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

$("#file-input").change(function() {
  readURL(this);
});


</script>
<script type="text/javascript">
    function validateFileType(){
        var fileName = document.getElementById("file-input").value;
        var idxDot = fileName.lastIndexOf(".") + 1;
        var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
        if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
            //TO DO
        }else{
            alert("Only jpg/jpeg and png files are allowed!");
            document.getElementById("file-input").value='';
        }   
    }
</script>                 