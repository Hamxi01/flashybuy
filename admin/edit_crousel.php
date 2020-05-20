<?php
   $id = $_GET['id'];
   include('../includes/db.php'); 
   include('includes/header.php');
   include('includes/sidebar.php');
   $query = mysqli_query($con,"select * from tbl_slider where id = $id");
   $row = mysqli_fetch_array($query);
   ?>
     <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
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
                  <form method="post" action="actions/update_crousel.php" enctype="multipart/form-data">
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
                           
                           <div id="image-preview" class="image-preview" style="height: auto;width: 200px;">
                            

                              <input type="file" name="file" id="profile-img">
<img src="../img/crousel/<?php echo $row[4] ?>"  id="profile-img-tag" width="200px" />
                           </div>
                        </div>
                     </div>
                     <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
                        <div class="col-sm-6 col-md-4">
                           <select class="form-control selectric">
                              <option <?php if($row[5] == 1){
                                 echo 'selected';
                                 }?> value="1">Active</option>
                              <option <?php if($row[5] == 0){
                                 echo 'selected';
                                 }?> value="0">In-Active</option>
                           </select>
                        </div>
                     </div>


                     <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Start Date:</label>
                     <input class="form-control" name="start"  value="<?php 
                     $datestart=date_create($row[14]);
                     echo $datestart=date_format($datestart,"m/d/Y"); ?>" id="startDate" width="276" />
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"> End Date:</label> 
                    <input class="form-control" name="end" value="<?php 
                     $dateend=date_create($row[15]);
                     echo $dateend=date_format($dateend,"m/d/Y"); ?>"  id="endDate" width="276" />
    </div>
                     <div class="form-group row mb-4">
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
                                                        <input type="checkbox" name="ch_sunday"  value="1" id="sunday" <?php if($row['sunday']==1){?> checked <?php } ?>>
                                                        <span class="slider round" ></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" name="ch_monday"  value="1" id="monday" <?php if($row['monday']==1){?> checked <?php } ?> >
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" value="1" name="ch_tuesday" id="tuesday" <?php if($row['tuesday']==1){?> checked <?php } ?>>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" name="ch_wednesday" id="wednesday"value="1" <?php if($row['wednesday']==1){?> checked <?php } ?>>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" name="ch_thursday"  value="1" id="thursday" <?php if($row['thursday']==1){?> checked <?php } ?>>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" name="ch_friday"  value="1" id="friday" <?php if($row['friday']==1){?> checked <?php } ?>>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>

                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox"  name="ch_saturday" value="1" id="saturday" <?php if($row['saturday']==1){?> checked <?php } ?>>
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

      </div>


</div>
</section>

</div>
<script>
        var today = new Date(new Date().getFullYear(), new Date().getMonth(), new Date().getDate());
        $('#startDate').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            minDate: today,
            maxDate: function () {
                return $('#endDate').val();
            }
        });
        $('#endDate').datepicker({
            uiLibrary: 'bootstrap4',
            iconsLibrary: 'fontawesome',
            minDate: function () {
                return $('#startDate').val();
            }
        });
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
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#profile-img").change(function(){
        readURL(this);
    });
</script>
<?php include('includes/footer.php'); ?>