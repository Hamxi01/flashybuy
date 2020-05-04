<?php 

 // ============== Vendor Cart Prodcut Package Function ================ //

	function vendorPackges($key,$data,$con){

		$result = array();

		foreach ($data as  $val){
			
			if (array_key_exists($key, $val)) {
				
				$result[$val[$key]][] = $val;
			}
			else{

				$result[""][] = $val;
			}
		}

		return $result;	
	}
?>