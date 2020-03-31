<?php include('include/header.php');
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

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title-box">
                                    <ol class="breadcrumb pull-right">
                                        <li><a href="#">Minton</a></li>
                                        <li><a href="#">Extras</a></li>
                                        <li class="active">Timeline</li>
                                    </ol>
                                    <h4 class="page-title">Timeline</h4>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered">
                                	<tr>
                                		<th style="width: 50px;" class="text-center">Select</th>
                                		<th style="width: 200px;" class="text-center">Image</th>
                                		<th class="text-center">Title</th>
                                		<th class="text-center">Url</th>
                                		<th class="text-center">Aciton</th>
                                		<th class="text-center">Status</th>
                                	</tr>
                                	<tr>
                                		<td><input type="checkbox" name="ch" id="select_all"></td>
                                		<td><img src="img/1.jpg" width="200" class="img-responsive"></td>
                                		<td class="text-center">Bedroom set</td>
                                		<td class="text-center">https://www.google.com</td>
                                		<td class="text-center"><select class="form-control">
                                				<option value="1">Active</option>
                                				<option value="0">In-Active</option>
                                			</select></td>
                                			<td>
                                				<label class="switch">
  										<input type="checkbox" checked="">
  										<span class="slider round"></span>
										</label>
                                			</td>

                                	</tr>

                                	<tr>
                                		<td><input type="checkbox" class="ch"></td>
                                		<td><img src="img/1.jpg" width="200" class="img-responsive"></td>
                                		<td class="text-center">Bedroom set</td>
                                		<td class="text-center">https://www.google.com</td>
                                		<td class="text-center"><select class="form-control">
                                				<option value="1">Active</option>
                                				<option value="0">In-Active</option>
                                			</select></td>
                                			<td>
                                				<label class="switch">
  										<input type="checkbox" checked="">
  										<span class="slider round"></span>
										</label>
                                			</td>

                                	</tr>

                                	<tr>
                                		<td><input type="checkbox" class="ch"></td>
                                		<td><img src="img/1.jpg" width="200" class="img-responsive"></td>
                                		<td class="text-center">Bedroom set</td>
                                		<td class="text-center">https://www.google.com</td>
                                		<td class="text-center"><select class="form-control">
                                				<option value="1">Active</option>
                                				<option value="0">In-Active</option>
                                			</select></td>
                                			<td>
                                				<label class="switch">
  										<input type="checkbox" checked="">
  										<span class="slider round"></span>
										</label>
                                			</td>

                                	</tr>

                                	<tr>
                                		<td><input type="checkbox" class="ch"></td>
                                		<td><img src="img/1.jpg" width="200" class="img-responsive"></td>
                                		<td class="text-center">Bedroom set</td>
                                		<td class="text-center">https://www.google.com</td>
                                		<td class="text-center"><select class="form-control">
                                				<option value="1">Active</option>
                                				<option value="0">In-Active</option>
                                			</select></td>
                                			<td>
                                				<label class="switch">
  										<input type="checkbox" checked="">
  										<span class="slider round"></span>
										</label>
                                			</td>

                                	</tr>

                                	<tr>
                                		<td><input type="checkbox" class="ch"></td>
                                		<td><img src="img/1.jpg" width="200" class="img-responsive"></td>
                                		<td class="text-center">Bedroom set</td>
                                		<td class="text-center">https://www.google.com</td>
                                		<td class="text-center"><select class="form-control">
                                				<option value="1">Active</option>
                                				<option value="0">In-Active</option>
                                			</select></td>
                                			<td>
                                				<label class="switch">
  										<input type="checkbox" checked="">
  										<span class="slider round"></span>
										</label>
                                			</td>

                                	</tr>

                                	<tr>
                                		<td><input type="checkbox" class="ch"></td>
                                		<td><img src="img/1.jpg" width="200" class="img-responsive"></td>
                                		<td class="text-center">Bedroom set</td>
                                		<td class="text-center">https://www.google.com</td>
                                		<td class="text-center"><select class="form-control">
                                				<option value="1">Active</option>
                                				<option value="0">In-Active</option>
                                			</select></td>
                                			<td>
                                				<label class="switch">
  										<input type="checkbox" checked="">
  										<span class="slider round"></span>
										</label>
                                			</td>

                                	</tr>

                                	<tr>
                                		<td><input type="checkbox" class="ch"></td>
                                		<td><img src="img/1.jpg" width="200" class="img-responsive"></td>
                                		<td class="text-center">Bedroom set</td>
                                		<td class="text-center">https://www.google.com</td>
                                		<td class="text-center"><select class="form-control">
                                				<option value="1">Active</option>
                                				<option value="0">In-Active</option>
                                			</select></td>
                                			<td>
                                				<label class="switch">
  										<input type="checkbox" checked="">
  										<span class="slider round"></span>
										</label>
                                			</td>

                                	</tr>

                                	<tr>
                                		<td><input type="checkbox" class="ch"></td>
                                		<td><img src="img/1.jpg" width="200" class="img-responsive"></td>
                                		<td class="text-center">Bedroom set</td>
                                		<td class="text-center">https://www.google.com</td>
                                		<td class="text-center"><select class="form-control">
                                				<option value="1">Active</option>
                                				<option value="0">In-Active</option>
                                			</select></td>
                                			<td>
                                				<label class="switch">
  										<input type="checkbox" checked="">
  										<span class="slider round"></span>
										</label>
                                			</td>

                                	</tr>

                                	<tr>
                                		<td><input type="checkbox" class="ch"></td>
                                		<td><img src="img/1.jpg" width="200" class="img-responsive"></td>
                                		<td class="text-center">Bedroom set</td>
                                		<td class="text-center">https://www.google.com</td>
                                		<td class="text-center"><select class="form-control">
                                				<option value="1">Active</option>
                                				<option value="0">In-Active</option>
                                			</select></td>
                                			<td>
                                				<label class="switch">
  										<input type="checkbox" checked="">
  										<span class="slider round"></span>
										</label>
                                			</td>

                                	</tr>
                                </table>
                                	
                                
                            </div>
                        </div>
                        <!-- end row -->


                    </div>
                    <!-- end container -->

                </div>
                <!-- end content -->



                <!-- FOOTER -->
                <footer class="footer text-right">
                    2017 © Minton.
                </footer>
                <!-- End FOOTER -->

            </div>
<?php include('include/footer.php'); ?>
<script>
var select_all = document.getElementById("select_all"); //select all checkbox
var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

//select all checkboxes
select_all.addEventListener("change", function(e){
	for (i = 0; i < checkboxes.length; i++) { 
		checkboxes[i].checked = select_all.checked;
	}
});


for (var i = 0; i < checkboxes.length; i++) {
	checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
		//uncheck "select all", if one of the listed checkbox item is unchecked
		if(this.checked == false){
			select_all.checked = false;
		}
		//check "select all" if all checkbox items are checked
		if(document.querySelectorAll('.ch:checked').length == checkboxes.length){
			select_all.checked = true;
		}
	});
}
</script>