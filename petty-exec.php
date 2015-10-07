<?php
	include("conf.php");
	session_start();
	if(isset($_POST['submitpetty'])){
		
		$pettyamount = $_POST['pettyamount'];
		$petty_id = $_POST['petty_id'];
		
		if(isset($_POST['transct'])){
			$trans = $_POST['transct'];
		}else{
			$trans = null;
		}
		if($_SESSION['level'] == 'Admin'){
			$source = $_POST['source'];
			if($source == 'Eli/Sha'){
				$state = 'AAPettyRep';
			}else{
				$state = 'AAPetty';
			}
		}else if($_SESSION['level'] == 'ACC'){
			$state = 'AAPettyRep';
			$source = 'Accounting';
		}
		$sql ="UPDATE petty set 
	   		amount = '$pettyamount', source = '$source', state = '$state', transfer_id = '$trans'
	    where petty_id = '$petty_id'"; 
	 	if ($conn->query($sql) === TRUE) {	 		
	    	if($_SESSION['level'] == 'Admin'){echo '<script type="text/javascript">window.location.replace("admin-petty.php"); </script>';}
	    	else if($_SESSION['level'] == 'ACC'){echo '<script type="text/javascript">window.location.replace("accounting-petty.php"); </script>';}
	  	}else {
	    	echo "Error updating record: " . $conn->error;
	  	}  
	}
	if(isset($_GET['pettyac']) && $_GET['pettyac'] == 'd'){	
		$petty_id = $_GET['petty_id'];
		$sql ="UPDATE petty set 
			state = 'DAPetty'
	    where petty_id = '$petty_id'"; 
	 	if ($conn->query($sql) === TRUE) {
	    	echo '<script type="text/javascript">window.location.replace("admin-petty.php"); </script>';
	  	}else {
	    	echo "Error updating record: " . $conn->error;
	  	}  
	}
	
?>