<?php
	session_start();
	include('conf.php');
	
	if(isset($_POST['leasubmit'])){

		$accid = $_SESSION['acc_id'];		
		$datefile = date("Y-m-d");
		$twodaysred = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 2, date('Y')));;
		$nameofemployee = $_POST['nameofemployee'];
		$datehired = $_POST['datehired'];
		$deprt = $_POST['deprt'];
		$posttile = $_POST['posttile'];
		$dateofleavfr = $_POST['dateofleavfr'];
		$dateofleavto = $_POST['dateofleavto'];
		$numdays = $_POST['numdays'];
		if($_POST['typeoflea'] == 'Others'){
			$typeoflea = $_POST['typeoflea'];
			$othersl = $_POST['othersl'];
		}else{
			$typeoflea = $_POST['typeoflea'];
			$othersl = ' ';
		}
		$reason = $_POST['leareason'];
		if($_SESSION['level'] == 'ACC'){
			$state = "AACCAdmin";
		}else if($_SESSION['level'] == "HR"){
			$state = 'AACCAdmin';	
		}else{
			$state = 'UA';	
		}
		
		
		$stmt = $conn->prepare("INSERT into `nleave` 
								(account_id, datefile, nameofemployee, datehired, deprt, posttile, dateofleavfr, dateofleavto, numdays, typeoflea, othersl, reason, twodaysred, state) 
								VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("isssssssssssss", 
								$accid, $datefile, $nameofemployee, $datehired, $deprt, $posttile, $dateofleavfr, $dateofleavto, $numdays, $typeoflea, $othersl, $reason, $twodaysred, $state);
		$stmt->execute();
		header("location: employee.php?ac=penlea");
		$conn->close();
		
	}
?>