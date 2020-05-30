<?php 
      include("../includes/db.php");
      include('includes/header.php');
      include('includes/sidebar.php');

      if (isset($_GET['action'])) {
        
          $id = $_GET['id'];
          $sql = "DELETE FROM deals_links WHERE d_l_id = $id";
        if(mysqli_query($con,$sql)){

            $msg = "<span>Data Deleted successfully...!!</span>";
        }
      }     
?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
<?php
if (isset($_GET['msg']) && $_GET['msg'] == 'success') { ?>
<div class="row">
    <div class="col-lg-6 col-sm-offset-3">
        <div class="alert alert-success msg">    
    <?php echo "<span>Data Inserted successfully...!!</span>"; ?>

        </div>
    </div>
</div>
<?php 
}?>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body p-0">
                      <table class="table table-bordered">
                            <tr>
                              <th>Products Deals</th>
                              <th><button class="btn btn-warning" data-toggle="modal"
                                        data-target="#dealModel">Add new Deal</button></th>
                            </tr>
                            <tr>
                              <th>Deal Name</th>
                              <th>Deal url</th>
                              <th></th>
                            </tr>
                          <tbody>
<?php 
$dSql = mysqli_query($con,"SELECT * FROM deals_links");
while ($dRes = mysqli_fetch_array($dSql)) {
 

?>                                                    
                            <tr style="font-size:13px !important; font-weight:bold ">
                              <td><?=$dRes['deal_name']?></td>
                              <td><?=$dRes['deal_url']?></td>
                              <td><button class="btn btn-warning"><a href="deals.php?id=<?=$dRes['d_l_id']?>&action=remove">remove</a></button></td>
                            </tr>
<?php } ?>                            
                          </tbody>
                      </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
        <div class="modal fade" id="dealModel" tabindex="-1" role="dialog" aria-labelledby="formModal"
          aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add new deal</h5>
                <button type="button" class="close" data-dismiss="modal"  aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form id="vendor-form" action="action/insertDeals.php" method="post">    
                      <div class="form-group">
                        <label>Deal Name</label>
                        <input type="text" name="name" id="stock" class="form-control">
                      </div>
                      <div class="form-group" id="marketPrice">
                        <label>Deal url</label>
                        <input type="text" name="url" id="mk_price" class="form-control">
                      </div>    
                  <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="savedeal">Save</button>
                </form>
              </div>
            </div>
          </div>
        </div>
              
      <?php include('includes/footer.php'); ?>
<script type="text/javascript">
  function addDealProduct(v_p_id){

    var v_pid = $("input[name='ven_p_"+v_p_id+"']:checked").val();

    if( isNaN(parseInt(v_pid)) ){
      swal("Vendor Not Added");
      return false;
    }
    var start_date          = $("input[name='start_date_"+v_p_id+"']").val();
    var end_date            = $("input[name='end_date_"+v_p_id+"']").val();
    var deal_price          = $("input[name='deal_price_"+v_p_id+"']" ).val();
    var deal_quantity       = $("input[name='deal_quantity_"+v_p_id+"']").val();
    var deal_market_price   = $("input[name='mk_price_"+v_p_id+"']").val();

    if(start_date == "" ){
      swal("Enter Start Date");
      return false;
    }
    if(end_date == "" ){
      swal("Enter End Date");
      return false;
    }
    if (start_date == end_date) {
      swal("Enter Differ Date");
      return false;
    }

    var url_link = "?prod_id="+v_p_id+"&action=insert&v_p_id="+v_pid + "&start_date=" + start_date + "&end_date=" + end_date + "&deal_price=" + deal_price + "&deal_quantity=" + deal_quantity+ "&mk_price=" + deal_market_price;
    window.location.href = url_link;
    return false; 
  }
  $(document).ready(function() {

        setTimeout(function(){ $(".msg").hide(); }, 5000);
    });
</script>