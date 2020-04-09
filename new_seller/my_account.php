<?php
include('include/header.php'); 
include('include/nav.php');
$id =$_SESSION['id'];
?>
<div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Account Setting</h4>
                  </div>
                  <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab"
                          aria-controls="overview" aria-selected="true">Overview</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="business-tab" data-toggle="tab" href="#business" role="tab"
                          aria-controls="business" aria-selected="false">Business</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="address-tab" data-toggle="tab" href="#address" role="tab"
                          aria-controls="address" aria-selected="false">Address</a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" id="banking_detail-tab" data-toggle="tab" href="#banking_detail" role="tab"
                          aria-controls="banking_detail" aria-selected="false">Banking Detail</a>
                      </li>

                       <li class="nav-item">
                        <a class="nav-link" id="user-tab" data-toggle="tab" href="#user" role="tab"
                          aria-controls="user" aria-selected="false">User</a>
                      </li>

                      <li class="nav-item">
                        <a class="nav-link" id="user-tab" data-toggle="tab" href="#profile" role="tab"
                          aria-controls="profile" aria-selected="false">Profile</a>
                      </li>


                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                      	<p>Company Name <span class="badge badge-success">Active</span> </p>
                        <table class="table table-bordered">
                        	<tr>
                        		<th>Seller Id</th>
                        		<th>0000121212</th>
                        	</tr>
                        	<tr>
                        		<th>Register Date</th>
                        		<th>12/march/2020</th>
                        	</tr>
                        </table>
                      </div>
                      <div class="tab-pane fade" id="business" role="tabpanel" aria-labelledby="business-tab">
                        <?php $vendor = $obj->get_vendor($id); 
                          $v_row = mysqli_fetch_array($vendor);
                        ?>
                      <div class="row">
                      	<div class="col-md-4">
                      		 <span>Need to update these detail?<br> contact seller support</span>
                      	</div>
                      	<div class="col-md-8">
                      		<table class="table table-bordered">
                        	<tr>
                        		<th>Legal Name</th>
                        		<th><?php echo $v_row[3]; ?></th>
                        	</tr>
                        	<tr>
                        		<th>Business Type</th>
                        		<th>Registered Compnay</th>
                        	</tr>

                        	<tr>
                        		<th>Registration Number</th>
                        		<th><?php echo $v_row[15] ?></th>
                        	</tr>

                        	<tr>
                        		<th>Attachment</th>
                        		<th>NONE</th>
                        	</tr>

                        </table>
                      
                      	</div>
                      </div>
                      <div class="row">
                      	<div class="col-md-4">
                      		ID Document(s)
                      	</div>
                      	<div class="col-md-8">
                      		<a href="#">ID Copy</a>
                      	</div>

                      	<div class="col-md-4">
                      		BEE
                      	</div>
                      	<hr>
                      	<div class="col-md-8">
                      		NO Status
                      	</div>
                      </div>

                      </div>
                      <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                        <?php $details =  $obj->get_shop_detail($id); 
                        $row = mysqli_fetch_array($details);
                        ?>
                     	<div class="row jumbotron">
                     		<div class="col-md-4">
                     			Business Address
                     		</div>
                     		<div class="col-md-4">
                     			<?php echo $row[1] ?>
                     		</div>
                     		<div class="col-md-4">
                     		<a href="edit_address.php?<?php echo "id= ".base64_encode($row[0])." "; ?>" class="btn btn-outline-dark"><i class="fa fa-edit"></i> Edit</a>
                     		</div>
                     	</div>

                     	<div class="row jumbotron">
                     		<div class="col-md-4">
                     			Order Collection Address
                     		</div>
                     		<div class="col-md-4">
                     			GM bungalow 2nd street Chair Men House Road Steel Town Bin Qasim Karachi
                     		</div>
                     		<div class="col-md-4">
                     			<a href="#" class="btn btn-outline-dark"><i class="fa fa-edit"></i> Edit</a>
                     		</div>
                     	</div>
                      </div>


                       <div class="tab-pane fade" id="banking_detail" role="tabpanel" aria-labelledby="banking_detail-tab">
                     	<div class="row">
                     		<div class="col-md-4">
                     			<p>Account Information</p>
                     			<i class="fa fa-lock"></i> <span>Only the account owner can update these details</span>
                     		</div>

                     		<div class="col-md-8">
                          <?php $get_bank=$obj->get_bank_detail($id);
                          $fetch = mysqli_fetch_array($get_bank);
                           ?>
                     			<table class="table table-bordered">
                     				<tr>
                     					<td>Full name</td>
                     					<td><?php echo $fetch[1] ?></td>
                     				</tr>

                            <tr>
                              <td>Account Number</td>
                              <td><?php echo $fetch[2] ?></td>
                            </tr>


                     				<tr>
                     					<td>Bank</td>
                     					<td><?php echo $fetch[3] ?></td>
                     				</tr>

                     				

                     				<tr>
                     					<td>Branch Code</td>
                     					<td><?php echo $fetch[5] ?></td>
                     				</tr>
                     			</table>
                     		</div>

                     	</div>
                      </div>

                      <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="user-tab">
                     	Users <i class="fa fa-user"></i>
                      <div class="row">
                        <?php $user = $obj->get_vendor($id); 
                          $p_user = mysqli_fetch_array($user);
                        ?>
                        <div class="col-md-4">
                          <?php echo $p_user[1]; ?> <span class="badge badge-success"> You</span>
                        </div>

                        <div class="col-md-4">
                          <table class="table table-bordered">
                            <tr>
                              <td>Director</td>
                              <td><?php echo $p_user[4]; ?></td>
                            </tr>

                            <tr>
                              <td>Mobile</td>
                              <td><?php echo $p_user[6]; ?></td>
                            </tr>
                          </table>
                        </div>

                         <div class="col-md-4">
                          <a href="#"><span class="badge badge-primary"> Account Change</span></a>
                          <a href="#" class="btn btn-outline-dark"><i class="fa fa-edit"></i></a>
                        </div>


                      </div>
                      </div>

                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                     	<div class="row">
                        <div class="col-md-4">
                          <?php $profile = $obj->get_vendor($id); 
                          $p_row = mysqli_fetch_array($profile);
                        ?>
                          <p>Your Profile <i class="fa fa-user"></i></p>
                        </div>
                        <div class="col-md-8">
                          <table class="table table-bordered">
                            <tr>
                              <td>Name</td>
                              <td><?php echo $p_row[1] ?></td>
                            </tr>

                            <tr>
                              <td>Lastname</td>
                              <td><?php echo $p_row[2] ?></td>
                            </tr>

                            <tr>
                              <td>Email</td>
                              <td><?php echo $p_row[4] ?></td>
                            </tr>

                            <tr>
                              <td>Mobile Number</td>
                              <td><?php echo $p_row[7] ?></td>
                            </tr>
                          </table>

                        </div>
                      </div>
                      </div>

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
<?php
include('include/footer.php');
?>