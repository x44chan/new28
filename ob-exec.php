<?php
	session_start();
	include('conf.php');
	
	if(isset($_POST['submit'])){
		$post = strtolower($_SESSION['post']);
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
		$officialworksched = $_POST['obofficialworkschedfr'] . ' - ' . $_POST['obofficialworkschedto'];
		if($_SESSION['level'] == "HR"){
			$state = 'AHR';	
		}else if($post == "service technician"){
			$state = 'UATech';	
		}else{
			$state = 'UA';	
		}
		
		$stmt = $conn->prepare("INSERT into `officialbusiness` (account_id, twodaysred, obdate, obename, obpost, obdept, obdatereq, obreason, obtimein, obtimeout, officialworksched, state) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("isssssssssss",$accid, $twodaysred, $obdate, $obename, $obpost, $obdept, $obdatereq, $obreason, $obtimein, $obtimeout, $officialworksched, $state);
		$stmt->execute();
		if($_SESSION['level'] == 'EMP'){
    		echo '<script type="text/javascript">window.location.replace("employee.php?ac=penob"); </script>';
    	}elseif ($_SESSION['level'] == 'ACC') {
    		echo '<script type="text/javascript">window.location.replace("accounting.php?ac=penob"); </script>';
    	}elseif ($_SESSION['level'] == 'TECH') {
    		echo '<script type="text/javascript">window.location.replace("techsupervisor.php?ac=penob"); </script>';
    	}elseif ($_SESSION['level'] == 'HR') {
    		echo '<script type="text/javascript">window.location.replace("hr.php?ac=penob"); </script>';
    	}
		$conn->close();
		
	}
?>