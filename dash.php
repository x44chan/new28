	<!---<form role = "form">
		<table class = "table table-hover" align = "center">
			<thead>
				<tr>
					<td colspan = 7 align = center><h2> Admin Dashboard </h2></td>
				</tr>
				<tr>
					<th>Date File</th>					
					<th>Name of Employee</th>
					<th>Type</th>
					<th>Reason</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			--->
		<?php
			
				
			include('header.php');
			/*include('conf.php');
			$sql = "SELECT dash.type_id, overtime.state, overtime.overtime_id as otid from dash,overtime where dash.type_id = overtime.overtime_id and overtime.state = 'UA' ORDER BY datefile ASC";
			$result = $conn->query($sql);
			if($result->num_rows > 0){			
				while($row = $result->fetch_assoc()){
					
					echo '<td width = "200">
							<a href = "approval.php?approve=A&ot='.$row['otid'].'"';?><?php echo'" class="btn btn-info" role="button">Approve</a>
							<a href = "approval.php?approve=DA&ot='.$row['otid'].'"';?><?php echo'" class="btn btn-info" role="button">Disapprove</a>
						</td></tr>';
				}
			}
			
			$sql = "SELECT login.fname as xfname, login.lname as lname, 
						officialbusiness.obdate as obdate, officialbusiness.obreason as obreason,
						overtime.datefile as otdate, overtime.reason as otreason,
						
						overtime.account_id as otid, nleave.account_id, officialbusiness.account_id as obaccid ,undertime.account_id 
					FROM overtime,login,nleave,officialbusiness,undertime 
					where login.account_id = overtime.account_id 
						and login.account_id = nleave.account_id 
						and login.account_id = officialbusiness.account_id 
						and login.account_id = undertime.account_id 
						and undertime.state = 'UA'
						and nleave.state = 'UA'
						and officialbusiness.state = 'UA'
						and overtime.state = 'UA' ORDER BY obdate ASC, otdate DESC";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					if($row['obdate'] != ""){
						$originalDate = date($row['obdate']);
						$newDate = date("F j, Y", strtotime($originalDate));
						echo '<tr><td>'. $newDate .'</td>';
						echo '<td>'.$row['obreason'].'</td>';
						echo '<td>Official Business</td>';
						echo '<td>'.$row['obreason'].'</td>';
						echo '<td width = "200">
							<a href = "approval.php?approve=A&officialbusiness_id='.$row['obaccid'].'"';?><?php echo'" class="btn btn-info" role="button">Approve</a>
							<a href = "approval.php?approve=DA&officialbusiness_id='.$row['obaccid'].'"';?><?php echo'" class="btn btn-info" role="button">Disapprove</a>
						</td></tr>';
					}
						
					if($row['otid'] != ""){
						$originalDate = date($row['otdate']);
						$newDate = date("F j, Y", strtotime($originalDate));
						echo '<tr><td>'. $newDate .'</td>';
						echo '<td>'.$row['otreason'].'</td>';
						echo '<td>OT</td>';
						echo '<td>'.$row['obreason'].'</td>';
						echo '<td width = "200">
							<a href = "approval.php?approve=A&officialbusiness_id='.$row['obaccid'].'"';?><?php echo'" class="btn btn-info" role="button">Approve</a>
							<a href = "approval.php?approve=DA&officialbusiness_id='.$row['obaccid'].'"';?><?php echo'" class="btn btn-info" role="button">Disapprove</a>
						</td></tr>';
					}
				}
			}
			/*
			$sql = "SELECT * from overtime,login where login.account_id = overtime.account_id and state = 'UA' ORDER BY datefile ASC";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				$datetoday = date("Y-m-d");
				if($datetoday >= $row['twodaysred'] ){
					echo '<tr style = "color: red">';
				}else{
					echo '<tr>';
				}
				while($row = $result->fetch_assoc()){
					$originalDate = date($row['obdate']);
					$newDate = date("F j, Y", strtotime($originalDate));	
					echo '<tr><td>'.$newDate .'</td>';
					echo '<td>'.$row['fname'] .' ' .$row['lname'] .'</td>';
					echo '<td>OT</td>';
					echo '<td>'.$row['reason'].'</td>';
					echo '<td width = "200">
							<a href = "approval.php?approve=A&overtime='.$row['overtime_id'].'"';?><?php echo'" class="btn btn-info" role="button">Approve</a>
							<a href = "approval.php?approve=DA&overtime='.$row['overtime_id'].'"';?><?php echo'" class="btn btn-info" role="button">Disapprove</a>
						</td></tr>';
				}
			}
			$sql = "SELECT * from undertime,login where login.account_id = undertime.account_id and state = 'UA' ORDER BY datefile ASC";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo '<tr><td>'.$row['datefile'] .'</td>';
					echo '<td>'.$row['fname'] .' ' .$row['lname'] .'</td>';
					echo '<td>Undertime</td>';
					echo '<td>'.$row['reason'].'</td>';
					echo '<td width = "200">
							<a href = "approval.php?approve=A&undertime='.$row['undertime_id'].'"';?><?php echo'" class="btn btn-info" role="button">Approve</a>
							<a href = "approval.php?approve=DA&undertime='.$row['undertime_id'].'"';?><?php echo'" class="btn btn-info" role="button">Disapprove</a>
						</td></tr>';
				}
			}
			$sql = "SELECT * from officialbusiness,login where login.account_id = officialbusiness.account_id and state = 'UA' ORDER BY obdate ASC";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo '<tr><td>'.$row['obdate'] .'</td>';
					echo '<td>'.$row['fname'] .' ' .$row['lname'] .'</td>';
					echo '<td>Official Business</td>';
					echo '<td>'.$row['obreason'].'</td>';
					echo '<td width = "200">
							<a href = "approval.php?approve=A&officialbusiness_id='.$row['officialbusiness_id'].'"';?><?php echo'" class="btn btn-info" role="button">Approve</a>
							<a href = "approval.php?approve=DA&officialbusiness_id='.$row['officialbusiness_id'].'"';?><?php echo'" class="btn btn-info" role="button">Disapprove</a>
						</td></tr>';
				}
			}
			$sql = "SELECT * from nleave,login where login.account_id = nleave.account_id and state = 'UA' ORDER BY datefile ASC";
			$result = $conn->query($sql);
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					echo '<tr><td>'.$row['datefile'] .'</td>';
					echo '<td>'.$row['fname'] .' ' .$row['lname'] .'</td>';
					echo '<td>'.$row['typeoflea']. ' ' .$row['othersl']. '</td>';
					echo '<td>'.$row['reason'].'</td>';
					echo '<td width = "200">
							<a href = "approval.php?approve=A&leave='.$row['leave_id'].'"';?><?php echo'" class="btn btn-info" role="button">Approve</a>
							<a href = "approval.php?approve=DA&leave='.$row['leave_id'].'"';?><?php echo'" class="btn btn-info" role="button">Disapprove</a>
						</td></tr>';
				}
			}*/
		?>
		</tbody>
		</table>
	</form>
			/*

			12 hr to 24 hr
			echo date('H:i', strtotime($row["startofot"])) . '<br>';
			echo date('H:i', strtotime($row["endofot"])) . '<br>';

			$todate= strtotime($row["dateofleavfr"]);
			$fromdate= strtotime($row["dateofleavto"]);
			$calculate_seconds = $fromdate - $todate; // Number of seconds between the two dates
			$days = floor($calculate_seconds / (24 * 60 * 60 )); // convert to days

			//24 Hr OT Calculator
			$time1 = date('H:i', strtotime($row["startofot"]));
			$time2 = date('H:i', strtotime($row["endofot"]));
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
			//else if($hours == 0 && $minutes == 0){
				//	$hours = 24;
			//}
			echo $hours . ' ' . $minutes .'<br>';
			$hours = 0;
			$minutes = 0;
			*/
			//end of computation
  <h2>Modal Login Example</h2>
  <!-- Trigger the modal with a button -->
   <style>
  .modal-header, h4, .close {
      background-color: #5cb85c;
      color:white !important;
      text-align: center;
      font-size: 30px;
  }
  .modal-footer {
      background-color: #f9f9f9;
  }
  </style>
  <button type="button" class="btn btn-default btn-lg" id="myBtn">Login</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Login</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form role="form" action = "index.php" method = "post">
            <div class="form-group">
              <label for="usrname"><span class="glyphicon glyphicon-user"></span> Username</label>
              <input type="text" class="form-control" id="usrname" name = "uname" placeholder="Enter username">
            </div>
            <div class="form-group">
              <label for="psw"><span class="glyphicon glyphicon-eye-open"></span> Password</label>
              <input type="text" class="form-control" id="psw" name = "password" placeholder="Enter password">
            </div>
            <div class="checkbox">
              <label><input type="checkbox" value="" checked>Remember me</label>
            </div>
              <button type="submit" name = "submit" class="btn btn-success btn-block"><span class="glyphicon glyphicon-off"></span> Login</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
          <p>Not a member? <a href="#">Sign Up</a><a/p>
          <p>Forgot <a href="#">Password?</a></p>
        </div>
      </div>
      
    </div>
  </div> 
</div>
 
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
});
</script>