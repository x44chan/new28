<?php session_start(); ?>
<?php  $title="H.R. Page";
	include('header.php');	
	date_default_timezone_set('Asia/Manila');
	$accid = $_SESSION['acc_id'];
?>
<?php if($_SESSION['level'] != 'ACC'){	?>		
	<script type="text/javascript">	window.location.replace("index.php");</script>	
<?php	} ?>
<div align = "center">
	<div class="alert alert-success"><br>
		Welcome <strong><?php echo $_SESSION['name'];?> !</strong> <br>
		<?php echo date('l jS \of F Y h:i A'); ?> <br><br>
		<div class="btn-group btn-group-lg">
			<a  type = "button"class = "btn btn-primary"  href = "?ac=penot">Home</a>
			<div class="btn-group btn-group-lg">
				<button type="button" class="btn btn-primary dropdown-toggle"  data-toggle="dropdown">New Request <span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu">
				  <li><a href="#" id = "newovertime">Overtime Request</a></li>
				  <li><a href="#" id = "newoffb">Official Business Request</a></li>
				  <li><a href="#" id = "newleave">Leave Of Absence Request</a></li>				  
				  <li><a href="#" id = "newundertime">Undertime Request Form</a></li>
				</ul>
			</div>
			<a type = "button" class = "btn btn-primary" href = "acc-report.php" id = "showapproveda">Cutoff Summary</a>	
			<div class="btn-group btn-group-lg">
				<button type="button" class="btn btn-primary dropdown-toggle"  data-toggle="dropdown">Petty Voucher <span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu">
				  <li><a type = "button"  href = "accounting-petty.php">Petty List</a></li>
				  <li><a type = "button"  href = "accounting-petty.php?report=1">Petty Report</a></li>
				</ul>
			</div>				
			<a type = "button" class = "btn btn-primary" href = "acc-req-app.php" id = "showapproveda">Approved Request</a>
			<a type = "button" class = "btn btn-primary" href = "acc-req-dapp.php"  id = "showdispproveda">Dispproved Request</a>
			<a type = "button" class = "btn btn-danger" href = "logout.php"  role="button">Logout</a>
		</div><br><br>
		<div class = "btn-group btn-group">
			<a  type = "button"class = "btn btn-success" id = "forpndot" href = "?ac=penot"> Overtime Request Status </a>
			<a  type = "button"class = "btn btn-success" id = "forpndob" href = "?ac=penob"> Official Business Request Status </a>			
			<a  type = "button"class = "btn btn-success" id = "forpnlea" href = "?ac=penlea"> Leave Request Status </a>		
			<a  type = "button"class = "btn btn-success" id = "fordpndun" href = "?ac=penundr"> Undertime Request Status </a>	
		</div> 
	</div>
</div>
<div id = "needaproval" style = "margin-top: -30px;">	
	<?php 
		
		if(isset($_GET['ac']) && $_GET['ac'] == 'penot'){
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
		include("conf.php");
		$sql = "SELECT * FROM overtime,login where login.account_id = '$accid' and overtime.account_id = '$accid' and DAY(datefile) >= $forque and DAY(datefile) < $endque and MONTH(datefile) = $dated and YEAR(datefile) = $datey ORDER BY datefile ASC";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
	?>
	<form role = "form" action = "approval.php"    method = "get">
		<table class = "table table-hover" align = "center">
			<thead>				
				<tr>
					<td colspan = 7 align = center><h2> Pending Overtime Request </h2></td>
				</tr>
				<tr >
					<th>Date File</th>
					<th>Date of Overtime</th>
					<th>Name of Employee</th>
					<th>Reason</th>
					<th>From - To (Overtime)</th>
					<th>Offical Work Schedule</th>
				</tr>
			</thead>
			<tbody>
	<?php
		while($row = $result->fetch_assoc()){				
			$originalDate = date($row['datefile']);
			$newDate = date("F j, Y", strtotime($originalDate));
			$datetoday = date("Y-m-d");
			if($datetoday >= $row['2daysred'] ){
				echo '<tr style = "color: red">';
			}else{
				echo '<tr>';
			}
			echo '
				<td width = 180>'.$newDate.'</td>
				<td>'.date("F j, Y", strtotime($row["dateofot"])).'</td>
				<td>'.$row["nameofemp"].'</td>
				<td width = 250 height = 70>'.$row["reason"].'</td>
				<td>'.$row["startofot"] . ' - ' . $row['endofot'].'</td>
				<td>'.$row["officialworksched"].'</td>';
					 if($row['state'] == 'UAACCAdmin' || $row['state'] == 'AACC' ){
						echo '<td><strong>Pending to Admin<strong></td>';
				}else{
			/*	echo'					
				<td width = "200">
					<a onclick = "return confirm(\'Are you sure?\');"href = "approval.php?approve=A'.$_SESSION['level'].'&overtime='.$row['overtime_id'].'&ac='.$_GET['ac'].'"';?><?php echo'" class="btn btn-info" role="button">Approve</a>
					<a href = "?approve=DA'.$_SESSION['level'].'&dovertime='.$row['overtime_id'].'&acc='.$_GET['ac'].'"';?><?php echo'" class="btn btn-info" role="button">Disapprove</a>
				</td>
				</tr>';*/
			}
		}
			echo '</tbody></table></form>';
		}else{
			echo '<h2 align = "center" style = "margin-top: 30px;"> No Overtime Request </h2>';
		}$conn->close();
	}
?>

<?php 
		if(isset($_GET['ac']) && $_GET['ac'] == 'penlea'){
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
		include("conf.php");
		$sql = "SELECT * FROM nleave,login where login.account_id = '$accid' and nleave.account_id = '$accid' and YEAR(dateofleavfr) = $datey ORDER BY datefile ASC";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
	?>
	<form role = "form" action = "approval.php"    method = "get">
		<table width = "100%"class = "table table-hover" align = "center">
			<thead>				
				<tr>
					<td colspan = 10 align = center><h2> Leave Application Status </h2></td>
				</tr>
				<tr>
					<th width = "150">Date File</th>
					<th width = "170">Name of Employee</th>
					<th width = "170">Date Hired</th>
					<th>Department</th>
					<th>Position</th>
					<th width = "210">Date of Leave</th>
					<th width = "100"># of Day/s</th>
					<th width = "170">Type of Leave</th>
					<th width = "180">Reason</th>
				</tr>
			</thead>
			<tbody>
	<?php
		while($row = $result->fetch_assoc()){				
			$originalDate = date($row['datefile']);
			$newDate = date("F j, Y", strtotime($originalDate));
			$datetoday = date("Y-m-d");
			if($datetoday >= $row['twodaysred'] ){
				echo '<tr style = "color: red">';
			}else{
				echo '<tr>';
			}
			echo '
					<td>'.$newDate.'</td>
					<td>'.$row["nameofemployee"].'</td>
					<td>'.date("F d, Y", strtotime($row["datehired"])).'</td>
					<td >'.$row["deprt"].'</td>
					<td>'.$row['posttile'].'</td>					
					<td> From: '.date("F d, Y", strtotime($row["dateofleavfr"])) .'<br>To: '.date("F d, Y", strtotime($row["dateofleavto"])).'</td>
					<td>'.$row["numdays"].'</td>					
					<td >'.$row["typeoflea"]. ' : ' . $row['othersl']. '</td>	
					<td >'.$row["reason"].'</td>';
					 if($row['state'] == 'UAACCAdmin' || $row['state'] == 'AACC'){
						echo '<td><strong>Pending to Admin<strong></td>';
				}else{
				/*echo'
					<td width = "200">
						<a onclick = "return confirm(\'Are you sure?\');" href = "approval.php?approve=A'.$_SESSION['level'].'&leave='.$row['leave_id'].'&ac='.$_GET['ac'].'"';?><?php echo'" class="btn btn-info" role="button">Approve</a>
						<a href = "?approve=DA'.$_SESSION['level'].'&dleave='.$row['leave_id'].'&acc='.$_GET['ac'].'"';?><?php echo'" class="btn btn-info" role="button">Disapprove</a>
					</td>
				</tr>';*/
			}
		}
			echo '</tbody></table></form>';
		}else{
			echo '<h2 align = "center" style = "margin-top: 30px;"> No Leave Request </h2>';
		}
	}
?>
<?php 
		if(isset($_GET['ac']) && $_GET['ac'] == 'penundr'){
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
		include("conf.php");
		$sql = "SELECT * FROM undertime,login where login.account_id = '$accid' and undertime.account_id = '$accid'   and DAY(datefile) >= $forque and DAY(datefile) < $endque and MONTH(datefile) = $dated and YEAR(datefile) = $datey ORDER BY datefile ASC";
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
					<th>Date of Overtime</th>
					<th>Name of Employee</th>
					<th>Reason</th>
					<th>From - To (Overtime)</th>
					<th>Number of Hrs/Minutes</th>
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
					<td>'.date('F j, Y', strtotime($row["dateofundrtime"])).'</td>
					<td>'.$row["name"].'</td>
					<td width = 250 height = 70>'.$row["reason"].'</td>
					<td>'.$row["undertimefr"] . ' - ' . $row['undertimeto'].'</td>
					<td>'.$row["numofhrs"].'</td>';
					 if($row['state'] == 'UAACCAdmin' || $row['state'] == 'AACC'){
						echo '<td><strong>Pending to Admin<strong></td>';
				}else{
				/*echo'				
					<td width = "200">
						<a onclick = "return confirm(\'Are you sure?\');" href = "approval.php?approve=A'.$_SESSION['level'].'&undertime='.$row['undertime_id'].'&ac='.$_GET['ac'].'"';?><?php echo'" class="btn btn-info" role="button">Approve</a>
						<a href = "?approve=DA'.$_SESSION['level'].'&dundertime='.$row['undertime_id'].'&acc='.$_GET['ac'].'"';?><?php echo'" class="btn btn-info" role="button">Disapprove</a>
					</td>
				</tr>';*/
			}
		}
			echo '</tbody></table></form>';
		}else{
			echo '<h2 align = "center" style = "margin-top: 30px;"> No Undertime Request </h2>';
		}$conn->close();
	}
?>
<?php
	if(isset($_GET['ac']) && $_GET['ac'] == 'penob'){
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
		include("conf.php");
		$sql = "SELECT * FROM officialbusiness,login where login.account_id = '$accid' and officialbusiness.account_id = '$accid'  and DAY(obdate) >= $forque and DAY(obdate) < $endque and MONTH(obdate) = $dated and YEAR(obdate) = $datey ORDER BY obdate ASC";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
?>
	<form role = "form" action = "approval.php"    method = "get">
		<table class = "table table-hover" align = "center">
			<thead>
				<tr>
					<td colspan = 9 align = center><h2> Official Business Application Status </h2></td>
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
				</tr>
			</thead>
			<tbody>
<?php
		while($row = $result->fetch_assoc()){			
			$originalDate = date($row['obdate']);
			$newDate = date("F j, Y", strtotime($originalDate));
			$datetoday = date("Y-m-d");
			if($datetoday >= $row['twodaysred'] ){
				echo '<tr style = "color: red">';
			}else{
				echo '<tr>';
			}		
			echo 
					'<td>'.$newDate.'</td>
					<td>'.$row["obename"].'</td>
					<td>'.$row["obpost"].'</td>
					<td >'.$row["obdept"].'</td>
					<td>'.date("F d, Y", strtotime($row['obdatereq'])).'</td>					
					<td>'.$row["obtimein"] . ' - ' . $row['obtimeout'].'</td>
					<td>'.$row["officialworksched"].'</td>				
					<td >'.$row["obreason"].'</td>';
					 if($row['state'] == 'UAACCAdmin' || $row['state'] == 'AACC'){
						echo '<td><strong>Pending to Admin<strong></td>';
				}else{
				/*echo'
					<td width = "200">
						<a onclick = "return confirm(\'Are you sure?\');" href = "approval.php?approve=A'.$_SESSION['level'].'&officialbusiness_id='.$row['officialbusiness_id'].'&ac='.$_GET['ac'].'"';?><?php echo'" class="btn btn-info" role="button">Approve</a>
						<a href = "?approve=DA'.$_SESSION['level'].'&dofficialbusiness_id='.$row['officialbusiness_id'].'&acc='.$_GET['ac'].'"';?><?php echo'" class="btn btn-info" role="button" id = "DAHR">Disapprove</a>
					</td>
				</tr>';*/
		}
	}
		echo '</tbody></table></form>';
	}else{
		echo '<h2 align = "center" style = "margin-top: 30px;"> No Official Request </h2>';
	}$conn->close();
}
?>
</div>
<?php include("req-form.php");?>
<?php include("footer.php");?>
