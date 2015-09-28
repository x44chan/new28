<?php
	session_start();
	include('conf.php');
	
	if(isset($_POST['unsubmit'])){
		$accid = $_SESSION['acc_id'];		
		$undate = date("Y-m-d");
		$unname = $_POST['unename'];
		$unpost = $_POST['unpost'];
		$undept = $_POST['undept'];
		$undatereq = $_POST['undatereq'];
		$undertimefr = $_POST['untimefr'];
		$undertimeto = $_POST['untimeto'];
		$unreason = $_POST['unreason'];
		$unumofhrs = $_POST['unumofhrs'];
		if($_SESSION['level'] == 'ACC'){
			$state = "AACCAdmin";
		}else if($_SESSION['level'] == "HR"){
			$state = 'AACCAdmin';	
		}else{
			$state = 'UA';	
		}
		
		$twodaysred = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 2, date('Y')));;
		$stmt = $conn->prepare("INSERT into `undertime` (account_id, twodaysred, datefile, name, position, department, dateofundrtime, undertimefr, undertimeto, reason, state, numofhrs) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("isssssssssss",$accid, $twodaysred, $undate, $unname, $unpost, $undept, $undatereq, $undertimefr, $undertimeto, $unreason, $state, $unumofhrs);
		$stmt->execute();
		header("location: employee.php?ac=penundr");
		$conn->close();
		
	}
?>