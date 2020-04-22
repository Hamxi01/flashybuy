<?php
include('include/header.php');
include('include/nav.php'); 
 ?>
 <style>
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
  background-color: green;
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
 <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <a href="crousel.php" class="btn btn-primary"><i class="fa fa-plus">Create Crousel</i></a>
                    
                  </div>
                  
                  <div class="card-body">
                    <div class="table-responsive">
                          
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">

                        <thead>
                          <tr>
                            <th class="text-center">Order</th>
                            <th class="text-center">TItle</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <?php 
                         $status = "";
                         $i=1;
                        $record =mysqli_query($con,"select * from tbl_slider");
                        while($fetch = mysqli_fetch_array($record)){

                           $status = "";
                                   
                                    if ($fetch[5]=="1") 
                                    {
                                      $status = "
<label class='switch'><input type='checkbox' class='ck'  value='".$fetch[5]."' checked='' 
data-c_id='".$fetch[0]."'name='chk_status'>
                                              <span class='slider round'></span>
                                              </label>
                                              ";
                                    }
                                    else
                                    {
                                      $status = "
                                      <label class='switch'>
<input type='checkbox' value='".$fetch[5]."' name='chk_status' class='ck' data-c_id='".$fetch[0]." '>
                                              <span class='slider round'></span>
                                              </label>
                                              ";
                                    }
                        ?>
                        <tbody>
                            <tr>
                              <td class="text-center"><?php echo $fetch[3]?></td>
                              <td class="text-center"><?php echo $fetch[1] ?></td>
                              <td class="text-center"><img src="../img/crousel/800_<?php echo $fetch[4] ?>"></td>
                             <td><?=$status?></td>
                              <td class="text-center"><a href="edit_crousel.php?id=<?php echo $fetch[0] ?>" class="btn btn-outline-dark"><i class="fa fa-edit"></i></a>|
                               <a href="actions/delete_crousel.php?id=<?php echo $fetch[0] ?>"class="btn btn-outline-danger"> <i class="fa fa-trash"></i>
                            </td>

                            </tr>
                            <?php 
                        $i=$i+1;
                        } ?>
                        
                        </tbody>
                       
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

      </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<?php include('include/footer.php');?>      
<script>
    $(document).ready(function(){
        $('.ck').change(function(){
          var status = $(this).prop('checked') == true ? 1 : 0; 
          var id = $(this).data('c_id');
    
          $.ajax({
                  type : "POST",
                  datatype :"JSON",
                  url  : "actions/crousel_status_update.php",
                  data :{'status':status , 'id':id},
                  success:function(data){
                    console.log(data.success);
                  }   
          });
    });
      });
</script>