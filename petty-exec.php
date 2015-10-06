<?php
	include("conf.php");

	if(isset($_POST['submitpetty'])){
		$pettyamount = $_POST['pettyamount'];
		$petty_id = $_POST['petty_id'];
		$source = $_POST['source'];

		$sql ="UPDATE petty set 
	   		amount = '$pettyamount', source = '$source', state = 'AAPetty'
	    where petty_id = '$petty_id'"; 
	 	if ($conn->query($sql) === TRUE) {
	    	echo '<script type="text/javascript">window.location.replace("admin-petty.php"); </script>';
	  	}else {
	    	echo "Error updating record: " . $conn->error;
	  	}  
	}
?>