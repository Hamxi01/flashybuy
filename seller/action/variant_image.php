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
            
                            ?>
                           
<div class="form-group row" id="images">
    <div class="col-md-3">
      <div class="form-group">
          <label>Image1</label>
          <input type="file" name="variant_img1[]" class="form-control" value="">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Image2</label>
          <input type="file" name="variant_img2[]" class="form-control" value="">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Image3</label>
          <input type="file" name="variant_img3[]" class="form-control" value="">
        </div>
      </div>
      <div class="col-md-3">
        <div class="form-group">
          <label>Image4</label>
          <input type="file" name="variant_img4[]" class="form-control" value="">
        </div>
      </div>  
  </div><br> 
                            <!-- <div style="   min-height: 150px;
    border: 2px dashed rgba(0, 0, 0, 0.3);
    background: white;
    border-radius: 6px;"> <input name="variant_img[]" type="file" /></div>
                            </div>
                            <div class="col-lg-3">
                            <div style="   min-height: 150px;
    border: 2px dashed rgba(0, 0, 0, 0.3);
    background: white;
    border-radius: 6px;"> <input name="variant_img[]" type="file" /></div>
                            </div>
                            <div class="col-lg-3">
                            <div style="   min-height: 150px;
    border: 2px dashed rgba(0, 0, 0, 0.3);
    background: white;
    border-radius: 6px;"> <input name="variant_img[]" type="file" /></div>
                            </div>
                            <div class="col-lg-3">
                            <div style="   min-height: 150px;
    border: 2px dashed rgba(0, 0, 0, 0.3);
    background: white;
    border-radius: 6px;"> <input name="variant_img[]" type="file" /></div>
                            </div>
                            </div>
                            <br>
                            <br> -->
                            <?php
                       }
                }
            }
        }
        
        
        
    }

//
 }


























?>