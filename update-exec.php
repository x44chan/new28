<?php
	session_start();
	include('conf.php');
	
	if(isset($_POST['upotsubmit'])){		
		//hrs:minutes computation
		$time1 = date('H:i', strtotime($_POST['uptimein']));
		$time2 = date('H:i', strtotime($_POST['uptimeout']));
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