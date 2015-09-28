<?php 
	session_start();
	$accid = $_SESSION['acc_id'];
	include("conf.php");
	if(isset($_SESSION['acc_id'])){
		if($_SESSION['level'] != 'EMP'){
			header("location: index.php");
		}
	}else{
		header("location: index.php");
	}
	date_default_timezone_set('Asia/Manila');
	$title="Employee Page";
	include("header.php");	
?>
<div align = "center" style = "margin-bottom: 30px;">
	<div class="alert alert-success">
		Welcome <strong><?php echo $_SESSION['name'];?> !</strong><br>
		<?php echo date('l jS \of F Y h:i A'); ?> <br>	<br>	
		<div class="btn-group btn-group-lg">
			<a  type = "button"class = "btn btn-primary active" href = "employee.php?ac=penot" id = "home">Home</a>
			<div class="btn-group btn-group-lg">
				<button type="button" class="btn btn-primary dropdown-toggle"  data-toggle="dropdown">New Request <span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu">
				  <li><a href="#" id = "newovertime">Overtime Request</a></li>
				  <li><a href="#" id = "newoffb">Official Business Request</a></li>
				  <li><a href="#" id = "newleave">Leave Of Absense Request</a></li>				  
				  <li><a href="#" id = "newundertime">Undertime Request Form</a></li>
				</ul>
			</div>		
			<a  type = "button"class = "btn btn-primary" href = "req-app.php" id = "myapproveh">My Approved Request</a>		
			<a  type = "button"class = "btn btn-primary" href = "req-dapp.php" id = "mydisapproveh">My Dispproved Request</button>		
			<a href = "logout.php" class="btn btn-danger" onclick="return confirm('Do you really want to log out?');"  role="button">Logout</a>
		</div> <br><br>
		<div class = "btn-group btn-group-justified">
			<a  role = "button"class = "btn btn-success"  href = "?ac=penot"> Overtime Request Status </a>
			<a  role = "button"class = "btn btn-success" href = "?ac=penob"> Official Business Request Status</a>			
			<a  role = "button"class = "btn btn-success"  href = "?ac=penlea"> Leave Request Status</a>		
			<a  role = "button"class = "btn btn-success"  href = "?ac=penundr"> Undertime Request Status</a>	
		</div>
	</div>
</div>

<div id = "dash" class = "resp" style = "margin-top: -30px;">	
<?php 
	$date17 = date("d");
	$dated = date("m");
	$datey = date("Y");
	if($date17 >= 17){
		$forque = 17;
		$endque = 31;
	}else{
		$forque = 1;
		$endque = 16;
	}
	
	if(isset($_GET['ac']) && $_GET['ac'] == 'penot'){

		$sql = "SELECT * FROM overtime,login where overtime.account_id = $accid and login.account_id = $accid and DAY(datefile) >= $forque and DAY(datefile) <= $endque and MONTH(datefile) = $dated and YEAR(datefile) = $datey ORDER BY datefile ASC";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
	?>
	
		<form role = "form" action = "approval.php"    method = "get">
			<table class = "table table-hover" align = "center">
				<thead>				
					<tr>
						<td colspan = 7 align = center><h2> Overtime Application Status </h2></td>
					</tr>
					<tr>
						<th>Date File</th>						
						<th>Name of Employee</th>
						<th>Date of Overtime</th>
						<th>From - To (Overtime)</th>
						<th>Reason</th>
						<th>Offical Work Schedule</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
	<?php
			//'F j, Y - hA'
			while($row = $result->fetch_assoc()){
				$datetoday = date("Y-m-d");
				$originalDate = date($row['datefile']);
				$newDate = date("F j, Y", strtotime($originalDate));
				$newDate2 = date("F j, Y", strtotime($row['dateofot']));
					
				if($datetoday >= $row['2daysred'] && $row['state'] == 'UA'){
					echo '<tr style = "color: red">';
				}else{
					echo '<tr>';
				}
				echo 
					'
						<td>'.$newDate.'</td>						
						<td>'.$row["nameofemp"].'</td>
						<td>'.$newDate2.'</td>
						<td>'.$row["startofot"] . ' - ' . $row['endofot'].'</td>						
						<td width = 300 height = 70>'.$row["reason"].'</td>
						<td>'.$row["officialworksched"].'</td>				
						<td><b>';
							if($row['state'] == 'UA'){
								echo 'Pending';
							}else if($row['state'] == 'AHR'){
								echo '<p><font color = "green">Approved by HR</font></p> ';
							}else if($row['state'] == 'AACC'){
								echo '<p><font color = "green">Approved by Accounting</font></p> ';
							}else if($row['state'] == 'AAdmin'){
								echo '<p><font color = "green">Approved by Dep. Head</font></p> ';
							}else if($row['state'] == 'DAHR'){
								echo '<p><font color = "red">Dispproved by HR</font></p> '.$row['dareason'];
							}else if($row['state'] == 'DAACC'){
								echo '<p><font color = "red">Dispproved by Accounting</font></p> '.$row['dareason'];
							}else if($row['state'] == 'DAAdmin'){
								echo '<p><font color = "red">Dispproved by Dep. Head</font></p> '.$row['dareason'];
							}
						echo '<td></tr>';
			}
			echo '</tbody></table></form>';
		}
}
?>

<?php 
	if(isset($_GET['ac']) && $_GET['ac'] == 'penundr'){
		
		include("conf.php");
		$sql = "SELECT * FROM undertime,login where undertime.account_id = $accid and login.account_id = $accid and DAY(datefile) >= $forque and DAY(datefile) <= $endque and MONTH(datefile) = $dated and YEAR(datefile) = $datey ORDER BY datefile ASC";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
	?>
	<form role = "form" action = "approval.php"    method = "get">
			<table class = "table table-hover" align = "center">
				<thead>				
					<tr>
						<td colspan = 7 align = center><h2> Undertime Application Status </h2></td>
					</tr>
					<tr >
						<th>Date File</th>
						<th>Date of Undertime</th>
						<th>Name of Employee</th>
						<th>Reason</th>
						<th>From - To (Overtime)</th>
						<th>Number of Hrs/Minutes</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
	<?php
			while($row = $result->fetch_assoc()){				
				$originalDate = date($row['datefile']);
				$newDate = date("F j, Y", strtotime($originalDate));
				
				$datetoday = date("Y-m-d");
				if($datetoday >= $row['twodaysred'] && $row['state'] == 'UA' ){
					echo '<tr style = "color: red">';
				}else{
					echo '<tr>';
				}	
				echo 
					'<td width = 180>'.$newDate.'</td>
					<td>'. date("F j, Y", strtotime($row["dateofundrtime"])).'</td>
					<td>'.$row["name"].'</td>
					<td width = 250 height = 70>'.$row["reason"].'</td>
					<td>'.$row["undertimefr"] . ' - ' . $row['undertimeto'].'</td>
					<td>'.$row["numofhrs"].'</td>
					<td><b>';
						if($row['state'] == 'UA'){
							echo 'Pending';
						}else if($row['state'] == 'AHR'){
							echo '<p><font color = "green">Approved by HR</font></p> ' ;
						}else if($row['state'] == 'AACC'){
							echo '<p><font color = "green">Approved by Accounting</font></p> ' ;
						}else if($row['state'] == 'AAdmin'){
							echo '<p><font color = "green">Approved by Dep. Head</font></p> ' ;
						}else if($row['state'] == 'DAHR'){
							echo '<p><font color = "red">Dispproved by HR</font></p> '.$row['dareason'];
						}else if($row['state'] == 'DAACC'){
							echo '<p><font color = "red">Dispproved by Accounting</font></p> '.$row['dareason'];
						}else if($row['state'] == 'DAAdmin'){
							echo '<p><font color = "red">Dispproved by Dep. Head</font></p> '.$row['dareason'];
						}
					echo '<td></tr>';
			}
			echo '</tbody></table></form>';
		}
	}
?>
<?php 
	if(isset($_GET['ac']) && $_GET['ac'] == 'penob'){
		include("conf.php");
		$sql = "SELECT * FROM officialbusiness,login where login.account_id = $accid and officialbusiness.account_id = $accid and DAY(obdate) >= $forque and DAY(obdate) <= $endque and MONTH(obdate) = $dated and YEAR(obdate) = $datey ORDER BY obdate ASC";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
	?>	
		<form role = "form" action = "approval.php"    method = "get">
			<table class = "table table-hover" align = "center">
				<thead>
					<tr>
						<td colspan = 9 align = center><h2> Official Business Status </h2></td>
					</tr>
					<tr>
						<th>Date File</th>
						<th>Name of Employee</th>
						<th>Position</th>
						<th>Department</th>
						<th>Date of Request</th>
						<th>Time In - Time Out</th>
						<th>Offical Work Schedule</th>
						<th>Reason</th>
						<th>State</th>
					</tr>
				</thead>
				<tbody>
	<?php
			while($row = $result->fetch_assoc()){
				
				$originalDate = date($row['obdate']);
				$newDate = date("F j, Y", strtotime($originalDate));
				$datetoday = date("Y-m-d");
				if($datetoday >= $row['twodaysred'] && $row['state'] == 'UA' ){
					echo '<tr style = "color: red">';
				}else{
					echo '<tr>';
				}		
				echo 
					'	<td>'.$newDate.'</td>
						<td>'.$row["obename"].'</td>
						<td>'.$row["obpost"].'</td>
						<td >'.$row["obdept"].'</td>
						<td>'.date("F j, Y", strtotime($row['obdatereq'])).'</td>					
						<td>'.$row["obtimein"] . ' - ' . $row['obtimeout'].'</td>
						<td>'.$row["officialworksched"].'</td>				
						<td >'.$row["obreason"].'</td>	
					<td><b>';
							if($row['state'] == 'UA'){
								echo 'Pending';
							}else if($row['state'] == 'AHR'){
								echo '<p><font color = "green">Approved by HR</font></p> ' ;
							}else if($row['state'] == 'AACC'){
								echo '<p><font color = "green">Approved by Accounting</font></p> ' ;
							}else if($row['state'] == 'AAdmin'){
								echo '<p><font color = "green">Approved by Dep. Head</font></p> ' ;
							}else if($row['state'] == 'DAHR'){
								echo '<p><font color = "red">Dispproved by HR</font></p> '.$row['dareason'];
							}else if($row['state'] == 'DAACC'){
								echo '<p><font color = "red">Dispproved by Accounting</font></p> '.$row['dareason'];
							}else if($row['state'] == 'DAAdmin'){
								echo '<p><font color = "red">Dispproved by Dep. Head</font></p> '.$row['dareason'];
							}
						echo '<td></tr>';
		}
		echo '</tbody></table></form>';
	}$conn->close();
}
?>

<?php 
	if(isset($_GET['ac']) && $_GET['ac'] == 'penlea'){
		include("conf.php");
		$sql = "SELECT * FROM nleave,login where login.account_id = $accid and nleave.account_id = $accid and DAY(datefile) >= $forque and DAY(datefile) <= $endque and MONTH(datefile) = $dated and YEAR(datefile) = $datey ORDER BY datefile ASC";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
	?>	
	<form role = "form" action = "approval.php"    method = "get">
			<table class = "table table-hover " align = "center">
				<thead>
					<tr>
						<td colspan = 10 align = center><h2> Leave Application Status </h2></td>
					</tr>
					<tr>
						<th width = "170">Date File</th>
						<th width = "170">Name of Employee</th>
						<th width = "170">Date Hired</th>
						<th>Department</th>
						<th>Position</th>
						<th width = "250">Date of Leave (From - To)</th>
						<th width = "100">No. of Day/s</th>
						<th width = "170">Type of Leave</th>
						<th width = "160">Reason</th>
						<th>State</th>
					</tr>
				</thead>
				<tbody>
	<?php
			while($row = $result->fetch_assoc()){
				
				$originalDate = date($row['datefile']);
				$newDate = date("F j, Y", strtotime($originalDate));
				$newDate2 = date("F j, Y", strtotime($row["datehired"]));
				$datetoday = date("Y-m-d");
				if($datetoday >= $row['twodaysred'] && $row['state'] == 'UA' ){
					echo '<tr style = "color: red">';
				}else{
					echo '<tr>';
				}		
				echo 
					'<td>'.$newDate.'</td>
					<td>'.$row["nameofemployee"].'</td>
					<td>'.$newDate2.'</td>
					<td >'.$row["deprt"].'</td>
					<td>'.$row['posttile'].'</td>					
					<td width = "300">Fr: '.date("F j, Y", strtotime($row["dateofleavfr"])) .' <br>To: '.date("F j, Y", strtotime($row["dateofleavto"])).'</td>
					<td>'.$row["numdays"].'</td>					
					<td >'.$row["typeoflea"]. ' : ' . $row['othersl']. '</td>	
					<td >'.$row["reason"].'</td>	
					<td width = "200"><b>';
							if($row['state'] == 'UA'){
								echo 'Pending';
							}else if($row['state'] == 'AHR'){
								echo '<p><font color = "green">Approved by HR</font></p> ' ;
							}else if($row['state'] == 'AACC'){
								echo '<p><font color = "green">Approved by Accounting</font></p> ' ;
							}else if($row['state'] == 'AAdmin'){
								echo '<p><font color = "green">Approved by Dep. Head</font></p> ' ;
							}else if($row['state'] == 'DAHR'){
								echo '<p><font color = "red">Dispproved by HR</font></p> '.$row['dareason'];
							}else if($row['state'] == 'DAACC'){
								echo '<p><font color = "red">Dispproved by Accounting</font></p> '.$row['dareason'];
							}else if($row['state'] == 'DAAdmin'){
								echo '<p><font color = "red">Dispproved by Dep. Head</font></p> '.$row['dareason'];
							}
						echo '<td></tr>';
		}
		echo '</tbody></table></form>';
	}$conn->close();
}
?>
</div>
<?php include('req-form.php');?>
<?php include("footer.php");?>