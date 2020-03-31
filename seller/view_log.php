<?php 
	include('include/header.php');
	include('include/nav.php');
	include_once('../includes/db.php');
$obj = new connection();

?>

 <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">        
                        <div class="row">
							<div class="col-lg-12">
								<table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Account Holder</th>
                <th>Bank</th>
                <th>Barnch Name</th>
                <th>Branch Code</th>
                <th>User ID</th>
                <th>Update At</th>
                <th>Acount</th>

            </tr>
        </thead>
        <tbody>
        		<?php 
        			$data = $obj->view_log();
        			while ($row = mysqli_fetch_array($data)) 
        			{
        				echo "<tr>
        						<td class='text-center'>$row[0]</td>
        						<td class='text-center'>$row[1]</td>
        						<td class='text-center'>$row[2]</td>
        						<td class='text-center'>$row[3]</td>
        						<td class='text-center'>$row[4]</td>
        						<td class='text-center'>$row[5]</td>
        						<td class='text-center'>$row[6]</td>
        						<td class='text-center'>$row[7]</td>
        				</tr>";
        			}
        		?>

        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Account Holder</th>
                <th>Bank</th>
                <th>Barnch Name</th>
                <th>Branch Code</th>
                <th>User ID</th>
                <th>Update At</th>
                <th>Acount</th>
            </tr>
        </tfoot>
    </table>
							</div>
						</div>
                    </div>
                    
                </div>
                

<?php include('include/footer.php'); ?>
