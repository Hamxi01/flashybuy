<?php
$id = base64_decode($_GET['id']);
include('include/header.php');
include('include/nav.php');
$record=$obj->edit_shop($id);
$row = mysqli_fetch_array($record);
?>
<div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Edit Details <i class="fa fa-edit"></i></h4>
                  </div>
                  <form method="post" action="php/update_shop.php">
                  <div class="card-body">
                    <div class="row">
                    	<div class="col-md-6">
                    	<div class="form-group">
                      <label>Address</label>
                      <input type="hidden" name="txtid" value="<?php echo $row[0] ?>">
                      <textarea name="address" id="address" class="form-control" style="resize: none;"><?php echo $row[1] ?></textarea>
                    	</div>
                    	</div>

                    	<div class="col-md-6">
                    	<div class="form-group">
                      <label>Street</label>
                      <input type="text" name="street" value="<?php echo $row[2] ?>" class="form-control" id="street">
                    	</div>
                    	</div>

                    </div>

                    <div class="row">
                    	<div class="col-md-6">
                    	<div class="form-group">
                      <label>Rout</label>
                      <input type="text" name="rout" value="<?php echo $row[3]; ?>" class="form-control" id="rout">
                    	</div>
                    	</div>

                    	<div class="col-md-6">
                    	<div class="form-group">
                      <label>State</label>
                        <input type="text" name="state" value="<?php echo $row[4] ?>" class="form-control" id="state">
                    	</div>
                    	</div>
                    	
                    </div>

                    <div class="row">
                    	<div class="col-md-6">
                    	<div class="form-group">
                      <label>Subrub</label>
                      <input type="text" name="sub_rub" value="<?php echo $row[5] ?>" class="form-control" id="sub_rub">
                    	</div>
                    	</div>

                    	<div class="col-md-6">
                    	<div class="form-group">
                      <label>Postal Code</label>
                        <input type="text" value="<?php echo $row[6] ?>" name="postal_code" class="form-control" id="postal_code">
                    	</div>
                    	</div>
                    	
                    </div>


                      <div class="row">
                    	<div class="col-md-6">
                    	<div class="form-group">
                      <label>Country</label>
                      <input type="text" name="country" value="<?php echo $row[7] ?>" class="form-control" id="country">
                    	</div>
                    	</div>
                    	<div class="col-md-6">
						<div class="form-group">
                      <label>City</label>
                      <input type="text" name="city" value="<?php echo $row[8] ?>" class="form-control" id="city">
                    	</div>   	
                    	</div>
                    </div>

                    <div class="row">
                    	<div class="col-md-6">
                    	 <div class="form-group">
                      	<button type="submit" name="btn_update" class="btn btn-outline-dark">Update Record <i class="fa fa-edit"></i></button>
                    	</div>
                    	</div>
                    </div>
                    </div>
                </form>
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
<?php include('include/footer.php'); ?>