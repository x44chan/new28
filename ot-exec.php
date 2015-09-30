<?php
	session_start();
	include('conf.php');
	
	if(isset($_POST['datefile'])){		
		//hrs:minutes computation
		$time1 = date('H:i', strtotime($_POST['startofot']));
		$time2 = date('H:i', strtotime($_POST['endofot']));
		list($hours, $minutes) = explode(':', $time1);
		$startTimestamp = mktime($hours, $minutes);
		list($hours, $minutes) = explode(':', $time2);
		$endTimestamp = mktime($hours, $minutes);
		$seconds = $endTimestamp - $startTimestamp;
		$minutes = ($seconds / 60) % 60;
		$hours = floor($seconds / (60 * 60));
		if($hours < 0){
			$hours *= -1;
		}
		if($minutes < 0){
			$minutes *= -1;
		}
		if($hours < 0){
			$hours *= -1;
		}
		if($hours > 12){
			$hours -= 24;
			if($hours < 0){
				$hours *= -1;
			}
			if($minutes < 0){
				$minutes *= -1;
			}
		}
		$approvedothrs = $hours.':'.$minutes;
		//end of computation		
		$accid = $_SESSION['acc_id'];		
		$datefile = date("Y-m-d");
		$dateofot = $_POST['dateofot'];
		$nameofemployee = $_POST['nameofemployee'];
		$startofot = $_POST['startofot'];
		$endofot = $_POST['endofot'];
		$officialworksched = $_POST['officialworkschedfr']. ' - ' . $_POST['officialworkschedto'];
		$twodaysred = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 2, date('Y')));;
		$reason = $_POST['reason'];
		if($_SESSION['level'] == 'ACC'){
			$state = "AACCAdmin";
		}else if($_SESSION['level'] == "HR"){
			$state = 'AACCAdmin';	
		}else{
			$state = 'UA';	
		}
		
		
	
		
		$stmt = $conn->prepare("INSERT into `overtime` (account_id, datefile, 2daysred, dateofot, nameofemp, startofot, endofot, officialworksched, reason, state, approvedothrs) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("issssssssss",$accid, $datefile, $twodaysred, $dateofot, $nameofemployee, $startofot, $endofot, $officialworksched, $reason, $state, $approvedothrs);
		$stmt->execute();
		
		
		
		header("location: employee.php?ac=penot");
		$conn->close();
		
	}
?>