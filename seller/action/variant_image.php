<?php 
 include ('../../includes/db.php');
 $options = array();
 if (isset($_POST['vari'])) {


    foreach ($_POST['vari'] as $key => $no) {

        if ($no == 'Color') {



            $sql   = "SELECT * from variations Where variation_name='$no'";
            $query = mysqli_query($con,$sql);

            while ($res = mysqli_fetch_array($query)) {
                
                $aprroval = $res['image_approval'];
                if ($aprroval == "Y" ) {
                    
                    $value =  $_POST['color'];
                    array_push($options, explode(',', $value));
                       foreach ($options as $key => $value) {
            $num=rand();
                            ?>
                          
<div class="form-group row" id="images">
    <div class="col-md-3">
      <div class="form-group">
          <label>Image1</label>
          <input type="file" name="<?=$num?>1" class="form-control"  id="<?=$num?>1">
          <div id="<?=$num?>11">
                       </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Image2</label>
          <input type="file" name="<?=$num?>2" class="form-control"  id="<?=$num?>2">
          <div id="<?=$num?>12">
        </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Image3</label>
          <input type="file" name="<?=$num?>3" class="form-control"   id="<?=$num?>3">
          <div id="<?=$num?>13">
        </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Image4</label>
          <input type="file" name="<?=$num?>4" class="form-control"  id="<?=$num?>4">
          <div id="<?=$num?>14">
        </div>
        </div>
      </div>  
  </div><br> 
  <script>
$(document).ready(function(){
 $(document).on('change', '#<?=$num?>1', function(){
  var name = document.getElementById("<?=$num?>1").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("<?=$num?>1").files[0]);
  var f = document.getElementById("<?=$num?>1").files[0];
  var fsize = f.size||f.fileSize;
 
   form_data.append("file", document.getElementById('<?=$num?>1').files[0]);
   $.ajax({
    url:"action/variantuploadimg1.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
      $('#<?=$num?>11').html('image is uploading');
    },   
    success:function(data)
    {
     $('#<?=$num?>11').html(data);
     
    }
   });
  
 });
});
$(document).ready(function(){
 $(document).on('change', '#<?=$num?>2', function(){
  var name = document.getElementById("<?=$num?>2").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("<?=$num?>2").files[0]);
  var f = document.getElementById("<?=$num?>2").files[0];
  var fsize = f.size||f.fileSize;
 
   form_data.append("file", document.getElementById('<?=$num?>2').files[0]);
   $.ajax({
    url:"action/variantuploadimg2.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     
    },  
    success:function(data)
    {
      $('#<?=$num?>12').html(data);
    }
   });
  
 });
});
$(document).ready(function(){
 $(document).on('change', '#<?=$num?>3', function(){
  var name = document.getElementById("<?=$num?>3").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("<?=$num?>3").files[0]);
  var f = document.getElementById("<?=$num?>3").files[0];
  var fsize = f.size||f.fileSize;
 
   form_data.append("file", document.getElementById('<?=$num?>3').files[0]);
   $.ajax({
    url:"action/variantuploadimg3.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){

    },   
    success:function(data)
    {
      $('#<?=$num?>13').html(data);
    }
   });
  
 });
});
$(document).ready(function(){
 $(document).on('change', '#<?=$num?>4', function(){
  var name = document.getElementById("<?=$num?>4").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1) 
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("<?=$num?>4").files[0]);
  var f = document.getElementById("<?=$num?>4").files[0];
  var fsize = f.size||f.fileSize;
 
   form_data.append("file", document.getElementById('<?=$num?>4').files[0]);
   $.ajax({
    url:"action/variantuploadimg4.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){

    },   
    success:function(data)
    {
      $('#<?=$num?>14').html(data);
    }
   });
  
 });
});
</script>
                            <?php
                       }
                }
            }
        }
        
        
        
    }

//
 }


























?>