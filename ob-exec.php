<?php
	session_start();
	include('conf.php');
	
	if(isset($_POST['submit'])){
		$accid = $_SESSION['acc_id'];		
		$obdate = date("Y-m-d");
		$obename = $_POST['obename'];
		$obpost = $_POST['obpost'];
		$obdept = $_POST['obdept'];
		$obdatereq = $_POST['obdatereq'];
		$twodaysred = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 2, date('Y')));;
		$obreason = $_POST['obreason'];
		$obtimein = $_POST['obtimein'];
		$obtimeout = $_POST['obtimeout'];
		$officialworksched = $_POST['obofficialworkschedfr'] . ' ' . $_POST['obofficialworkschedto'];
		if($_SESSION['level'] == 'ACC'){
			$state = "AACCAdmin";
		}else if($_SESSION['level'] == "HR"){
			$state = 'AACCAdmin';	
		}else{
			$state = 'UA';	
		}
		
		$stmt = $conn->prepare("INSERT into `officialbusiness` (account_id, twodaysred, obdate, obename, obpost, obdept, obdatereq, obreason, obtimein, obtimeout, officialworksched, state) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("isssssssssss",$accid, $twodaysred, $obdate, $obename, $obpost, $obdept, $obdatereq, $obreason, $obtimein, $obtimeout, $officialworksched, $state);
		$stmt->execute();
		header("location: employee.php?ac=penob");
		
		$conn->close();
		
	}
?>