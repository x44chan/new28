<?php 
	session_start();
	include("conf.php");
	if(isset($_SESSION['acc_id'])){
		if($_SESSION['level'] != 'ACC'){
			header("location: index.php");
		}
	}else{
		header("location: index.php");
	}
	date_default_timezone_set('Asia/Manila');
	if(!isset($_GET['rep'])){
		$_GET['rep'] = 'ot';
	}
	if($_GET['rep'] == 'ot'){
		$title = 'Overtime Report';
	}else if($_GET['rep'] == 'ob'){
		$title = 'Official Business Report';
	}else if($_GET['rep'] == 'lea'){
		$title = 'Leave Report';
	}else if($_GET['rep'] == 'undr'){
		$title = 'Undertime Report';
	}
	include("header.php");	
?>
<script type = "text/javascript">
	$(function(){
		$("#hideuser").on("click", function(){
			$("#userlist").hide();
	});
</script>
<style type="text/css">
	@media print {
		@page{
			margin-left: 10px;
			margin-right: .3px;
			margin-top: 1px;

		}
		body * {
	    	visibility: hidden;
	    
	  	}
	  	#datepr{
	  		margin-top: 25px;
	  	}
	  	#report, #report * {
	    	visibility: visible;
	 	}
	 	#report h2{
	  		margin-bottom: 10px;
	  		margin-top: 10px;
	    }
	 	#report h4{
		font-size: 15px;
		}
		#report h3{
	  		margin-bottom: 10px;
		}
		#report th{
	  		font-size: 12px;
		} 
		#report td{
	  		font-size: 11px;
		}
		#report {
	   		position: absolute;
	    	left: 0;
	    	top: 0;
	    	right: 0;
	  	}
	  	#backs{
	  		visibility: hidden;
	  	}
	}
</style>
<div align = "center" style = "margin-bottom: 30px;">
	<div class="alert alert-success"><br>
		Welcome <strong><?php echo $_SESSION['name'];?> !</strong><br>
		<?php echo date('l jS \of F Y h:i A'); ?> <br>	<br>	
		<div class="btn-group btn-group-lg">
			<a  type = "button"class = "btn btn-primary" href = "/new">Home</a>		
			<div class="btn-group btn-group-lg">
				<button type="button" class="btn btn-primary dropdown-toggle"  data-toggle="dropdown">New Request <span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu">
				  <li><a href="#" id = "newovertime">Overtime Request</a></li>
				  <li><a href="#" id = "newoffb">Official Business Request</a></li>
				  <li><a href="#" id = "newleave">Leave Of Absense Request</a></li>				  
				  <li><a href="#" id = "newundertime">Undertime Request Form</a></li>
				</ul>
			</div>			
			<a type = "button" class = "btn btn-primary  active" href = "acc-report.php" id = "showapproveda">Cutoff Summary</a>
			<a  type = "button"class = "btn btn-primary"  href = "acc-req-app.php"> Approved Request</a>		
			<a type = "button"class = "btn btn-primary"  href = "acc-req-dapp.php">Dispproved Request</a>		
			<a href = "logout.php" class="btn btn-danger" onclick="return confirm('Do you really want to log out?');"  role="button">Logout</a>
		</div>
		<br><br>
		<div class="btn-group btn-group-justified">
			<a class = "btn btn-success" href = "?rep=ot"> Overtime Reports </a>
			<a class = "btn btn-success" href = "?rep=ob"> Official Business Reports </a>
			<a class = "btn btn-success" href = "?rep=lea"> Leave Reports </a>			
			<a class = "btn btn-success" href = "?rep=undr"> Undertime Reports </a>	
		</div>
	</div>
</div>
<div id = "userlist" <?php if(isset($_GET['acc_id'])){ echo 'style = "display: none;"';}?>>
	<?php 
	if(isset($_GET['norec'])){
		echo'<div align = "center" class="alert alert-warning">No O.T Record';
		echo '</div>';
	}	
	if(!isset($_GET['rep'])){
		$_GET['rep'] = 'ot';
		$title = "OT";
		echo '<div align = "center"><h3> Overtime Reports </h3></div>';
	}else if($_GET['rep'] == 'ot'){
		$title = "OT";
		echo '<div align = "center"><h3> Overtime Reports </h3></div>';
	}else if($_GET['rep'] == 'ob'){
		$title = "Official Business";
		echo '<div align = "center"><h3> Official Business Reports </h3></div>';
	}else if($_GET['rep'] == 'undr'){
		$title = "Undertime";
		echo '<div align = "center"><h3> Undertime Reports </h3></div>';
	}else if($_GET['rep'] == 'lea'){
		$title = "Leave";
		echo '<div align = "center"><h3> Leave Reports </h3></div>';
	}
	?>
	<form action = "acc-report.php" method = "">
		<table class = "table table-hover">
			<thead>
				<th width = "30%">Account ID</th>
				<th width = "40%">Employee Name</th>
				<th width = "30%">Action</th>
			</thead>
			<tbody>	
			<?php				
				include("conf.php");
				$sql = "SELECT * FROM login where level != 'Admin'";
				$result = $conn->query($sql);
				if($result->num_rows > 0){
					while($row = $result->fetch_assoc()){
						echo '<tr style = "font-size: 15px"><td>'.$row['account_id'].'<input type = "hidden" name = "acc_id" value ="' .$row['account_id'].'"/></td>
							<td style = "font-size: 15px">'.$row['fname'].' '.$row['lname'] .'</td>
							<td style = "font-size: 15px"><a type = "button" class = "btn btn-primary" href = "?rep='.$_GET['rep'].'&acc_id='.$row['account_id'] .'"name = "submit"> '.$title.' Report </a></td></tr>
							';
					}
				}
			?>
			</tbody>
		</table>
	</form>
</div>
<div id = "report">
<?php
	include("conf.php");
	$date17 = date("d");
	$dated = date("m");
	$datey = date("Y");
	
	if($date17 <= 16){
		$forque = 1;
		$endque = 16;
		$cutoffdates1 = '1 - 15';
		$dated = date("m");
	}else{
		$forque = 16;
		$endque = 32;
		$cutoffdates1 = '16 - 30/31';
		$dated = date("m");
	}
	if(date("d") < 2){
		$date17 = 16;
		$forque = 16;
		$endque = 32;
		$dated = date("m", strtotime("previous month"));
	}
	$date171 = date("d");
	if($date171 < 2){
		$cutoffdates1 = '16 - 30/31';
		$datade1 = date("F", strtotime("previous month"));
	}else{
		
		$datade1 = date("F") ;
	}
	$cutoffdate11 = $datade1  . ' '. $cutoffdates1 .', ' . $datey;
	if(!isset($_GET['rep'])){
		$_GET['rep'] = "";
	}
	if(!isset($_GET['acc_id'])){
		$_GET['acc_id'] = 0;
	}
	if($_GET['rep'] == 'ot' && $_GET['acc_id'] > 0){
		$accid = $_GET['acc_id'];
		include("conf.php");
		$cutoffdate = date("Y-m-d");

		$sql1 = "SELECT * FROM officialbusiness where officialbusiness.account_id = $accid and state = 'AAdmin' limit 1";
		$result1 = $conn->query($sql1);
		$res123 = $result1->fetch_assoc();
		$name123 = $res123['obename'];	
		$position = $res123['obpost'];	
		$department = $res123['obdept'];

		$sql = "SELECT * FROM overtime where overtime.account_id = $accid and state = 'AAdmin' and DAY(dateofot) >= $forque and DAY(dateofot) < $endque and MONTH(dateofot) = $dated and YEAR(dateofot) = $datey ORDER BY datefile ASC";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			
	?>	
	<h5 style="margin-left: 10px;" id = "datepr">Date: <?php echo date("M j, Y");?></h5>
	<h2 align = "center"> Overtime Report </h2>
	<h4 style="margin-left: 10px;">Period: <i><strong><?php echo $cutoffdate11;?></strong></i></h4>
	<h4 style = "margin-left: 10px;">Name: <b><i><?php echo $name123;?></i></b></h4>
	<h4 style = "margin-left: 10px;">Position: <b><i><?php echo $position;?></i></b></h4>
	<h4 style = "margin-left: 10px;">Department: <b><i><?php echo $department;?></i></b></h4>
	<br>
	<form role = "form" action = "approval.php"    method = "get" style = "margin-top: -30px">
		<table width = "100%"class = "table table-hover" align = "center">
			<thead>				
				<tr>
					<th>Date File</th>			
					<th>Date of O.T.</th>
					<th>Fr - To</th>
					<th>OT</th>
					<th>Reason</th>
					<th>Offical Work Schedule</th>
					<th>State</th>
				</tr>
			</thead>
			<tbody>
	<?php
		$cutofftime2 = 0;	
		while($row = $result->fetch_assoc()){
			//end of computation
			$date17 = date("d");
			$dated = date("m");
			$datey = date("Y");		
	
			$originalDate = date($row['datefile']);
			$newDate = date("M j, Y", strtotime($originalDate));			
			echo
				'<tr>
					<td>'.$newDate.'</td>
					<td>'.date("M j, Y", strtotime($row["dateofot"])).'</td>
					<td >'.$row["startofot"] . ' - ' . $row['endofot']. '</td>		
					<td><strong>'.$row['approvedothrs'].'</strong></td>			
					<td >'.$row["reason"].'</td>
					<td >'.$row["officialworksched"].'</td>					
					<td><b>';
						if($row['state'] == 'AAdmin'){
							echo '<p><font color = "green">Appr. by Dep. Head</font></p>';
						}
					echo '</b></td></tr>';
		}
		?>
		</tbody>
	</table>
</form>
<?php	
	$conn->close();
?>
<?php
	include("conf.php");
	$date17 = date("d");
	$dated = date("m");
	$datey = date("Y");
	
	if($date17 > 16){
		$forque = 16;
		$endque = 31;
	}else{
		$forque = 1;
		$endque = 16;
	}
	if($date17 == 1){
		$date17 = 16;
		$forque = 16;
		$endque = 32;
		$dated = date("m", strtotime("previous month"));
	}
	$sql = "SELECT * FROM overtime where overtime.account_id = $accid and DAY(dateofot) >= $forque and DAY(dateofot) < $endque and MONTH(dateofot) = $dated and YEAR(dateofot) = $datey ";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
		$cutofftime2 = 0;	
		$hours12 = 0;
		$minutes12 = 0;
		$seconds1 = 0;
		while($row = $result->fetch_assoc()){
		//hrs:minutes computation
		$time1 = substr($row['startofot'],0,4);
		$time2 = substr($row['endofot'],0,4);
		list($hours, $minutes) = explode(':', $time1);
		$startTimestamp = mktime($hours, $minutes);
		list($hours, $minutes) = explode(':', $time2);
		$endTimestamp = mktime($hours, $minutes);
		$seconds = $endTimestamp - $startTimestamp;
		$minutes = ($seconds / 60) % 60;
		$hours = floor($seconds / (60 * 60));
		$dated = date("F");
		$cutoffs = date("Y-m-16");
		
		if($row['state'] == 'AAdmin' && $row['dateofot'] >= $cutoffs){	
			$cutoffdate = '16 - 30/31';	
			$hrs1 = substr($row['approvedothrs'],0,4);
			$min1 = substr($row['approvedothrs'],0,4);
			list($hours1, $minutes1) = explode(':', $hrs1);
			$startTimestamp1 = mktime($hours1, $minutes1);
			list($hours1, $minutes1) = explode(':', $min1);
			$endTimestamp1 = mktime($hours1, $minutes1);
			$seconds1 =$seconds1 + $endTimestamp1 - $startTimestamp1;
			$minutes1 =$minutes1 + ($seconds1 / 60) % 60;
			$hours1 = $hours1 +floor($seconds1 / (60 * 60));
			$hours12 += $hours1;
			$minutes12 += $minutes1;
		}else if($row['state'] == 'AAdmin' && $row['dateofot'] < $cutoffs){
			$cutoffdate = '1 - 15';
			$hrs1 = substr($row['approvedothrs'],0,4);
			$min1 = substr($row['approvedothrs'],0,4);
			list($hours1, $minutes1) = explode(':', $hrs1);
			$startTimestamp1 = mktime($hours1, $minutes1);
			list($hours1, $minutes1) = explode(':', $min1);
			$endTimestamp1 = mktime($hours1, $minutes1);
			$seconds1 =$seconds1 + $endTimestamp1 - $startTimestamp1;
			$minutes1 =$minutes1 + ($seconds1 / 60) % 60;
			$hours1 = $hours1 +floor($seconds1 / (60 * 60));
				
			$hours12 += $hours1;
			$minutes12 += $minutes1;
			}
		}
		$date17 = date("d");
		if($date17 == 1){
			$date17 = 16;
			$dateda = date("Y-m-d");
			$datade = date("F", strtotime("previous month"));
		}else{
			$datade = date("F") ;
		}
		$hours12 = $hours12 * 60;
		$minutetosec = $minutes12 * 60;
		$totalmin = $hours12 + $minutes12;
		$totalothrs = date('H : i', mktime(0,$totalmin));
		echo '<div align = "center" style = "font-size: 16px;">Total OT: <strong>'. substr($totalothrs,0,2) . ' Hour/s' . substr($totalothrs,4,5). ' Min/s</strong><br><br>';
		echo '<button id = "backs" style = "margin-right: 10px;"class = "btn btn-primary" onclick = "window.print();">Print Report</button>';
		echo '<a id = "backs" class = "btn btn-danger" href = "acc-report.php?&rep='.$_GET['rep'].'">Back</a></div>';

		}
	}else{
		if($date17 > 16){
			$cutoff = date('F 16 - 30/31, Y');
		}else{
			$cutoff = date('F 1 - 15, Y');
		}
		$date17 = date('d');
		if($date17 == 1){
			$date17 = 16;
			$dateda = date("Y-m-d");
			$cutoff = date('F 16 - 30/31, Y', strtotime("previous month"));
		}
		echo '<div align = "center">No Records for this Cutoff: <strong>'.$cutoff.'</strong><br>';
		echo '<a class = "btn btn-danger" href = "acc-report.php?&rep='.$_GET['rep'].'">Back</a></div>';
	}
}
?>
<?php
	include("conf.php");
	$date17 = date("d");
	$dated = date("m");
	$datey = date("Y");
	if($date17 >= 16){
		$forque = 16;
		$endque = 31;
	}else{
		$forque = 1;
		$endque = 15;
	}
	if(!isset($_GET['rep'])){
		$_GET['rep'] = "";
	}
	if(!isset($_GET['acc_id'])){
		$_GET['acc_id'] = 0;
	}
	if($_GET['rep'] == 'ob' && $_GET['acc_id'] > 0){
		include("conf.php");
		$accid = $_GET['acc_id'];
		$sql1 = "SELECT * FROM officialbusiness where officialbusiness.account_id = $accid and state = 'AAdmin' and DAY(obdatereq) >= $forque and DAY(obdatereq) <= $endque and MONTH(obdatereq) = $dated and YEAR(obdatereq) = $datey ORDER BY obdate ASC";
		$result1 = $conn->query($sql1);
		$res123 = $result1->fetch_assoc();
		$name123 = $res123['obename'];	
		$position = $res123['obpost'];	
		$department = $res123['obdept'];		
		$cutoffdate = date("Y-m-d");
		$sql = "SELECT * FROM officialbusiness where officialbusiness.account_id = $accid and state = 'AAdmin' and DAY(obdatereq) >= $forque and DAY(obdatereq) <= $endque and MONTH(obdatereq) = $dated and YEAR(obdatereq) = $datey ORDER BY obdate ASC";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
	?>
	<h5 style="margin-left: 10px;" id = "datepr">Date: <?php echo date("M j, Y");?></h5>
	<h2 align = "center"> Official Business Report </h2>
	<h4 style="margin-left: 10px;">Period: <i><strong><?php echo $cutoffdate11;?></strong></i></h4>
	<h4 style = "margin-left: 10px;">Name: <b><i><?php echo $name123;?></i></b></h4>
	<h4 style = "margin-left: 10px;">Position: <b><i><?php echo $position;?></i></b></h4>
	<h4 style = "margin-left: 10px;">Department: <b><i><?php echo $department;?></i></b></h4>
	<br><br>
	<form role = "form" action = "approval.php"    method = "get" style = "margin-top: -30px;">
		<table class = "table table-hover" align = "center">
			<thead>
				<tr>
					<th>Date File</th>
					<th>Date of Request</th>
					<th>Time In - Time Out</th>
					<th>Offical Work Schedule</th>
					<th>Reason</th>
					<th>State</th>
				</tr>
			</thead>
			<tbody>
	<?php
		$cutofftime2 = 0;	
		while($row = $result->fetch_assoc()){
			//end of computation
			$date17 = date("d");
			$dated = date("F");
			$datey = date("Y");	
			$originalDate = date($row['obdate']);
			$newDate = date("M j, Y", strtotime($originalDate));
			echo
				'<tr>
					<td width = 100>'.$newDate.'</td>
					<td>'.date("M j, Y",strtotime($row['obdatereq'])).'</td>					
					<td>'.$row["obtimein"] . ' - ' . $row['obtimeout'].'</td>
					<td>'.$row["officialworksched"].'</td>				
					<td >'.$row["obreason"].'</td>					
					<td><b>';
						if($row['state'] == 'AAdmin'){
							echo '<p><font color = "green">Appr. by Dep. Head</font></p>';
						}
					echo '<td></tr>';
		}
		?>
		</tbody>
	</table>
</form>
<?php	
		echo '<div align = "center"><button id = "backs" style = "margin-right: 10px;"class = "btn btn-primary" onclick = "window.print();">Print Report</button>';
		echo '<a id = "backs" class = "btn btn-danger" href = "acc-report.php?&rep='.$_GET['rep'].'">Back</a></div>';
		}else{
			if($date17 >= 16){
			$cutoff = date('F 16 - 30/31, Y');
			}else{
				$cutoff = date('F 1 - 15, Y');
			}
			echo '<div align = "center">No Records for this Cutoff: <strong>'.$cutoff.'</strong><br>';
			echo '<a class = "btn btn-danger" href = "acc-report.php?&rep='.$_GET['rep'].'">Back</a></div>';
		}
	}
	$conn->close();
?>
	
<?php
	include("conf.php");
	$date17 = date("d");
	$dated = date("m");
	$datey = date("Y");
	if($date17 >= 16){
		$forque = 16;
		$endque = 31;
	}else{
		$forque = 1;
		$endque = 15;
	}
	if(!isset($_GET['rep'])){
		$_GET['rep'] = "";
	}
	if(!isset($_GET['acc_id'])){
		$_GET['acc_id'] = 0;
	}
	if($_GET['rep'] == 'lea' && $_GET['acc_id'] > 0){
		$accid = $_GET['acc_id'];
		include("conf.php");
		$sql1 = "SELECT * FROM nleave where nleave.account_id = $accid and state = 'AAdmin' and DAY(datefile) >= $forque and DAY(datefile) <= $endque and MONTH(datefile) = $dated and YEAR(datefile) = $datey ORDER BY datefile ASC";
		$result1 = $conn->query($sql1);
		$res123 = $result1->fetch_assoc();
		$name123 = $res123['nameofemployee'];	
		$position = $res123['posttile'];	
		$department = $res123['deprt'];
		$cutoffdate = date("Y-m-d");
		$sql = "SELECT * FROM nleave where nleave.account_id = $accid and state = 'AAdmin' and DAY(datefile) >= $forque and DAY(datefile) <= $endque and MONTH(datefile) = $dated and YEAR(datefile) = $datey ORDER BY datefile ASC";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
	?>
	<h5 style="margin-left: 10px;" id = "datepr">Date: <?php echo date("M j, Y");?></h5>
	<h2 align = "center"> Leave Report </h2>	
	<h4 style="margin-left: 10px;">Period: <i><strong><?php echo $cutoffdate11;?></strong></i></h4>
	<h4 style = "margin-left: 10px;">Name: <b><i><?php echo $name123;?></i></b></h4>
	<h4 style = "margin-left: 10px;">Position: <b><i><?php echo $position;?></i></b></h4>
	<h4 style = "margin-left: 10px;">Department: <b><i><?php echo $department;?></i></b></h4>	
	<br><br>
	<form role = "form" action = "approval.php"    method = "get" style = "margin-top: -30px;">
		<table class = "table table-hover" align = "center">
			<thead>					
					<tr>
						<th >Date File</th>
						<th >Date Hired</th>						
						<th >Date of Leave <br>(Fr - To)</th>
						<th># of Day/s</th>
						<th >Type</th>
						<th>Reason</th>
						<th>State</th>
					</tr>
				</thead>
				<tbody>
	<?php
			while($row = $result->fetch_assoc()){
				
				$originalDate = date($row['datefile']);
				$newDate = date("M j, Y", strtotime($originalDate));
				$datetoday = date("Y-m-d");
				if($datetoday >= $row['twodaysred'] && $row['state'] == 'UA' ){
					echo '<tr style = "color: red">';
				}else{
					echo '<tr>';
				}		
				echo 
					'<td>'.$newDate.'</td>
					<td>'.date("M j, Y", strtotime($row["datehired"])).'</td>										
					<td>Fr: '.date("M j, Y", strtotime($row["dateofleavfr"])) .'<br>To: '.date("M j, Y", strtotime($row["dateofleavto"])).'</td>
					<td>'.$row["numdays"].'</td>					
					<td >'.$row["typeoflea"]. ' : ' . $row['othersl']. '</td>	
					<td >'.$row["reason"].'</td>	
					<td><b>';	
						if($row['state'] == 'AAdmin'){
							echo '<p><font color = "green">Appr. by Dep. Head</font></p>';
						}
					echo '<td></tr>';
		}
		?>
		</tbody>
	</table>
</form>
<?php	
		echo '<div align = "center"><button id = "backs" style = "margin-right: 10px;"class = "btn btn-primary" onclick = "window.print();">Print Report</button>';
		echo '<a id = "backs" class = "btn btn-danger" href = "acc-report.php?&rep='.$_GET['rep'].'">Back</a></div>';
		}else{
			if($date17 >= 16){
				$cutoff = date('F 16 - 30/31, Y');
			}else{
				$cutoff = date('F 1 - 15, Y');
			}
			echo '<div align = "center">No Records for this Cutoff: <strong>'.$cutoff.'</strong><br>';
			echo '<a class = "btn btn-danger" href = "acc-report.php?&rep='.$_GET['rep'].'">Back</a></div>';
	}
}
$conn->close();
?>
	
<?php
	include("conf.php");
	$date17 = date("d");
	$dated = date("m");
	$datey = date("Y");
	if($date17 >= 16){
		$forque = 16;
		$endque = 31;
	}else{
		$forque = 1;
		$endque = 15;
	}
	if(!isset($_GET['rep'])){
		$_GET['rep'] = "";
	}
	if(!isset($_GET['acc_id'])){
		$_GET['acc_id'] = 0;
	}
	if($_GET['rep'] == 'undr' && $_GET['acc_id'] > 0){
		$accid = $_GET['acc_id'];
		include("conf.php");
		$sql1 = "SELECT * FROM undertime where undertime.account_id = $accid and state = 'AAdmin' and DAY(dateofundrtime) >= $forque and DAY(dateofundrtime) <= $endque and MONTH(dateofundrtime) = $dated and YEAR(dateofundrtime) = $datey ORDER BY datefile ASC";
		$result1 = $conn->query($sql1);
		$res123 = $result1->fetch_assoc();
		$name123 = $res123['name'];
		$position = $res123['position'];
		$department = $res123['department'];
		$cutoffdate = date("Y-m-d");
		$sql = "SELECT * FROM undertime where undertime.account_id = $accid and state = 'AAdmin' and DAY(dateofundrtime) >= $forque and DAY(dateofundrtime) <= $endque and MONTH(dateofundrtime) = $dated and YEAR(dateofundrtime) = $datey ORDER BY datefile ASC";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
	?>
	<h5 style="margin-left: 10px;" id = "datepr">Date: <?php echo date("M j, Y");?></h5>
	<h2 align = "center"> Undertime Report </h2>
	<h4 style="margin-left: 10px;">Period: <i><strong><?php echo $cutoffdate11;?></strong></i></h4>
	<h4 style = "margin-left: 10px;">Name: <b><i><?php echo $name123;?></i></b></h4>
	<h4 style = "margin-left: 10px;">Position: <b><i><?php echo $position;?></i></b></h4>
	<h4 style = "margin-left: 10px;">Department: <b><i><?php echo $department;?></i></b></h4>
	<br>
	<form role = "form" action = "approval.php"    method = "get" style = "margin-top: -30px;">
		<table class = "table table-hover" align = "center">
			<thead>
				<tr>
					<th>Date File</th>
					<th>Date of Undertime</th>
					<th>Reason</th>
					<th>Fr - To (Undertime)</th>
					<th># of Hrs/Minutes</th>
					<th>State</th>
				</tr>
			</thead>
			<tbody>
	<?php
		while($row = $result->fetch_assoc()){				
			$originalDate = date($row['datefile']);
			$newDate = date("M j, Y", strtotime($originalDate));
	
			$datetoday = date("Y-m-d");
			echo 
				'<tr>
					<td>'.$newDate.'</td>
					<td>'.date("M j, Y", strtotime($row["dateofundrtime"])).'</td>					
					<td>'.$row["reason"].'</td>
					<td>Fr: '.$row["undertimefr"] . '<br>To: ' . $row['undertimeto'].'</td>
					<td>'.$row["numofhrs"].'</td>
					<td><b>';	
						if($row['state'] == 'AAdmin'){
							echo '<p><font color = "green">Appr. by Dep. Head</font></p>';
						}
					echo '<td></tr>';
		}
		?>
		</tbody>
	</table>
</form>
<?php	
	echo '<div align = "center"><button id = "backs" style = "margin-right: 10px;"class = "btn btn-primary" onclick = "window.print();">Print Report</button>';
	echo '<a id = "backs" class = "btn btn-danger" href = "acc-report.php?&rep='.$_GET['rep'].'">Back</a></div>';
	}else{
		if($date17 >= 16){
			$cutoff = date('F 16 - 30/31, Y');
		}else{
			$cutoff = date('F 1 - 15, Y');
		}
		echo '<div align = "center" id = "userlist">No Records for this Cutoff: <strong>'.$cutoff.'</strong><br>';
		echo '<a class = "btn btn-danger" href = "acc-report.php?&rep='.$_GET['rep'].'">Back</a></div>';
	}
}
	$conn->close();
?>
</div>
<?php include("req-form.php");?>
<?php include('footer.php');?>