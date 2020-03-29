<?php
$con = mysqli_connect("localhost","root","" , "newflashybuy") or die("No server found here");

class connection
	{
		public function connect()
		{
			$conn = mysqli_connect("localhost","root","","newflashybuy");
			return $conn;
		}
		public function db_insert($query)
		{
			$query = mysqli_query($this->connect(),$query);
			if ($query>0) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		public function get_cat()
		{
			$select = mysqli_query($this->connect(),"select * from categories");
			return $select;
		}
		public function login($email,$pass)
		{
			$login = mysqli_query($this->connect(),"select * from vendor where email ='$email' and pasword ='$pass'");
			$count = mysqli_num_rows($login);
			$fetch = mysqli_fetch_array($login);
			if ($count>0 && $fetch[19]=="1" &&$fetch[20]=="0"&&$fetch[21]=="0" ) 
			{
				session_start();
				$_SESSION['id']=$fetch[0];
				$_SESSION['name']=$fetch[1];

			}
			else
			{
				header("Location:../login.php?msg=error");

			}

		}

		
	}

?>



