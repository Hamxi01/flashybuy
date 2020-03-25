<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php'); 


     if(isset($_POST['form_category'])){

        $name        =   addslashes( $_POST['name'] );    
        $meta_title  =   addslashes( $_POST['meta_title'] );
        $meta_desc   =   addslashes( $_POST['meta_description'] );

        $sql = "INSERT into categories (name, meta_title, meta_description) VALUES ('$name', '$meta_title', '$meta_desc')";
        if ( mysqli_query($con,$sql)){

            header("location:deals_block.php?msg=success");
        }

     }

?>

            <!-- Left Sidebar End -->
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
                                    <h4 class="page-title">Add Categories</h4>
                                </div>
                            </div>
                        </div>




                       <div class="row">
                            <div class="col-lg-6 col-sm-offset-3">
                                <div class="card-box">
                                    <h4 class="m-t-0 header-title"><b>Category Information</b></h4>
                                    <p class="text-muted font-13 m-b-30">
                                        Add your Categories.
                                    </p>

                                    <form id="form_category"  method="post" action="add-categories.php">
                                        <div class="form-group">
                                            <label for="userName"> Name*</label>
                                            <input type="text" name="name" required parsley-trigger="change"  placeholder="Name" class="form-control" id="userName">
                                        </div>
                                        <div class="form-group">
                                            <label for="emailAddress">banner</label>
                                            <input type="file" name="banner" parsley-trigger="change" required  class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="pass1">icon</label>
                                            <input  type="file" name="icon" required class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="passWord2">Meta title</label>
                                            <input  type="text" name="meta_title" required placeholder="meta title" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                                    <label>Textarea</label>
                                                   
                                                    <textarea required class="form-control" name="meta_description"></textarea>
                                                
                                        </div>

                                        <div class="form-group text-right m-b-0">
                                            <button class="btn btn-primary waves-effect waves-light" name="form_category" type="submit">
                                                Submit
                                            </button>
                                            <button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
                                                Cancel
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>



                    </div>
                    <!-- end container -->

                </div>
                <!-- end content -->



                <!-- FOOTER -->
                <?php 
                     include('includes/footer.php');
                ?>
                <script>
    <?php if($_REQUEST['msg'] == 'success'){ ?>
    $.Notification.notify('success','top left', 'Deals Block', 'Deals Block! Added Succesfully');
    <?php }?>
    <?php if($_REQUEST['msg'] == 'fail'){ ?>
    $.Notification.notify('error','top left', 'Deals Block', 'Deals Block! Already Exist');
    <?php }?>
    </script>