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
                    <a href="front_endcontent.php" class="btn btn-primary"><i class="fa fa-plus">Create Record</i></a>
                    
                  </div>
                  
                  <div class="card-body">
                    <div class="table-responsive">
                          
                      <table class="table table-striped table-hover" id="save-stage" style="width:100%;">

                        <thead>
                          <tr>
                            <th class="text-center">S.No</th>
                            <th class="text-center">Heading</th>
                            <th class="text-center">Sub heading</th>
                         
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>  
                       
                       <?php
                $select = mysqli_query($con,"select * from tbl_content");
                $count = 1;
                $status = "";
                while($fetch = mysqli_fetch_assoc($select)){
                  if ($fetch['status']=="1") 
                  {
                    $status = "Active";
                  }
                  else
                  {
                    $status = "In-Active";
                  }
                  ?>  
                      <tr>
                        <td><?php echo $count++ ?></td>
                        <td><?= $fetch['heading'] ?></td>
                        <td><?= $fetch['subheading'] ?></td>
                        
                        <td><?= $status ?></td>
                        <td>
                         <a href="edit_page_content.php?id=<?php echo $fetch['id'] ?>" class="btn btn-outline-warning"> <i class="fa fa-edit" ></i></a>
                          <a href="actions/delete_signup_content.php?id=<?php echo $fetch['id'] ?>" class="btn btn-outline-danger"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr>

                    </tbody>

                       <?php } ?>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        
      </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
<?php include('include/footer.php');?>      
