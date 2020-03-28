<?php 
        include('../includes/db.php');
        include('includes/header.php');
        include('includes/sidebar.php');
?>
            <!-- Left Sidebar End -->
<style type="text/css">
    li.selected {
    background: rgb(234, 234, 234);
    padding: 8px;
    list-style: none;
}
</style>


            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <ol class="breadcrumb pull-right">
                                        <li><a href="#">Minton</a></li>
                                        <li><a href="#">Forms</a></li>
                                        <li class="active">Form Validation</li>
                                    </ol>
                                    <h4 class="page-title">Form Validation</h4>
                                </div>
                            </div>
                        </div>



                        <div class="row">
							<div class="col-lg-9 col-sm-offset-1">
								<div class="card-box">
									<h4 class="m-t-0 header-title"><b>Product</b></h4>
									<p class="text-muted font-13 m-b-30">
	                                    Add Your Products Details
	                                </p>

									<form action="#" data-parsley-validate novalidate>
										<div class="form-group">
											<label for="userName">Product Name*</label>
											<input type="text" name="name" parsley-trigger="change" required placeholder="Enter user name" class="form-control" id="userName">
										</div>
										<div class="form-group">
											<label for="emailAddress">Select Category</label>
											<input type="text" parsley-trigger="change" required  class="form-control" data-toggle="modal" data-target=".bs-example-modal-lg" id="categories_name" value="Select Category">
                                            <input type="hidden" name="category_id" id="category_id" value="" required>
                                            <input type="hidden" name="subcategory_id" id="subcategory_id" value="" required>
                                            <input type="hidden" name="subsubcategory_id" id="subsubcategory_id" value="" required>
										</div>
										<div class="form-group">
											<label for="pass1">Product Brand</label>
											<select class="form-control" name="brand_id">
                                                <option selected disabled>Choose Brand</option>
                                            <?php
                                                $sql = mysqli_query($con, "SELECT * From brands");
                                                $row = mysqli_num_rows($sql);
                                                while ($row = mysqli_fetch_array($sql)){
                                                    echo "<option value='". $row['id'] ."'>" .$row['name'] ."</option>" ;
                                                }
                                            ?>                                 
                                            </select>
										</div>
										<div class="form-group">
											<label for="tags">Product Tag</label><br>
											<input type="text" required data-role="tagsinput" name="tags" class="form-control" id="tags">
										</div>
										<div class="form-group">
                                            <label>Does your product have variations?</label>
                                            <input type="checkbox"  data-plugin="switchery" id="variations" data-color="#00b19d" name="variation_approval" data-size="small" value="Y"/>                              
                                        </div>
                                        <div class="row">
                      
                            <div class="col-md-3 portlets">
                                <!-- Your awesome content goes here -->

                                <div class="m-b-30">
                                    <div class="dropzone" id="dropzone1">
                                      <div class="fallback">
                                        <input name="file1" type="file" />
                                      </div>

                                    </div>
                                    <!-- <div class="clearfix pull-right m-t-15">
                                        <button type="button" class="btn btn-pink btn-rounded waves-effect waves-light">Submit</button>
                                  </div> -->
                                </div>
                            </div>
                            <div class="col-md-3 portlets">
                                <!-- Your awesome content goes here -->
                                <div class="m-b-30">
                                    <div class="dropzone" id="dropzone2">
                                      <div class="fallback">
                                        <input name="file2" type="file" />
                                      </div>

                                    </div>
                                    <!-- <div class="clearfix pull-right m-t-15">
                                        <button type="button" class="btn btn-pink btn-rounded waves-effect waves-light">Submit</button>
                                  </div> -->
                                </div>
                            </div>
                            <div class="col-md-3 portlets">
                                <!-- Your awesome content goes here -->
                                <div class="m-b-30">
                                    <div class="dropzone" id="dropzone3">
                                      <div class="fallback">
                                        <input name="file3" type="file"/>
                                      </div>

                                    </div>
                                    <!-- <div class="clearfix pull-right m-t-15">
                                        <button type="button" class="btn btn-pink btn-rounded waves-effect waves-light">Submit</button>
                                  </div> -->
                                </div>
                            </div>
                            <div class="col-md-3 portlets">
                                <!-- Your awesome content goes here -->
                                <div class="m-b-30">
                                    <div class="dropzone" id="dropzone4">
                                      <div class="fallback">
                                        <input name="file4" type="file" />
                                      </div>

                                    </div>
                                    <!-- <div class="clearfix pull-right m-t-15">
                                        <button type="button" class="btn btn-pink btn-rounded waves-effect waves-light">Submit</button>
                                  </div> -->
                                </div>
                            </div>
                            

                        </div>
										<div class="form-group text-right m-b-0">
											<button class="btn btn-primary waves-effect waves-light" type="submit">
												Submit
											</button>
											<button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
												Cancel
											</button>
										</div>

									</form>
								</div>
							</div>

							<!-- <div class="col-lg-6">
								<div class="card-box">
									<h4 class="m-t-0 header-title"><b>Horizontal Form</b></h4>
									<p class="text-muted font-13 m-b-30">
	                                    Your awesome text goes here.
	                                </p>

									<form class="form-horizontal" role="form"  data-parsley-validate novalidate>
										<div class="form-group">
											<label for="inputEmail3" class="col-sm-4 control-label">Email*</label>
											<div class="col-sm-7">
												<input type="email" required parsley-type="email" class="form-control" id="inputEmail3" placeholder="Email">
											</div>
										</div>
										<div class="form-group">
											<label for="hori-pass1" class="col-sm-4 control-label">Password*</label>
											<div class="col-sm-7">
												<input id="hori-pass1" type="password" placeholder="Password" required class="form-control">
											</div>
										</div>
										<div class="form-group">
											<label for="hori-pass2"class="col-sm-4 control-label">Confirm Password *</label>
											<div class="col-sm-7">
												<input data-parsley-equalto="#hori-pass1" type="password" required placeholder="Password" class="form-control" id="hori-pass2">
											</div>
										</div>

										<div class="form-group">
											<label for="webSite" class="col-sm-4 control-label">Web Site*</label>
											<div class="col-sm-7">
												<input type="url" required parsley-type="url" class="form-control" id="webSite" placeholder="URL">
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-4 col-sm-8">
                                                <div class="checkbox">
                                                    <input id="remember-2" type="checkbox">
                                                    <label for="remember-2"> Remember me </label>
                                                </div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-sm-offset-4 col-sm-8">
												<button type="submit" class="btn btn-primary waves-effect waves-light">
													Registrer
												</button>
												<button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
													Cancel
												</button>
											</div>
										</div>
									</form>
								</div>
							</div> -->
						</div>




                       <!-- <div class="row">
							<div class="col-sm-12">
								<div class="card-box">
									<h4 class="m-t-0 m-b-30 header-title"><b>Fields validation</b></h4>
									<div class="row">
										<div class="col-lg-6">
											<h5><b>Validation type</b></h5>
											<p class="text-muted font-13 m-b-30">
			                                    Your awesome text goes here.
			                                </p>

											<form class="form-horizontal group-border-dashed" action="#">
												<div class="form-group">
													<label class="col-sm-3 control-label">Required</label>
													<div class="col-sm-6">
														<input type="text" class="form-control" required placeholder="Type something" />
													</div>
												</div>


												<div class="form-group">
													<label class="col-sm-3 control-label">Equal To</label>
													<div class="col-sm-3">
														<input type="password" id="pass2" class="form-control" required placeholder="Password" />
													</div>
													<div class="col-sm-3">
														<input type="password" class="form-control" required data-parsley-equalto="#pass2" placeholder="Re-Type Password" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">E-Mail</label>
													<div class="col-sm-6">
														<input type="email" class="form-control" required parsley-type="email" placeholder="Enter a valid e-mail" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">URL</label>
													<div class="col-sm-6">
														<input parsley-type="url" type="url" class="form-control" required placeholder="URL" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Digits</label>
													<div class="col-sm-6">
														<input data-parsley-type="digits" type="text" class="form-control" required placeholder="Enter only digits" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Number</label>
													<div class="col-sm-6">
														<input data-parsley-type="number" type="text" class="form-control" required placeholder="Enter only numbers" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Alphanumeric</label>
													<div class="col-sm-6">
														<input data-parsley-type="alphanum" type="text" class="form-control" required placeholder="Enter alphanumeric value" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Textarea</label>
													<div class="col-sm-6">
														<textarea required class="form-control"></textarea>
													</div>
												</div>
												<div class="form-group">
													<div class="col-sm-offset-3 col-sm-9 m-t-15">
														<button type="submit" class="btn btn-primary waves-effect waves-light">
															Submit
														</button>
														<button type="reset" class="btn btn-default waves-effect m-l-5">
															Cancel
														</button>
													</div>
												</div>
											</form>
										</div>

										<div class="col-lg-6">
											<h5><b>Range validation</b></h5>
											<p class="text-muted font-13 m-b-30">
			                                    Your awesome text goes here.
			                                </p>

											<form class="form-horizontal group-border-dashed" action="#">

												<div class="form-group">
													<label class="col-sm-3 control-label">Min Length</label>
													<div class="col-sm-6">
														<input type="text" class="form-control" required data-parsley-minlength="6" placeholder="Min 6 chars." />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Max Length</label>
													<div class="col-sm-6">
														<input type="text" class="form-control" required data-parsley-maxlength="6" placeholder="Max 6 chars." />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Range Length</label>
													<div class="col-sm-6">
														<input type="text" class="form-control" required data-parsley-length="[5,10]" placeholder="Text between 5 - 10 chars length" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Min Value</label>
													<div class="col-sm-6">
														<input type="text" class="form-control" required data-parsley-min="6" placeholder="Min value is 6" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Max Value</label>
													<div class="col-sm-6">
														<input type="text" class="form-control" required data-parsley-max="6" placeholder="Max value is 6" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Range Value</label>
													<div class="col-sm-6">
														<input class="form-control" required type="text range" min="6" max="100" placeholder="Number between 6 - 100" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Regular Exp</label>
													<div class="col-sm-6">
														<input type="text" class="form-control" required data-parsley-pattern="#[A-Fa-f0-9]{6}" placeholder="Hex. Color" />
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label">Min check</label>
													<div class="col-sm-6">
														<div class="checkbox checkbox-pink">
															<input id="checkbox1" type="checkbox" data-parsley-multiple="groups" data-parsley-mincheck="2">
															<label for="checkbox1"> And this </label>
														</div>
														<div class="checkbox checkbox-pink">
															<input id="checkbox2" type="checkbox" data-parsley-multiple="groups" data-parsley-mincheck="2">
															<label for="checkbox2"> Can't check this </label>
														</div>
														<div class="checkbox checkbox-pink">
															<input id="checkbox3" type="checkbox" data-parsley-multiple="groups" data-parsley-mincheck="2" required>
															<label for="checkbox3"> This too </label>
														</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label">Max check</label>
													<div class="col-sm-6">
														<div class="checkbox checkbox-pink">
															<input id="checkbox4" type="checkbox" data-parsley-multiple="group1">
															<label for="checkbox4"> And this </label>
														</div>
														<div class="checkbox checkbox-pink">
															<input id="checkbox5" type="checkbox" data-parsley-multiple="group1">
															<label for="checkbox5"> Can't check this </label>
														</div>
														<div class="checkbox checkbox-pink">
															<input id="checkbox6" type="checkbox" data-parsley-multiple="group1" data-parsley-maxcheck="1">
															<label for="checkbox6"> This too </label>
														</div>

													</div>
												</div>

												<div class="form-group m-b-0">
													<div class="col-sm-offset-3 col-sm-9 m-t-15">
														<button type="submit" class="btn btn-primary waves-effect waves-light">
															Submit
														</button>
														<button type="reset" class="btn btn-default waves-effect m-l-5">
															Cancel
														</button>
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div> -->



                    </div>
                    <!-- end container -->

                </div>
                <!-- end content -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myLargeModalLabel">Choose Categories</h4>
                                                </div>
                                                <div class="modal-body">
                                                  <div class="row">
                                                      <div class="col-lg-4">
                                                         <ul>
                                                            <?php

                                                                $sql = mysqli_query($con, "SELECT * From categories");
                                                                $row = mysqli_num_rows($sql);
                                                                while ($row = mysqli_fetch_array($sql)){
                                                                    
                                                            ?>
                                                             <li onclick="get_subcategories_by_category(this, <?php echo $row['cat_id']?>)"><?php echo $row['name']?></li>
                                                         <?php } ?>

                                                         </ul>
                                                      </div>
                                                      <div class="col-lg-4">
                                                          <ul id="subcategories">
                                                              
                                                          </ul>
                                                      </div>
                                                      <div class="col-lg-4">
                                                          <ul id="subsubcategories">
                                                              
                                                          </ul>
                                                      </div>
                                                  </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <div class="row">
                                                        <div class="col-lg-2 col-sm-offset-9">
                                                            <button class="btn btn-success waves-effect w-md waves-light m-b-5" onclick="closeModal()">confirm</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
    
        <?php include('includes/footer.php'); ?>
        <script type="text/javascript">

        var category_name = "";
        var subcategory_name = "";
        var subsubcategory_name = "";

        var category_id = null;
        var subcategory_id = null;
        var subsubcategory_id = null;

            function list_item_highlight(el){
                $(el).parent().children().each(function(){
                    $(this).removeClass('selected');
                });
                $(el).addClass('selected');
            }
        function get_subcategories_by_category(el, cat_id){
            list_item_highlight(el);
            category_id = cat_id;
            console.log(category_id);
            category_name = $(el).html();
            $('#subcategories').html(null);
            $('#subsubcategories').html(null);
            $.ajax({
                type: "POST",
                url: 'Actions/getsubcategories.php',
                data: {category_id:category_id},
                success:function(data){

                        $('#subcategories').append(data);
                }
            });
        }
        function get_subsubcategories_by_subcategory(el, cat_id){
            list_item_highlight(el);
            subcategory_id = cat_id;
            console.log(category_id);
            sub_category_name = $(el).html();
            $('#subsubcategories').html(null);
            $.ajax({
                type: "POST",
                url: 'Actions/getsubsubcategories.php',
                data: {category_id:subcategory_id},
                success:function(data){
                
                        $('#subsubcategories').append(data);
                    
                }
            });
        }
        function confirm_subsubcategory(el, subsubcat_id){
            list_item_highlight(el);
            subsubcategory_id = subsubcat_id;
            subsubcategory_name = $(el).html();
        }
        function closeModal(){
            if(category_id > 0 && subcategory_id > 0 && subsubcategory_id > 0){
                $('#category_id').val(category_id);
                $('#subcategory_id').val(subcategory_id);
                $('#subsubcategory_id').val(subsubcategory_id);
                $('#categories_name').val(category_name+'>'+sub_category_name+'>'+subsubcategory_name);
                $('.bs-example-modal-lg').modal('hide');
            }
            else{
                alert('Please choose categories...');
            }
        }
        $(document).ready(function() {


        });
        </script>