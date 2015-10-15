<?php session_start(); ?>
<?php  $title="H.R. Page";
	include('header.php');	
	date_default_timezone_set('Asia/Manila');
?>
<?php if($_SESSION['level'] != 'HR'){ ?>		
	<script type="text/javascript">	window.location.replace("index.php");</script>		
<?php	} ?>
<div align = "center">
	<div class="alert alert-success"><br>
		Welcome <strong><?php echo $_SESSION['name'];?> !</strong> <br>
		<?php echo date('l jS \of F Y h:i A'); ?> <br><br>
		<div class="btn-group btn-group-lg">
			<a  type = "button"class = "btn btn-primary"  href = "hr.php?ac=penot">Home</a>
			<div class="btn-group btn-group-lg">
				<button type="button" class="btn btn-primary dropdown-toggle"  data-toggle="dropdown">New Request <span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu">
				  <li><a href="#" id = "newovertime">Overtime Request</a></li>
				  <li><a href="#" id = "newoffb">Official Business Request</a></li>
				  <li><a href="#" id = "newleave">Leave Of Absence Request</a></li>				  
				  <li><a href="#" id = "newundertime">Undertime Request Form</a></li>
				</ul>
			</div>
			<a type = "button" class = "btn btn-primary"  href = "hr-req-app.php" id = "showapproveda">Approved Request</a>
			<a type = "button" class = "btn btn-primary" href = "hr-req-dapp.php"  id = "showdispproveda">Dispproved Request</a>
			<a type = "button" class= "btn btn-danger" href = "logout.php"  role="button">Logout</a>
		</div><br><br>
		<div class = "btn-group btn-group-justified" style = "width: 80%">
			<a  type = "button"class = "btn btn-success" id = "forpndot" href = "?ac=penot"> Pending Overtime Request </a>
			<a  type = "button"class = "btn btn-success" id = "forpndob" href = "?ac=penob"> Pending Official Business Request </a>			
			<a  type = "button"class = "btn btn-success" id = "forpnlea" href = "?ac=penlea"> Pending Leave Request </a>		
			<a  type = "button"class = "btn btn-success" id = "fordpndun" href = "?ac=penundr"> Pending Undertime Request </a>	
		</div> 
	</div>
</div>
<div id = "needaproval" style = "margin-top: -30px;">		
	<?php 
		if(isset($_GET['ac']) && $_GET['ac'] == 'penot'){
			if(date("D") == 'Mon'){
				$forque = date("d") -3;
				$endque = date("d");
			}else{
				$forque = date("d") - 1;
				$endque = date("d");
			}
		$date17 = date("d");
		$dated = date("m");
		$datey = date("Y");
		include("conf.php");
		$sql = "SELECT * FROM overtime,login where login.account_id = overtime.account_id and state like 'UA' and DAY(datefile) >= $forque and DAY(datefile) <= $endque and MONTH(datefile) = $dated and YEAR(datefile) = $datey ORDER BY datefile ASC";
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
						<th>Action</th>
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
				echo 
					'	<td width = 180>'.$newDate.'</td>
						<td>'.date("F j, Y", strtotime($row["dateofot"])).'</td>
						<td>'.$row["nameofemp"].'</td>
						<td width = 250 height = 70>'.$row["reason"].'</td>
						<td>'.$row["startofot"] . ' - ' . $row['endofot'].'</td>
						<td>'.$row["officialworksched"].'</td>';
				if($row['state'] == 'UAACCAdmin'){
						echo '<td><strong>Pending to Admin<strong></td>';
				}else{
					echo '<td width = "250">
							<a onclick = "return confirm(\'Are you sure?\');" href = "approval.php?approve=A'.$_SESSION['level'].'&overtime='.$row['overtime_id'].'&ac='.$_GET['ac'].'"';?><?php echo'" class="btn btn-info" role="button"><span class="glyphicon glyphicon-check"></span> Ok</a>
							<a href = "?approve=DA'.$_SESSION['level'].'&upovertime='.$row['overtime_id'].'&acc='.$_GET['ac'].'"';?><?php echo'" class="btn btn-warning" role="button"><span class="glyphicon glyphicon-edit"></span> Edit</a>
							<a href = "?approve=DA'.$_SESSION['level'].'&dovertime='.$row['overtime_id'].'&acc='.$_GET['ac'].'"';?><?php echo'" class="btn btn-danger" style = "margin-top: 2px; role="button"><span class="glyphicon glyphicon-remove-sign"></span> Disapprove</a>
						</td>
					</tr>';
				}
			}
			echo '</tbody></table></form>';
		}else{
			echo '<h2 align = "center" style = "margin-top: 30px;"> No Pending Overtime Request </h2>';
		}
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
		$sql = "SELECT * FROM nleave,login where login.account_id = nleave.account_id and state like 'UA' and YEAR(dateofleavfr) = $datey ORDER BY datefile ASC";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
	?>
	<form role = "form" action = "approval.php"    method = "get">
			<table width = "100%"class = "table table-hover" align = "center">
				<thead>				
					<tr>
						<td colspan = 10 align = center><h2> Pending Leave Request </h2></td>
					</tr>
					<tr>
						<th width = "160">Date File</th>
						<th width = "170">Name of Employee</th>
						<th width = "170">Date Hired</th>
						<th>Department</th>
						<th>Position</th>
						<th width = "200">Date of Leave</th>
						<th width = "120"># of Day/s</th>
						<th width = "170">Type of Leave</th>
						<th width = "180">Reason</th>
						<th width = "240">Action</th>
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
				echo 
					'<td>'.$newDate.'</td>
					 <td>'.$row["nameofemployee"].'</td>
					 <td>'.date("F d, Y", strtotime($row["datehired"])).'</td>
					 <td >'.$row["deprt"].'</td>
					 <td>'.$row['posttile'].'</td>					
					 <td> Fr: '.date("F d, Y", strtotime($row["dateofleavfr"])) .'<br>To: '.date("F d, Y", strtotime($row["dateofleavto"])).'</td>
					 <td>'.$row["numdays"].'</td>					
					 <td >'.$row["typeoflea"]. ' : ' . $row['othersl']. '</td>	
					 <td >'.$row["reason"].'</td>';
					 if($row['state'] == 'UAACCAdmin'){
						echo '<td><strong>Pending to Admin<strong></td>';
				}else{
				echo'	
					 <td width = "200">
						<a onclick = "return confirm(\'Are you sure?\');" href = "approval.php?approve=A'.$_SESSION['level'].'&leave='.$row['leave_id'].'&ac='.$_GET['ac'].'"';?><?php echo'" class="btn btn-info" role="button">Checked</a>
						<a href = "?approve=DA'.$_SESSION['level'].'&dleave='.$row['leave_id'].'&acc='.$_GET['ac'].'"';?><?php echo'" class="btn btn-danger" role="button">Disapprove</a>
					</td>
					</tr>';
			}
		}
			echo '</tbody></table></form>';
		}else{
			echo '<h2 align = "center" style = "margin-top: 30px;"> No Pending Leave Request </h2>';
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
		$sql = "SELECT * FROM undertime,login where login.account_id = undertime.account_id and state like 'UA' and DAY(datefile) >= $forque and DAY(datefile) < $endque and MONTH(datefile) = $dated and YEAR(datefile) = $datey ORDER BY datefile ASC";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
	?>
	<form role = "form" action = "approval.php"    method = "get">
			<table class = "table table-hover" align = "center">
				<thead>				
					<tr>
						<td colspan = 7 align = center><h2> Pending Undertime Request </h2></td>
					</tr>
					<tr >
						<th>Date File</th>
						<th>Date of Undertime</th>
						<th>Name of Employee</th>
						<th>Reason</th>
						<th>Fr - To (Undertime)</th>
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
					<td>'.$row["numofhrs"].'</td>	';
					 if($row['state'] == 'UAACCAdmin'){
						echo '<td><strong>Pending to Admin<strong></td>';
				}else{
				echo'				
					<td width = "200">
						<a onclick = "return confirm(\'Are you sure?\');" href = "approval.php?approve=A'.$_SESSION['level'].'&undertime='.$row['undertime_id'].'&ac='.$_GET['ac'].'"';?><?php echo'" class="btn btn-info" role="button">Checked</a>
						<a href = "?approve=DA'.$_SESSION['level'].'&dundertime='.$row['undertime_id'].'&acc='.$_GET['ac'].'"';?><?php echo'" class="btn btn-danger" role="button">Disapprove</a>
					</td>
				</tr>';
			}}
			echo '</tbody></table></form>';
		}else{
			echo '<h2 align = "center" style = "margin-top: 30px;"> No Pending Undertime Request </h2>';
		}
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
	$sql = "SELECT * FROM officialbusiness,login where login.account_id = officialbusiness.account_id and state like 'UA' and DAY(obdate) >= $forque and DAY(obdate) < $endque and MONTH(obdate) = $dated and YEAR(obdate) = $datey ORDER BY obdate ASC";
	$result = $conn->query($sql);
	if($result->num_rows > 0){
?>

	<form role = "form" action = "approval.php"    method = "get">
		<table class = "table table-hover" align = "center">
			<thead>
				<tr>
					<td colspan = 9 align = center><h2> Pending Official Business Request </h2></td>
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
					<th>Action</th>
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
					'<td>'.$newDate.'</td>
					<td>'.$row["obename"].'</td>
					<td>'.$row["obpost"].'</td>
					<td >'.$row["obdept"].'</td>
					<td>'.date("F d, Y", strtotime($row['obdatereq'])).'</td>					
					<td>'.$row["obtimein"] . ' - ' . $row['obtimeout'].'</td>
					<td>'.$row["officialworksched"].'</td>				
					<td >'.$row["obreason"].'</td>	';
					if($row['state'] == 'UAACCAdmin'){
						echo '<td><strong>Pending to Admin<strong></td>';
					}else{
					echo'
						<td width = "200">
							<a onclick = "return confirm(\'Are you sure?\');" href = "approval.php?approve=A'.$_SESSION['level'].'&officialbusiness_id='.$row['officialbusiness_id'].'&ac='.$_GET['ac'].'"';?><?php echo'" class="btn btn-info" role="button">Checked</a>
							<a href = "?approve=DA'.$_SESSION['level'].'&dofficialbusiness_id='.$row['officialbusiness_id'].'&acc='.$_GET['ac'].'"';?><?php echo'" class="btn btn-danger" role="button" id = "DAHR">Disapprove</a>
						</td>
					</tr>';
					}
		}
		echo '</tbody></table></form>';
	}else{
		echo '<div id = "dash"><h2 align = "center" style = "margin-top: 30px;"> No Pending Official Request </h2></div>';
	}$conn->close();
}
?>

<?php
	
	include('conf.php');
	if(isset($_GET['upovertime'])){	
		$id = mysqli_real_escape_string($conn, $_GET['upovertime']);
		$state = mysqli_real_escape_string($conn, $_GET['approve']);
		$sql = "SELECT * FROM overtime,login where login.account_id = overtime.account_id and overtime_id = '$id' and state = 'UA'";
		$result = $conn->query($sql);		
		if($result->num_rows > 0){
			echo '<form action = "update-exec.php" method = "post" class = "form-group">
					<table class = "table table-hover" style = "width: 720px; border: none;" align = "center">
						<thead>
							<tr>
								<th colspan  = 3><h3> Update Time  </h3></th>
							</tr>
						</thead>';
			while($row = $result->fetch_assoc()){
				?>	
				<tr>
					<td><b>Date File: </b></td>
					<td><?php echo date("F j, Y", strtotime($row['datefile']));?></td>
				</tr>
				<tr>
					<td><b>Name of Employee: </b></td>
					<td><?php echo $row['nameofemp']?></td>
				</tr>
				<tr>
					<td><b>Position: </b></td>
					<td><?php echo $row['position'];?></td>
				</tr>
				<tr>
					<td><b>Department: </b></td>
					<td><?php echo $row['department'];?></td>
				</tr>
				<tr>
					<?php
						if($row['dateam'] != '0000-00-00'){
							$fr = "<b>Fr: </b>";
							$dateam = ' <b>To: </b>' . date('F j, Y', strtotime($row['dateam']));
						}else{
							$dateam = "";
							$fr = "";
						}
					?>
					<td><b>Date Of Overtime: </b></td>
					<td><?php echo $fr.date("F j, Y", strtotime($row['dateofot'])) . $dateam;?></td>
				</tr>				
				<tr>
					<td><b>Reason (Work to be done): </b></td>
					<td><?php echo $row['reason'];?></td>	
				</tr>
			<div class = "ui-widget-content" style = "border: none;">
				<tr>
					<td><b>Start of OT: </b></td>
					<td><?php echo $row['startofot'];?></td>
				</tr>				
				<tr>
					<td><b>End of OT: </b></td>
					<td><?php echo $row['endofot'];?></td>
				</tr>
				<?php 
					$count = strlen($row['officialworksched']);
					if($count < 8){
						$ex1 = "";
						$ex2 = "";
					}else{
						$explode = explode(" - ", $row['officialworksched']);
						$ex1 = $explode[0];
						$ex2 = $explode[1];
					}					
				?>	
				<tr id = "rday" class = "form-inline" >
					<td><b>Official Work Sched: </b></td>
					<td>
					<?php if($row['officialworksched'] != "Restday"){ echo'
					
						<label for = "fr">From:</label><input onkeydown="return false;"name = "upoffr" value = "'.$ex1.'"readonly placeholder = "Click to Set time" required style = "width: 130px;" autocomplete ="off" id = "to"class = "form-control"  />
						<label for = "to">To:</label><input onkeydown="return false;"name = "upoffto"value = "'. $ex2.'"readonly placeholder = "Click to Set time" required style = "width: 130px;" autocomplete ="off" class = "form-control" id = "fr"  />
					';
					}else{
						echo 'RESTDAY';
					}
					?>	
					</td>			
				</tr>
				<tr>
					<td><b>New Start of OT: </b></td>
					<td>
						<input id = "timein" onkeydown="return false;" value = "<?php echo $row['startofot'];?>" required class = "form-control" name = "hruptimein" autocomplete ="off" placeholder = "Click to Set time"/>
					</td>
				</tr>				
				<tr>
					<td><b>New End of OT: </b></td>
					<td><input  value = "<?php echo $row['endofot'];?>" onkeydown="return false;"required class = "form-control" name = "hruptimeout" placeholder = "Click to Set time" autocomplete ="off" /></td>
				</tr>
				<tr id = "warning" style="display: none;">
					<td></td>
					<td>
						<div class="alert alert-danger fade in">
						  <strong>Warning!</strong> Fill out <b>Time In</b> or <b>Time Out</b>
						</div>
					</td>
				</tr>
				<tr>
					<td align = "right"><label for = "dareason"> Reason </label></td>
					<td><textarea id = "dareason" class = "form-control" type = "text" name = "dareason" required ></textarea></td>
				</tr>
				<tr style="display:none;">
					<td>
						<input value = "<?php echo $row['startofot'];?>" type = "hidden" name = "oldotstrt"/>
						<input value = "<?php echo $row['endofot'];?>" type = "hidden" name = "oldotend"/>
						<input value = "<?php echo $row['account_id'];?>" type = "hidden" name = "accid"/>
					</td>
				</tr>		
				<script type="text/javascript">
					$(document).ready(function(){	
						$('#obtimein').click(function() {
							$("#warning").hide();
						});
						$("#submits").click(function(){						
							if($("#obtimein").val() == "" && $("#obtimeout").val() == "" ){
								$("#warning").show();
								return false;
							}else{
								$("#warning").hide();
							}
						});
					});
				</script>
				<script type="text/javascript">
					$(document).ready(function(){
						$('input[name="hruptimein"]').ptTimeSelect();
						$('input[name="hruptimeout"]').ptTimeSelect();
						
					});
				</script>
		</div>
	<?php
			}
			echo '<tr>
					<td colspan = 2>
						<button onclick = "return confirm(\'Are you sure? (Edit Time)\');" type = "submit" class = "btn btn-primary" name = "hrupdatetime" value = "Submit Edit"><span class="glyphicon glyphicon-ok-sign"></span> Submit</button>
						<a href = "?ac=penot" class = "btn btn-danger"><span class="glyphicon glyphicon-menu-left"></span> Back</a>
					</td>
				</tr>
			  	</tr>
			  	<tr>
					<td><input type = "hidden" name = "overtime" value = "'.$id.'"/></td>
					<td><input type = "hidden" name = "approve" value = "'.$state.'"/></td>
					<td><input type = "hidden" name = "ac" value = "'.$_GET['acc'].'"/></td>
			  	</tr>
			</table>
		</form>';
		}
		
			
	}
?>

<?php
	include('conf.php');
	if(isset($_GET['dofficialbusiness_id'])){
		$id = mysqli_real_escape_string($conn, $_GET['dofficialbusiness_id']);
		$state = mysqli_real_escape_string($conn, $_GET['approve']);
		echo '<form action = "approval.php" method = "get" class = "form-group">
				<table class = "table table-hover" align = "center">
					<thead>
						<tr>
							<th colspan  = 3><h3> Disapproval Reason </h3></th>
						</tr>
					</thead>
					<tr>
						<td align = "right"><labe for = "dareason">Input Disapproval reason</labe></td>
						<td><textarea id = "dareason" class = "form-control" type = "text" name = "dareason" required ></textarea></td>
					</tr>
					<tr>
						<td colspan = 2><input type = "submit" class = "btn btn-primary" name = "subda"/>   <a href = "?ac=penob" class = "btn btn-danger"><span class="glyphicon glyphicon-menu-left"></span> Back</a></td>
					</tr>
					<tr>
						<td><input type = "hidden" name = "officialbusiness_id" value = "'.$id.'"/></td>
						<td><input type = "hidden" name = "approve" value = "'.$state.'"/></td>
						<td><input type = "hidden" name = "ac" value = "'.$_GET['acc'].'"/></td>
					</tr>
				</table>
			</form>';		
	}
?>


<?php
	include('conf.php');
	if(isset($_GET['dundertime'])){
		$id = mysqli_real_escape_string($conn, $_GET['dundertime']);
		$state = mysqli_real_escape_string($conn, $_GET['approve']);
		echo '<form action = "approval.php" method = "get" class = "form-group">
				<table class = "table table-hover" align = "center">
					<thead>
						<tr>
							<th colspan  = 3><h3> Disapproval Reason </h3></th>
						</tr>
					</thead>
					<tr>
						<td align = "right"><labe for = "dareason">Input Disapproval reason</labe></td>
						<td><textarea id = "dareason" class = "form-control" type = "text" name = "dareason" required ></textarea></td>
					</tr>
					<tr>
						<td colspan = 2><input type = "submit" class = "btn btn-primary" name = "subda"/>   <a href = "?ac=penundr" class = "btn btn-danger"><span class="glyphicon glyphicon-menu-left"></span> Back</a></td>
					</tr>
					<tr>
						<td><input type = "hidden" name = "undertime" value = "'.$id.'"/></td>
						<td><input type = "hidden" name = "approve" value = "'.$state.'"/></td>
						<td><input type = "hidden" name = "ac" value = "'.$_GET['acc'].'"/></td>
					</tr>
				</table>
			</form>';	
}
?>


<?php
	include('conf.php');
	if(isset($_GET['dleave'])){
		$id = mysqli_real_escape_string($conn, $_GET['dleave']);
		$state = mysqli_real_escape_string($conn, $_GET['approve']);
		echo '<form action = "approval.php" method = "get" class = "form-group">
				<table class = "table table-hover" align = "center">
					<thead>
						<tr>
							<th colspan  = 3><h3> Disapproval Reason </h3></th>
						</tr>
					</thead>
					<tr>
						<td align = "right"><labe for = "dareason">Input Disapproval reason</labe></td>
						<td><textarea id = "dareason" class = "form-control" type = "text" name = "dareason" required ></textarea></td>
					</tr>
					<tr>
						<td colspan = 2><input type = "submit" class = "btn btn-primary" name = "subda"/>   <a href = "?ac=penlea" class = "btn btn-danger"><span class="glyphicon glyphicon-menu-left"></span> Back</a></td>
					</tr>
					<tr>
						<td><input type = "hidden" name = "leave" value = "'.$id.'"/></td>
						<td><input type = "hidden" name = "approve" value = "'.$state.'"/></td>
						<td><input type = "hidden" name = "ac" value = "'.$_GET['acc'].'"/></td>
					</tr>
				</table>
			</form>';			
	}

		if(isset($_GET['dovertime'])){	
			$id = mysqli_real_escape_string($conn, $_GET['dovertime']);
			$state = mysqli_real_escape_string($conn, $_GET['approve']);
			echo '<form action = "approval.php" method = "get" class = "form-group">
					<table class = "table table-hover" align = "center">
						<thead>
							<tr>
								<th colspan  = 3><h3> Disapproval Reason </h3></th>
							</tr>
						</thead>
						<tr>
							<td align = "right"><labe for = "dareason">Input Disapproval reason</labe></td>
							<td><textarea id = "dareason" class = "form-control" type = "text" name = "dareason" required ></textarea></td>
						</tr>
						<tr>
							<td colspan = 2><input type = "submit" class = "btn btn-primary" name = "subda"/>   <a href = "?ac=penot" class = "btn btn-danger"><span class="glyphicon glyphicon-menu-left"></span> Back</a></td>
						</tr>
						<tr>
							<td><input type = "hidden" name = "overtime" value = "'.$id.'"/></td>
							<td><input type = "hidden" name = "approve" value = "'.$state.'"/></td>
							<td><input type = "hidden" name = "ac" value = "'.$_GET['acc'].'"/></td>
						</tr>
					</table>
				</form>';
			}
?>
</div>
<?php include("req-form.php");?>
<?php include("footer.php");?>
