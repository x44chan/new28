<div id = "offb" style = "margin-top: -30px; display: none; padding: ">
	<form role = "form"  align = "center"action = "ob-exec.php" method = "post">
		<div class = "form-group">
			<table width = "60%" align = "center">
				<tr>
					<td colspan = 3 align = center>
						<h2> Official Business Request </h2>
					</td>
				</tr>
				<tr>
					<td>Date File: </td>
					<td><input type = "text"  class = "form-control" readonly name = "obdate" value = "<?php echo date('F j, Y');?>"/></td>
				</tr>
				<tr>
					<td>Name of Employee: </td>
					<td><input required class = "form-control" type = "text" value = "<?php echo $_SESSION['name'];?>" readonly name = "obename"/></td>
				</tr>
				<tr>
					<td>ID No: </td>
					<td><input required class = "form-control" type = "text" value = "<?php echo $_SESSION['acc_id'];?>" readonly name = "idnum"/></td>
				</tr>
				<tr>
					<td>Position: </td>
					<td><input required class = "form-control" type = "text" name = "obpost"/></td>
				</tr>
				<tr>
					<td>Department: </td>
					<td><input required class = "form-control" type = "text" name = "obdept"/></td>
				</tr>
				<tr>
					<td>Date Of Official Business: </td>
					<td><input required class = "form-control" type = "date" min = "<?php echo date('m/d/Y'); ?>" name = "obdatereq"/></td>
				</tr>				
				<tr>
					<td>Description of Work Order: </td>
					<td><textarea required name = "obreason" class = "form-control col-sm-10"></textarea></td>
					<td></td>
				</tr>
				<div class = "ui-widget-content" style = "border: none;">
				<tr>
					<td>Time In: </td>
					<td>
						<input required class = "form-control" readonly name = "obtimein" autocomplete ="off" placeholder = "Click to Set time"/>
					</td>
				</tr>				
				<tr>
					<td>Time Out: </td>
					<td><input required class = "form-control" readonly name = "obtimeout" placeholder = "Click to Set time" autocomplete ="off" /></td>
				</tr>				
				<tr class = "form-inline">
					<td>Official Work Sched: </td>
					<td>
						<label for = "fr">From:</label><input readonly placeholder = "Click to Set time" required style = "width: 130px;" autocomplete ="off" id = "to"class = "form-control"  name = "obofficialworkschedfr"/>
						<label for = "to">To:</label><input readonly placeholder = "Click to Set time" required style = "width: 130px;" autocomplete ="off" class = "form-control" id = "fr"  name = "obofficialworkschedto"/>
					</td>
					
				</tr>
				<script type="text/javascript">
					$(document).ready(function(){
						$('input[name="obtimein"]').ptTimeSelect();
						$('input[name="obofficialworkschedto"]').ptTimeSelect();
						$('input[name="obofficialworkschedfr"]').ptTimeSelect();							
						$('input[name="obtimeout"]').ptTimeSelect();
					});
				</script>
				</div>
				<tr>
					<td style = "padding: 3px;"colspan = "2" align = center>
						<input type = "submit" name = "submit" class = "btn btn-default"/>					
						<input type = "button" id = "hideob" name = "submit" class = "btn btn-default" value = "Cancel">
					</td>
				</tr>
			</table>
		</div>
	</form>
</div>
<div id = "undertime"style = "margin-top: -30px; display: none;">
	<?php include('undertime.php'); ?>
</div>
<div id = "formhidden"style = "margin-top: -30px;display: none;">
	<form role = "form"  align = "center"action = "ot-exec.php" method = "post">
		<div class = "form-group">
			<table align = "center" >
				<tr>
					<td colspan = 2 align = center>
						<h2> Overtime Request </h2>
					</td>
				</tr>
				<tr style = "display: none;">
					<td colspan = 2 align = center>
						<h5><p style = "font-style: italic; color: red;">No over 30 Minutes or less than 30 Minutes. (Counted Overtime is 30 Minutes or Hour/s Only)<br>6:00 PM - 8.50 PM (Counted Overtime: 2 Hours and 30 Minutes)	</h5>
					</td>
				</tr>	
				<tr>
					<td>Date File: </td>
					<td><input type = "text" class = "form-control" readonly name = "datefile" value = "<?php echo date('F j, Y');?>"/></td>
				</tr>
				<tr>
					<td>Date Of Overtime: </td>
					<td><input required class = "form-control" type = "date" min = "<?php echo date('m/d/Y'); ?>" name = "dateofot"/></td>
				</tr>				
				<tr>
					<td>Name of Employee: </td>
					<td><input required class = "form-control" type = "text" value = "<?php echo $_SESSION['name'];?>" readonly name = "nameofemployee"/></td>
				</tr>
				<tr>
					<td>Reason (Work to be done): </td>
					<td><textarea required name = "reason"class = "form-control"></textarea></td>
					
				</tr>
				<tr><div class = "ui-widget-content" style = "border: none;" >
					<td>Start (Time of OT): </td>
					<td>
						<input required class = "form-control" readonly name = "startofot" autocomplete ="off" placeholder = "Click to Set time"/>
					</td>
					
				</tr>				
				<tr>
					<td>End (Time of OT): </td>
					<td><input required class = "form-control" readonly name = "endofot" placeholder = "Click to Set time" autocomplete ="off" /></td>
					
				</tr>				
				<tr class = "form-inline" >
					<td>Official Work Sched: </td>
					<td >
						<label for = "fr">From:</label><input readonly placeholder = "Click to Set time" required style = "width: 130px;" autocomplete ="off" id = "to"class = "form-control"  name = "officialworkschedfr"/>
						<label for = "to">To:</label><input readonly placeholder = "Click to Set time" required style = "width: 130px;" autocomplete ="off" class = "form-control" id = "fr"  name = "officialworkschedto"/>
					</td>
					
				</tr>
					<script type="text/javascript">
						$(document).ready(function(){
							$('input[name="startofot"]').ptTimeSelect();
							$('input[name="officialworkschedto"]').ptTimeSelect();
							$('input[name="officialworkschedfr"]').ptTimeSelect();							
							$('input[name="endofot"]').ptTimeSelect();
						});
					</script>
				</div>
				<tr>
					<td colspan = 2 align = center><input type = "submit" name = "unsubmit" class = "btn btn-default"/><input type = "button" id = "hideot" name = "submit" class = "btn btn-default" value = "Cancel"></td>
					
				</tr>
			</table>
		</div>
	</form>
</div>

<div id = "leave"style = "margin-top: -30px; display: none;">
	<form role = "form"  align = "center"action = "oleave-exec.php" method = "post">
		<div class = "form-group">
			<table align = "center" width = "60%">
				<tr>
					<td colspan = 3 align = center>
						<h2> Leave Request </h2>
					</td>
				</tr>
				<tr>
					<td colspan = 3 align = center>
						<h5><p style = "font-style: italic; color: red;">For scheduled leave, submit Leave request to Human Resources Department seven(7) days prior to leave date. </h5>
					</td>
				</tr>		
				<tr class = "form-inline" >
					<td>Type of Leave</td>
					<td align = "left">
						<select style = "width: 60%;"required class="form-control" id = "typeoflea" name="typeoflea">
							<option value = ""> ---- </option>
							<option value = "Vacation Leave">Vacation Leave: </option>
							<option value = "Sick Leave">Sick Leave: </option>
							<option value = "Others">Others(Pls. Specify)</option>
						</select>						
						<input type = "text" name = "othersl" class = "form-control" id = "othersl" style = " width: 20%; display: none;"/>
					</td>
				</tr>	
				<div style = "display: none;">
				<tr>
					<td>Name of Employee: </td>
					<td><input required class = "form-control" type = "text" value = "<?php echo $_SESSION['name'];?>" readonly name = "nameofemployee"/></td>
				</tr>
				<tr>
					<td>Date File: </td>
					<td><input type = "text" class = "form-control" readonly name = "datefile" required value = "<?php echo date('F j, Y');?>"/></td>
				</tr>				
				<tr>
					<td>Date Hired: </td>
					<td><input type = "date" class = "form-control"  name = "datehired" required /></td>
				</tr>
				<tr>
					<td>Department: </td>
					<td><input type = "text" class = "form-control"  name = "deprt" required/></td>
				</tr>
				<tr>
					<td>Position Title: </td>
					<td><input type = "text" class = "form-control"  name = "posttile" required/></td>
				</tr>
				<tr>
					<td colspan = 3 align = "center">
						<h3>LEAVE DETAILS</h3>
				</tr>
				<tr class = "form-inline">
					<td>Inclusive Dates: </td>
					<td>
						From: <input required class = "form-control" type = "date" min = "<?php echo date('m/d/Y'); ?>" name = "dateofleavfr"/>
						To: <input required class = "form-control" type = "date" min = "<?php echo date('m/d/Y'); ?>" name = "dateofleavto"/>
						Number of Days: <input maxlength = "3" style = "width: 90px;"type = "text" pattern = '[0-9]+' required name = "numdays"class = "form-control"/>
					</td>
				</tr>					

				<tr>
					<td>Reason: </td>
					<td><textarea class = "form-control" name = "leareason"required></textarea></td>
				</tr>
				<tr>
					<td colspan = 4 align = center><input type = "submit" name = "leasubmit" class = "btn btn-default"/><input type = "button" id = "hideot" name = "submit" class = "btn btn-default" value = "Cancel"></td>					
				</tr>
			</table>
		</div>
	</form>
</div>
