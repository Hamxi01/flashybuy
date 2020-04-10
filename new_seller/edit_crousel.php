<?php
   $id = $_GET['id'];
   include('include/header.php'); 
   include('include/nav.php');
   $query = mysqli_query($obj->connect(),"select * from tbl_slider where id = $id");
   $row = mysqli_fetch_array($query);
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
<!-- Main Content -->
<div class="main-content">
   <section class="section">
      <div class="section-body">
         <div class="row">
            <div class="col-12">
               <div class="card">
                  <form method="post" action="php/update_crousel.php" enctype="multipart/form-data">
                  <div class="card-header">
                     <h4>Crousel Management</h4>
                  </div>
                  <div class="card-body">
                     <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                        <div class="col-sm-6 col-md-4">
                          <input type="hidden" name="id" value="<?php echo $row[0] ?>">
                           <input type="text" value="<?php echo $row[1] ?>" placeholder="Enter Title" name="title" class="form-control">
                        </div>
                     </div>
                     <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">URL</label>
                        <div class="col-sm-6 col-md-4">
                           <input type="url" value="<?php echo $row[2] ?>" name="url" placeholder="Enter URL" class="form-control">
                        </div>
                     </div>
                     <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                        <div class="col-sm-6 col-md-4">
                           <div id="image-preview" class="image-preview" style="width:450px;">
                              <img src="php/crousel/<?php echo $row[4] ?>" width="450" height="200">
                           </div>
                        </div>
                     </div>
                     <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                        <div class="col-sm-6 col-md-4">
                           <select class="form-control selectric">
                              <option>Active</option>
                              <option>In-Active</option>
                           </select>
                        </div>
                     </div>
                     <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Select Days</label>
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
                                 <input type="checkbox" name="ch_sunday"  value="1" id="sunday" checked="">
                                 <span class="slider round"></span>
                                 </label>
                              </td>
                              <td>
                                 <label class="switch">
                                 <input type="checkbox" name="ch_monday"  value="1" id="monday" checked="">
                                 <span class="slider round"></span>
                                 </label>
                              </td>
                              <td>
                                 <label class="switch">
                                 <input type="checkbox" value="1" name="ch_tuesday" id="tuesday" checked="" >
                                 <span class="slider round"></span>
                                 </label>
                              </td>
                              <td>
                                 <label class="switch">
                                 <input type="checkbox" name="ch_wednesday" id="wednesday" checked=""   value="1">
                                 <span class="slider round"></span>
                                 </label>
                              </td>
                              <td>
                                 <label class="switch">
                                 <input type="checkbox" name="ch_thursday"  value="1" id="thursday" checked="" >
                                 <span class="slider round"></span>
                                 </label>
                              </td>
                              <td>
                                 <label class="switch">
                                 <input type="checkbox" name="ch_friday"  value="1" id="frinday" checked="" >
                                 <span class="slider round"></span>
                                 </label>
                              </td>
                              <td>
                                 <label class="switch">
                                 <input type="checkbox"  name="ch_saturday" value="1" id="saturday" checked="">
                                 <span class="slider round"></span>
                                 </label>
                              </td>
                           </tr>
                        </table>
                     </div>
                  </div>
                  <div class="form-group row mb-4">
                     <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                     <div class="col-sm-12 col-md-7">
                        <button type="submit" name="btnsub" class="btn btn-primary">Update Crousel</button>
                     </div>
                  </div>
                </form>
               </div>
            </div>
         </div>
      </div>





<div class="row">
            <div class="col-12">
               <div class="card">
                  <div class="card-header">
                     <h4>Crousel Management</h4>
                  </div>
                  <div class="card-body">
                  <form method="post" action="php/crousel_image.php" enctype="multipart/form-data">
                   <div class="form-group row mb-4">
                      <input type="hidden" name="crousel_id" value="<?php echo $row[0] ?>">
                      <div class="col-sm-12 col-md-7">
                       <input type='file' name="image" onchange="readURL(this);" />
<img id="blah" width="350" alt="your image" />
                      </div>
                    </div>
                     
                  <div class="form-group row mb-4">
                     <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                     <div class="col-sm-12 col-md-7">
                        <button type="submit" name="btnsub" class="btn btn-primary">Update Image</button>
                     </div>
                   </div>
                 </form>
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
</script>
<script
   src="https://code.jquery.com/jquery-3.4.1.js"
   integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
   crossorigin="anonymous"></script>
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

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>
<?php include('include/footer.php'); ?>