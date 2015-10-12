<?php
	session_start();
	include('conf.php');
	
	if(isset($_POST['upotsubmit'])){		
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
		 	$hours = "0" . $hours;
		 }
		 if(strlen($mins) < 2){
		 	$mins = "0" . $mins;
		 }
		 if(strlen($secs) < 2){
		 	$secs = "0" . $secs;
		 }
		 if($hours == 00 && $minutes != 00){
		 	$hours += 24;	
		 }
		 return $hours . ':' . $mins;
		}		
		$time1 = date('H:i', strtotime($_POST['uptimein']));
		$time2 = date('H:i', strtotime($_POST['uptimeout']));
		$approvedothrs = gettimediff($time1,$time2);
		//end of computation		
		$accid = $_SESSION['acc_id'];		
		$start = $_POST['uptimein'];
		$end = $_POST['uptimeout'];
		$post = strtolower($_SESSION['post']);
		$reason = $_POST['reason'];
		if(isset($_POST['uprestday']) && $_POST['uprestday'] == 'restday'){
			$officialworksched = "Restday";
		}else{
			$officialworksched = $_POST['upoffr']. ' - ' . $_POST['upoffto'];
		}		
		if($_SESSION['level'] == 'ACC'){
			$state = "AACCAdmin";
		}else if($_SESSION['level'] == "HR"){
			$state = 'AACCAdmin';	
		}else if($post == "service technician"){
			$state = 'UATech';	
		}else{
			$state = 'UA';	
		}		
		$stmt = "UPDATE `overtime` set 
			approvedothrs = '$approvedothrs', officialworksched = '$officialworksched', startofot = '$start', endofot = '$end', reason = '$reason'
			where account_id = '$accid' and state like '$state' and overtime_id = '$_SESSION[otid]'";
		if ($conn->query($stmt) === TRUE) {
			if($_SESSION['level'] == 'EMP'){
				echo '<script type="text/javascript">window.location.replace("employee.php?ac='.$_SESSION['acc'].'"); </script>';
			}else if($_SESSION['level'] == 'TECH'){
				echo '<script type="text/javascript">window.location.replace("techsupervisor.php?ac='.$_SESSION['acc'].'"); </script>';
			}	    	
	  	}else {
	    	echo "Error updating record: " . $conn->error;
	  	}
		$conn->close();
		
	}

	if(isset($_POST['upobsubmit'])){		
		$post = strtolower($_SESSION['post']);
		$accid = $_SESSION['acc_id'];
		$obtimein = $_POST['obtimein'];
		$obtimeout = $_POST['obtimeout'];
		$obreason = $_POST['obreason'];
		$officialworksched = $_POST['obofficialworkschedfr'] . ' - ' . $_POST['obofficialworkschedto'];
		if($_SESSION['level'] == 'ACC'){
			$state = "AACCAdmin";
		}else if($_SESSION['level'] == "HR"){
			$state = 'AACCAdmin';	
		}else if($post == "service technician"){
			$state = 'UATech';	
		}else{
			$state = 'UA';	
		}	
		$stmt = "UPDATE `officialbusiness` set 
			obreason = '$obreason', obtimein = '$obtimein', obtimeout = '$obtimeout', officialworksched = '$officialworksched'
			where account_id = '$accid' and state = '$state' and officialbusiness_id = '$_SESSION[otid]'";
		if ($conn->query($stmt) === TRUE) {
	    	if($_SESSION['level'] == 'EMP'){
				echo '<script type="text/javascript">window.location.replace("employee.php?ac='.$_SESSION['acc'].'"); </script>';
			}else if($_SESSION['level'] == 'TECH'){
				echo '<script type="text/javascript">window.location.replace("techsupervisor.php?ac='.$_SESSION['acc'].'"); </script>';
			}
	  	}else {
	    	echo "Error updating record: " . $conn->error;
	  	}
		$conn->close();
		
	}

	if(isset($_POST['upleasubmit'])){		
		$post = strtolower($_SESSION['post']);
		$accid = $_SESSION['acc_id'];
		$dateofleavfr = $_POST['dateofleavfr'];
		$dateofleavto = $_POST['dateofleavto'];
		$numdays = $_POST['numdays'];
		$reason = $_POST['leareason'];
		if($_SESSION['level'] == 'ACC'){
			$state = "AACCAdmin";
		}else if($_SESSION['level'] == "HR"){
			$state = 'AACCAdmin';	
		}else if($post == "service technician"){
			$state = 'UATech';	
		}else{
			$state = 'UA';	
		}
		$stmt = "UPDATE `nleave` set 
			dateofleavfr = '$dateofleavfr', dateofleavto = '$dateofleavto', numdays = '$numdays', reason = '$reason'
			where account_id = '$accid' and state = '$state' and leave_id = '$_SESSION[otid]'";
		if ($conn->query($stmt) === TRUE) {
	    	if($_SESSION['level'] == 'EMP'){
				echo '<script type="text/javascript">window.location.replace("employee.php?ac='.$_SESSION['acc'].'"); </script>';
			}else if($_SESSION['level'] == 'TECH'){
				echo '<script type="text/javascript">window.location.replace("techsupervisor.php?ac='.$_SESSION['acc'].'"); </script>';
			}
	  	}else {
	    	echo "Error updating record: " . $conn->error;
	  	}
		$conn->close();		
	}

	if(isset($_POST['upunsubmit'])){	
		$post = strtolower($_SESSION['post']);
		$accid = $_SESSION['acc_id'];		
		$undatereq = $_POST['undatereq'];
		$undertimefr = $_POST['untimefr'];
		$undertimeto = $_POST['untimeto'];
		$unreason = $_POST['unreason'];
		
		$unumofhrs = $_POST['unumofhrs'];
		if($_SESSION['level'] == 'ACC'){
			$state = "AACCAdmin";
		}else if($_SESSION['level'] == "HR"){
			$state = 'AACCAdmin';	
		}else if($post == "service technician"){
			$state = 'UATech';	
		}else{
			$state = 'UA';	
		}

		$stmt = "UPDATE `undertime` set 
			dateofundrtime = '$undatereq', undertimefr = '$undertimefr', undertimeto = '$undertimeto', reason = '$unreason', numofhrs = '$unumofhrs'
			where account_id = '$accid' and state = '$state' and undertime_id = '$_SESSION[otid]'";
		if ($conn->query($stmt) === TRUE) {
	    	if($_SESSION['level'] == 'EMP'){
				echo '<script type="text/javascript">window.location.replace("employee.php?ac='.$_SESSION['acc'].'"); </script>';
			}else if($_SESSION['level'] == 'TECH'){
				echo '<script type="text/javascript">window.location.replace("techsupervisor.php?ac='.$_SESSION['acc'].'"); </script>';
			}
	  	}else {
	    	echo "Error updating record: " . $conn->error;
	  	}
		$conn->close();

	}
?>