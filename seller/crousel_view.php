<?php
include_once('../includes/db.php');
$obj = new connection();
include('include/header.php');
include('include/nav.php')		
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
  <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
<form method="post" action="php/delete_multi.php">
                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
 <div class="btn-group dropright">
  <button type="button" class="box btn btn-warning mb-3" id="box" value="check all">Select All
    <i class="fa fa-check"></i>
  </button>
  </div>
 
  <div class="btn-group dropright">
 <select class="form-control" id="cmb_status" name="cmb_satus">
   <option value="1">Active</option>
   <option value="0">In-Active</option>
 </select>
  </div>
 
  <div class="btn-group dropright">
  
      <button type="submit" name="btnsub" class="btn btn-danger">
          <i class="fa fa-trash"></i>
    </button>
 <!--  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
 
 </button> -->

  </div>

  <div class="btn-group dropright" style="float: right">
  <a href="crousel.php"  class="box btn btn-primary">
    Create Crousel
    <i class="fa fa-plus"></i>
  </a>
  </div>
</div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered" id="tblLocations">
                                	<tr>
                                		<th style="width: 50px;" class="text-center">Select</th>
                                		<th style="width: 200px;" class="text-center">Image</th>
                                		<th class="text-center">Title</th>
                                		<th class="text-center">Url</th>
                                		<th class="text-center">Status</th>
                                    <th class="text-center">Aciton</th>
                                  </tr>

                                   <?php
                                   $rec = $obj->get_crousel();
                                    
                                    while($record = mysqli_fetch_array($rec))
                                    {
                                    $status = "";
                                    if ($record[4]=="1") 
                                    {
                                      $status = "
<label class='switch'><input type='checkbox' id='ck'  value='".$record[4]."' checked='' 
data-c_id='".$record[0]."' name='chk_status'>
                                              <span class='slider round'></span>
                                              </label>
                                              ";
                                    }
                                    else
                                    {
                                      $status = "
                                      <label class='switch'>
<input type='checkbox' value='".$record[4]."' name='chk_status' id='ck' data-c_id='".$record[0]." '>
                                              <span class='slider round'></span>
                                              </label>
                                              ";
                                    }

                                    ?>
                                    <tr>
                                      <td><input type='checkbox' value='<?php echo $record[0] ?>' name='ch[]' data-id="<?php echo $record[0] ?>" class='cb-element' id='check'></td>

                                      <td><img src="admin/crousel/<?php echo $record[3]?>" height='50' width="250"></td>

                                      <td><?php echo $record[1] ?></td>
                                      <td><?php echo $record[2] ?></td>
                                      <td><?php echo $status ?></td>
                                      <td>
                                  <a href="edit.php?<?php echo "id=$record[0]"?>" class='btn btn-primary'><i class="fa fa-edit"></i>
                                          </a>
                                  <button type="button" id="del" class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                  </button>
                                      </td>

                                      <?php 

                                      ?>
                                    </tr>
                                    <?php } ?>
                               </table>
                                	
                                
                            </div>
                        </div>
                        <!-- end row -->
</form>

                    </div>
                    <!-- end container -->

                </div>
                <!-- end content -->
<?php include('include/footer.php'); ?>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Alert</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="text-danger text-center">Are You sure Delete this item?</h4>
        <center><h3 class="text-danger"><i class="fa fa-trash"></i></h3></center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">NO</button>
        <button type="button" class="btn btn-danger">YES</button>
      </div>
    </div>
  </div>
</div>


</div>
<script>
  $(document).ready(function() {
  // Check and Uncheck All With Single Button
  $("#box").click(function() {
    if ($("#box").val() == "check all") {
      $(".cb-element").prop("checked", true);
      $("#box").val("uncheck all");
    } else if ($("#box").val() == "uncheck all") {
      $(".cb-element").prop("checked", false);
      $("#box").val("check all");
    }
  });

});

</script>

 
<script>
      $(document).ready(function(){
            $("#cmb_status").change(function(){
                var id =[];
                var status = $("cmb_status").val().trigger('change') == true ? 1 : 0;
                alert('status');
                $("#check").each(function(i){
                  id[i] = $(this).val();
                });
                if (id.length==0){
                  alert("please select one checkbox");
                }
                else
                {
                  $.ajax({
                          url:'admin/multi_status.php',
                          method:"POST",
                          data:{id:id}
                          success:function(){
                             console.log(data.success);
                          }

                  });
                }

      });
</script>
<script>
    $(document).ready(function(){
        $('#ck').change(function(){
          var status = $(this).prop('checked') == true ? 1 : 0; 
          var id = $(this).data('c_id');
          alert(status);
          alert(id);
          $.ajax({
                  type : "POST",
                  datatype :"JSON",
                  url  : "admin/multi_status_update.php",
                  data :{'status':status , 'id':id},
                  success:function(data){
                    console.log(data.success);
                  }   
          });
    });
      });
</script>

</script>
