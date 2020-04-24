<?php
include('../../includes/db.php');
if (isset($_POST['keyword'])) {
	
	$keyword = $_POST['keyword'];

		if ($keyword != null) {
		
			$sql = "SELECT * from brands where name like '%$keyword%' AND delte=0";

			$query = mysqli_query($con,$sql);


			while ($row = mysqli_fetch_array($query)) {

					$id   = $row['id'];
		        	$name = $row['name'];

					echo '<li onclick="addBrand(this, '.$id.')">'.$name.'</li>';
			}
		}	

}
?>