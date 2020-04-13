<?php include('../includes/db.php'); 
      include('includes/header.php');
      include('includes/sidebar.php');

if (isset($_GET['Pageno'])) {
    $pageno = $_GET['Pageno'];
} else {
    $pageno = 1;
}
        $no_of_records_per_page = 10;
        $offset                 = ($pageno-1) * $no_of_records_per_page;
        $previous_page = $pageno - 1;
        $next_page = $pageno + 1;

    if(isset($_GET['id'])){

        $id = base64_decode($_GET['id']);
        
        $sql = "update brands SET delte = '1'  WHERE id = $id";
        if(mysqli_query($con,$sql)){

            $msg = "<span>Data Deleted successfully...!!</span>";
        }
        else{

            $error = "<span>Something went wrong...!!</span>";
        }
    }
?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
<!-- Start Message -->
<?php
if (isset($error)) {?>
    <div class="row">
        <div class="col-lg-6 col-sm-offset-3">
            <div class="alert alert-warning msg">    
    <?php echo $error; ?>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
if (isset($msg)) { ?>
<div class="row">
    <div class="col-lg-6 col-sm-offset-3">
        <div class="alert alert-success msg">    
    <?php echo $msg; ?>

        </div>
    </div>
</div>
<?php 
}
?>
<!-- End Message  -->            
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Brands</h4>
                    <div class="card-header-form">
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-stripped">
                      <thead>
                        <tr>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </tr>
                      </thead>
                      <tbody>
<!-- Fetch Brands -->
<?php
    $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM brands where delte = 0");
    $total_records = mysqli_fetch_array($result_count);
    $total_records = $total_records['total_records'];
    $total_pages = ceil($total_records / $no_of_records_per_page);

    $sql = mysqli_query($con, "SELECT * From brands where delte = 0  limit $offset, $no_of_records_per_page");
    $i = 0;
    
    while ($row  = mysqli_fetch_array($sql)){
        $id = base64_encode($row['id']);
        $i++;
?>
                        <tr>
                          <td></td>
                          <td><?=$i?></td>
                          <td><?=$row['name']?></td>
                           <td>
                              <div class="btn-group mb-2">
                                  <button class="btn btn-dark btn-sm dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    Actions
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item" href="edit-brands.php?id=<?=$id?>">Edit</a>
                                    <a class="dropdown-item" href="brands.php?id=<?=$id?>">Delete</a>
                                  </div>
                              </div>
                           </td>
                        </tr>
<?php } ?>
<!-- End Brands fetch  -->                        
                      </tbody>
                    </table>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <nav class="d-inline-block">
                      <ul class="pagination mb-0">
                      <?php if($pageno <= 1){ ?>  
                        <li class="page-item disabled">
                          <a class="page-link" href="?Pageno=<?=$previous_page?>">Previous</a>
                        </li>
                      <?php }else{?>

                        <li class="page-item">
                          <a class="page-link" href="?Pageno=<?=$previous_page?>">Previous</a>
                        </li>

                      <?php } ?>
<?php                            
if ($total_pages <= 10){   
 for ($counter = 1; $counter <= $total_pages; $counter++){
    if ($counter == $pageno) { 
                       echo '<li class="page-item active"><a class="page-link" href="#">'.$counter.'</a></li>';
 }else{
       echo '<li class="page-item"><a class="page-link" href="?Pageno='.$counter.'">'.$counter.'</a></li>';
 } } 
}?>
<?php if($pageno >= $total_pages){ ?>                       
                        <li class="page-item disabled">
                          <a class="page-link" href="">Next</a>
                        </li>
<?php }else{ ?>
                        <li class="page-item">
                          <a class="page-link" href="?Pageno=<?=$next_page?>">Next</a>
                        </li>
<?php } ?>                                                
                      </ul>
                    </nav>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
      <?php include('includes/footer.php') ?> 
      <!-- View Model -->
<script type="text/javascript">
    $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
    });
</script>