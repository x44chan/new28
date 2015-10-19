<?php
	session_start();
	include('conf.php');
	
	if(isset($_POST['datefile'])){		
		//hrs:minutes computation
		function gettimediff($dtime,$atime){ 
		 $nextday = $dtime > $atime?1:0;
		 $dep = explode(':',$dtime);
		 $arr = explode(':',$atime);
		 $diff = abs(mktime($dep[0], $dep[1], 0, date('n'), date('j'), date('y')) - mktime($arr[0], $arr[1], 0, date('n'), date('j') + $nextday, date('y')));
		 $hours = floor($diff / (60*60));
		 $mins = floor(($diff - ($hours*60*60))/(60));
		 $secs = floor(($diff - (($hours*60*60)+($mins*60))));
		 if(strlen($hours) < 2){
		 	$hours = $hours;
		 }
		 if(strlen($mins) < 2){
		 	$mins = $mins;
		 }
		 if(strlen($secs) < 2){
		 	$secs = "0" . $secs;
		 }
		 if($hours == 00  && $minutes != 00){
		 	$hours += 24;	
		 }
		 return $hours . ':' . $mins;
		}
		$time1 = date('H:i', strtotime($_POST['startofot']));
		$time2 = date('H:i', strtotime($_POST['endofot']));
		$approvedothrs = gettimediff($time1,$time2);
		//end of computation				
		$post = strtolower($_SESSION['post']);
		$accid = $_SESSION['acc_id'];		
		$datefile = date("Y-m-d");
		$dateofot = $_POST['dateofot'];
		$nameofemployee = $_POST['nameofemployee'];
		$startofot = $_POST['startofot'];
		$endofot = $_POST['endofot'];
		$dateam = $_POST['otam'];
		if($_POST['restday'] == 'restday'){
			$officialworksched = "Restday";
		}else{
			$officialworksched = $_POST['officialworkschedfr']. ' - ' . $_POST['officialworkschedto'];
		}		
		$twodaysred = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') + 2, date('Y')));;
		$reason = $_POST['reason'];
		if($_SESSION['level'] == "HR"){
			$state = 'AHR';	
		}else if($post == "service technician"){
			$state = 'UATech';	
		}else{
			$state = 'UA';	
		}		
		$stmt = $conn->prepare("INSERT into `overtime` (account_id, datefile, 2daysred, dateofot, nameofemp, startofot, endofot, officialworksched, reason, state, approvedothrs) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$stmt->bind_param("issssssssss",$accid, $datefile, $twodaysred, $dateofot, $nameofemployee, $startofot, $endofot, $officialworksched, $reason, $state, $approvedothrs);
		$stmt->execute();		
		header("location: employee.php?ac=penot");
		$conn->close();
		
	}
?>