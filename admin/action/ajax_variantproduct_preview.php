<?php  include('../../includes/db.php'); 

		$prodId = base64_decode($_POST['prodId']);


		$sql = "SELECT name,description,image1,image2,image3,image4 from products Where product_id ='$prodId'";
		$query = mysqli_query($con,$sql);
		$res = mysqli_fetch_array($query);
?>

<div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel"><?=$res[0]?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <p><?=$res[1]?></p>
                  </div>
                  <div class="col-md-5">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
                      <div class="carousel-inner">
                        <div class="carousel-item active">
                          <img class="d-block w-100" src="../upload/product/300_<?php echo $res[2];?>" alt="First slide">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="../upload/product/300_<?php echo $res[3];?>" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                          <img class="d-block w-100" src="../upload/product/300_<?php echo $res[4];?>" alt="Third slide">
                        </div>
                      </div>
                      <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>		