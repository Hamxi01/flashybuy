<?php include('include/header.php');
	  include('include/nav.php');	
 ?>
    <style>
        .imagePreview {
            width: 100%;
            height: 180px;
            background-position: center center;
            background: url(http://cliquecities.com/assets/no-image-e3699ae23f866f6cbdf8ba2443ee5c4e.jpg);
            background-color: #fff;
            background-size: cover;
            background-repeat: no-repeat;
            display: inline-block;
            box-shadow: 0px -3px 6px 2px rgba(0, 0, 0, 0.2);
        }
        
        .btn-primary {
            display: block;
            border-radius: 0px;
            box-shadow: 0px 4px 6px 2px rgba(0, 0, 0, 0.2);
            margin-top: -5px;
        }
        
        .imgUp {
            margin-bottom: 15px;
        }
        
        .del {
            position: absolute;
            top: 0px;
            right: 15px;
            width: 30px;
            height: 30px;
            text-align: center;
            line-height: 30px;
            background-color: rgba(255, 255, 255, 0.6);
            cursor: pointer;
        }
        
        .imgAdd {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #4bd7ef;
            color: #fff;
            box-shadow: 0px 0px 2px 1px rgba(0, 0, 0, 0.2);
            text-align: center;
            line-height: 30px;
            margin-top: 0px;
            cursor: pointer;
            font-size: 15px;
        }


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
  background-color: #2196F3;
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
                                <li><a href="#">Flashy buy</a></li>
                                <li><a href="#">Banner Management</a></li>
                                <li class="active">Banner Upload</li>
                            </ol>
                            <h4 class="page-title">Upload Banner</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                          
                            <div class="row">
                               <div class="alert alert-success">
                              <p class="text-center"><i class="fa fa-info-circle"></i> 
                                <b>Banner size must 1090x245 pixel</b></p>

                          </div>
                                <div class="col-md-12">
                                    <form class="form-horizontal" role="form">
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Title</label>
                                            <div class="col-md-10">
                                                <textarea class="form-control" name="title" placeholder="Enter Title" style="resize: none;"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Url</label>
                                            <div class="col-md-10">
                                                <input type="text" name="url" placeholder="Enter Url" class="form-control">
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">
                                                Upload Image
                                            </label>
                                            <div class="col-sm-4 imgUp">
                                                <div class="imagePreview"></div>
                                                <label class="btn btn-primary">
                                                    Upload
                                                    <input type="file" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                                </label>
                                            </div>
                                            <!-- col-2 -->
                                            
                                        </div>

                                        <div class="form-group">
                                        	<label class="col-md-2 control-label">Date Select</label>
                                        	<div class="col-md-10">
                                        		<div class="input-daterange input-group" id="datepicker">
          <input type="text" class="input-sm form-control startDate" name="start" />
          <span class="input-group-addon">to</span>
          <input type="text" class="input-sm form-control endDate" name="end" />
        </div>
          </div>
          </div>
          </div>
            <div class="row">
              <div class="col-md-12">
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
  										<input type="checkbox" checked="">
  										<span class="slider round"></span>
										</label></td>

										<td><label class="switch">
  										<input type="checkbox" checked="">
  										<span class="slider round"></span>
										</label></td>

										<td><label class="switch">
  										<input type="checkbox" checked="">
  										<span class="slider round"></span>
										</label></td>

										<td><label class="switch">
  										<input type="checkbox" checked="">
  										<span class="slider round"></span>
										</label></td>

										<td><label class="switch">
  										<input type="checkbox" checked="">
  										<span class="slider round"></span>
										</label></td>

										<td><label class="switch">
  										<input type="checkbox" checked="">
  										<span class="slider round"></span>
										</label></td>

										<td><label class="switch">
  										<input type="checkbox" checked="">
  										<span class="slider round"></span>
										</label></td>
                            		</tr>
                            		</table>
                            	</div>	

                            </div>
                        </div>

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

            <?php include('include/footer.php') ?>

            <script>
                		$(function() {

  $('.input-daterange').datepicker({
    endDate: "today",
    todayBtn: "linked",
    multidate: false,
    autoclose: true,
    format: "mm/yyyy", /// DISPLAYS only Months & Years
    startView: "year", /// DISPLAYS only Months & Years
    minViewMode: "months" /// DISPLAYS only Months & Years
  });
  $('#searchDateRange').on('click', function(e) {
    e.preventDefault();
    var startDay = $('#datepicker').find(".startDate").val().replace(/\//g, '').replace(/(\d\d)(\d\d\d\d)/g, '$2$1');
    var endDay = $('#datepicker').find(".endDate").val().replace(/\//g, '').replace(/(\d\d)(\d\d\d\d)/g, '$2$1');
    var $targets = $('#mixContainer').find('.mix');
    var $show = $targets.filter(function() {
      var date = $(this).attr('data-date');
      return (date >= startDay) && (date <= endDay);
    });
    $('#mixContainer').mixItUp('filter', $show); 
  }); 
     
    var oneYearPrior = new Date(); 
    oneYearPrior.setDate(oneYearPrior.getDate() - 365);
    $(".startDate").datepicker("setDate", oneYearPrior);
    $(".startDate").datepicker('update');
    $(".endDate").datepicker("setDate",  Date());
    $(".endDate").datepicker('update');

  $('#mixContainer').mixItUp({
    animation: {
      duration: 250,
      effects: 'fade translateZ(-360px) stagger(34ms)',
      easing: 'ease'
    },
    layout: {
      containerClass: 'grid'
    },
    controls: {
      enable: true
    },
    callbacks: {
      onMixFail: function() {
        alert('No items were found matching the selected filters.');
      }
    }
  });
});

                </script>


                <script>
                    $(".imgAdd").click(function() {
                        $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
                    });
                    $(document).on("click", "i.del", function() {
                        $(this).parent().remove();
                    });
                    $(function() {
                        $(document).on("change", ".uploadFile", function() {
                            var uploadFile = $(this);
                            var files = !!this.files ? this.files : [];
                            if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                            if (/^image/.test(files[0].type)) { // only image file
                                var reader = new FileReader(); // instance of the FileReader
                                reader.readAsDataURL(files[0]); // read the local file

                                reader.onloadend = function() { // set image data as background of div
                                    //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                                    uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url(" + this.result + ")");
                                }
                            }

                        });
                    });
                </script>
                