<?php 
    include('../../includes/db.php');



    if (isset($_POST['id'])) {
    	
    	$id         = $_POST['id'];
    	$active     = $_POST['active'];
    	$comments   = $_POST['comments'];

    	$sql       = "update vendor_product SET active='".$active."',comments='".$comments."' where id='".$id."'";
    	if ($query = mysqli_query($con,$sql)) {
    		
    		echo "Success";
    	}else{

    		echo "error";
    	}
    }
?>