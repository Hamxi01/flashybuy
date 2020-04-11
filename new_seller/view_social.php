 <?php
include('include/header.php');
include('include/nav.php'); 
 ?>
 <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <a href="social_media.php" class="btn btn-primary"><i class="fa fa-plus">Create Record</i></a>
                    
                  </div>
                  
                  <div class="card-body">
                    <div class="table-responsive">
                          
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">

                        <thead>
                          <tr>
                            <th>S.No</th>
                            <th>TItle</th>
                            <th>URL</th>
                            <th>Icon image</th>
                            <th>Status</th>
                            <th>Image Update</th>
                            <th>Action</th>
                          </tr>
                        </thead>

                        <tbody>

                          <?php
                          $status = "";
                          $record =mysqli_query($obj->connect(),"select * from tbl_socialmedia");
                          while($row = mysqli_fetch_array($record)){ 
                            
                            if ($row[5]=="1") 
                            {
                              $status = "Active";
                            }
                            else
                            {
                              $status ="In-Active";
                            }
                            ?>
                          <tr class="<?php echo $row[0] ?>">
                            <td><?php echo $row[0]?></td>
                            <td><?php echo $row[1]?></td>
                            <td><?php echo $row[2]?></td>
                            <td>
                              <img src="php/social_media/<?php echo $row[3] ?>"
                             height="100" width="150">
                             
                              </td>
                            <td><?php echo $status?></td>
                            <td><form method="post" enctype="multipart/form-data" 
                  action="php/social_imageupdate.php">
<input type="hidden" name="i_id" value="<?php echo $row[0] ?>">
                              <input type="file"  name="pic">
                              <button type="submit" name="btnsub"><i class="fa fa-image"></i></button>
                           
                        </form>
                            </td>
                            <td><a href="edit_socialmedia.php?id=<?php echo base64_encode($row[0]) ?>" class="btn btn-outline-dark"><i class="fa fa-edit"></i></a></td>
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
