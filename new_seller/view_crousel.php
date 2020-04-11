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
                    <a href="crousel.php" class="btn btn-primary"><i class="fa fa-plus">Create Record</i></a>
                    
                  </div>
                  
                  <div class="card-body">
                    <div class="table-responsive">
                          
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">

                        <thead>
                          <tr>
                            <th class="text-center">S.No</th>
                            <th class="text-center">TItle</th>
                            <th class="text-center">Image</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <?php 
                         $status = "";
                        $record =mysqli_query($obj->connect(),"select * from tbl_slider");
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
                              <td class="text-center"><?php echo $fetch[0] ?></td>
                              <td class="text-center"><?php echo $fetch[1] ?></td>
                              <td class="text-center"><img src="php/crousel/<?php echo $fetch[4] ?>" height="150" width="350"></td>
                             <td><?=$status?></td>
                              <td class="text-center"><a href="edit_crousel.php?id=<?php echo $fetch[0] ?>" class="btn btn-outline-dark"><i class="fa fa-edit"></i></a>|
                               <a href="php/delete_crousel.php?id=<?php echo $fetch[0] ?>"class="btn btn-outline-danger"> <i class="fa fa-trash"></i>
                            </td>

                            </tr>
                            <?php } ?>
                        
                        </tbody>
                       
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
          <div class="settingSidebar">
          <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
          </a>
          <div class="settingSidebar-body ps-container ps-theme-default">
            <div class=" fade show active">
              <div class="setting-panel-header">Setting Panel
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Select Layout</h6>
                <div class="selectgroup layout-color w-50">
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                    <span class="selectgroup-button">Light</span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                    <span class="selectgroup-button">Dark</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Sidebar Color</h6>
                <div class="selectgroup selectgroup-pills sidebar-color">
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                  </label>
                  <label class="selectgroup-item">
                    <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                      data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <h6 class="font-medium m-b-10">Color Theme</h6>
                <div class="theme-setting-options">
                  <ul class="choose-theme list-unstyled mb-0">
                    <li title="white" class="active">
                      <div class="white"></div>
                    </li>
                    <li title="cyan">
                      <div class="cyan"></div>
                    </li>
                    <li title="black">
                      <div class="black"></div>
                    </li>
                    <li title="purple">
                      <div class="purple"></div>
                    </li>
                    <li title="orange">
                      <div class="orange"></div>
                    </li>
                    <li title="green">
                      <div class="green"></div>
                    </li>
                    <li title="red">
                      <div class="red"></div>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="mini_sidebar_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Mini Sidebar</span>
                  </label>
                </div>
              </div>
              <div class="p-15 border-bottom">
                <div class="theme-setting-options">
                  <label class="m-b-0">
                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                      id="sticky_header_setting">
                    <span class="custom-switch-indicator"></span>
                    <span class="control-label p-l-10">Sticky Header</span>
                  </label>
                </div>
              </div>
              <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                  <i class="fas fa-undo"></i> Restore Default
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<?php include('include/footer.php');?>      
<script>
    $(document).ready(function(){
        $('.ck').change(function(){
          var status = $(this).prop('checked') == true ? 1 : 0; 
          var id = $(this).data('c_id');
    /*      alert(status);
          alert(id);*/
          $.ajax({
                  type : "POST",
                  datatype :"JSON",
                  url  : "php/status_update.php",
                  data :{'status':status , 'id':id},
                  success:function(data){
                    console.log(data.success);
                  }   
          });
    });
      });
</script>