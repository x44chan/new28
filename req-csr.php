<?php
	if(isset($_GET['pencsr']) && $_GET['pencsr'] == '1'){
		include("conf.php");
		mysqli_select_db($conn, 'csr');
		$csrid = mysql_escape_string($_GET['update']);
		$sql = "SELECT * FROM `csr`.`csr`,`new`.`login`,`csr`.`customer_login`  where `csr`.`csr`.`account_id` = $accid and `new`.`login`.`account_id` = $accid order by (`state` = 'UATech') DESC";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
?>
	<div style="padding: 10px 20px;">
	<form role="form" action = "" method = "post">
		<div class = "row">
			<div class="col-md-12">
		    	<div align = "center"class="page-header">
					<h2>Customer's Service Report</h2>
				</div>
		    </div>
		</div>
	    <div class="clear"></div>
		<div class = "row">
			<div class="col-md-7">
	        	<label for="usrname"> Customer Name <font color = "red">*</font></label>
	        	<input autocomplete = "off" value = "<?php echo $row['csrname'];?>" name = "csrname" type="text" required style = "font-weight:normal;text-transform:capitalize;" class="form-control" placeholder="Enter Customer Name">
	        </div>
	        <div class="col-md-5">
	        	<label for="usrname"> Tel #: <font color = "red">*</font></label>
	        	<input autocomplete = "off" value = "<?php echo $row['csrtel'];?>" name = "csrtel" type="text" required style = "font-weight:normal;text-transform:capitalize;" class="form-control" placeholder="Enter Tel#">
	        </div>
	    </div>
	    <div class = "row">
	        <div class="col-md-7">
	        	<label for="usrname"> Address: <font color = "red">*</font></label>
	        	<textarea name = "csradd" required style = "font-weight:normal;text-transform:capitalize;" class="form-control" placeholder="Enter Address"><?php echo $row['csradd'];?></textarea>
	        </div>
	        <div class="col-md-5">
	        	<label for="usrname"> Date: <font color = "red">*</font></label>
	        	<input value = "<?php echo $row['csrdate'];?>"name = "csrdate" type="date" required class="form-control" placeholder="Enter Tel#">
	        </div>
		</div>
		<div class = "row">
			<div class="col-md-7">
				<div class="checkbox">
					<label><input <?php if($row['csrchck'] != 'Overtime'){echo 'checked';}?> name = "csrchckreg" id = "checkbox" type="checkbox" value="regular">Regular Time: 8:00 AM - 5:00 PM</label>
				</div>
				<div class="checkbox">
					<label><input  <?php if($row['csrchck'] == 'Overtime'){echo 'checked';}?> name = "csrchckot" id = "checkbox1" type="checkbox" value="ot">Over Time</label>
				</div>
			</div>
		</div>
		<div class = "row">
	        <div class="col-md-3 col-md-offset-3">
	        	<label for="usrname"> Time Started <font color = "red">*</font></label>
	        	<input autocomplete = "off" value = "<?php echo $row['csrtimein'];?>"type="text" required name = "csrtimein" class="form-control" placeholder="Enter time you start">
	        </div>
	        <div class="col-md-3">
	        	<label for="usrname"> Time Finished <font color = "red">*</font></label>
	        	<input autocomplete = "off" value = "<?php echo $row['csrtimeout'];?>"type="text" required name = "csrtimeout" class="form-control" placeholder="Enter time you finished">
	        </div>
		</div>
		<div class="row">
			<div class="col-md-12">
		    	<div class="page-header">
					<p style="font-size: 20px">Maintenance Report</p>
				</div>
		    </div>
		</div>
		<div id = "netcon" style="display: ;">
			<div class="row"  style = "text-align: center; font-weight: bold;">
				<div class="col-md-4">
					NETWORK CONNECTIONS
				</div>
				<div class="col-md-4">
					REPORTED PROBLEM
				</div>
				<div class="col-md-4">
					ACTION TAKEN
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input <?php if($row['csrintprob'] != null || $row['csrintprob'] != ""){echo 'checked ';}?> name = "csrinternet" id = "csrinternet" type="checkbox" value="Internet" >INTERNET</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrintprob" id = "csrintprob" placeholder = "Enter reported problem"><?php echo $row['csrintprob'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrintact" id = "csrintact" placeholder = "Enter action taken"><?php echo $row['csrintact'];?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input <?php if($row['csrintprob'] != null || $row['csrrouterprob'] != ""){echo 'checked ';}?>name = "csrrouter" id = "csrrouter" type="checkbox" value="Router">ROUTER</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrrouterprob" id = "csrrouterprob" placeholder = "Enter reported problem"><?php echo $row['csrrouterprob'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrrouteract" id = "csrrouteract" placeholder = "Enter action taken"><?php echo $row['csrrouteract'];?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input <?php if($row['csrfirewallprob'] != "" || $row['csrfirewallprob'] != null){echo 'checked ';}?> name = "csrfirewall" id = "csrfirewall" type="checkbox" value="Firewall">FIREWALL</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrfirewallprob" id = "csrfirewallprob" placeholder = "Enter reported problem"><?php echo $row['csrfirewallprob'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrfirewallact" id = "csrfirewallact" placeholder = "Enter action taken"><?php echo $row['csrfirewallact'];?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input <?php if($row['csrswitchprob'] != "" || $row['csrswitchprob'] != null){echo 'checked ';}?>name = "csrswitch" id = "csrswitch" type="checkbox" value="Switches">SWITCHES</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrswitchprob" id = "csrswitchprob" placeholder = "Enter reported problem"><?php echo $row['csrswitchprob'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrswitchact" id = "csrswitchact" placeholder = "Enter action taken"><?php echo $row['csrswitchact'];?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input name = "csracc" id = "csracc" type="checkbox" <?php if($row['csraccprob'] != "" || $row['csraccprob'] != null){echo 'checked ';}?> value="Access Point">ACCESS POINT</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csraccprob" id = "csraccprob" placeholder = "Enter reported problem"><?php echo $row['csraccprob'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csraccact" id = "csraccact" placeholder = "Enter action taken"><?php echo $row['csraccact'];?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
		</div>
		<div id = "servers" style="display: ;">
			<div class="row" style = "text-align: center; font-weight: bold;">
				<div class="col-md-4">
					SERVERS
				</div>
				<div class="col-md-4">
					REPORTED PROBLEM
				</div>
				<div class="col-md-4">
					ACTION TAKEN
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input <?php if($row['csractvedrctoryprob'] != "" || $row['csractvedrctoryprob'] != null){echo 'checked ';}?> name = "csractvedrctory" id = "csractvedrctory" type="checkbox" value="Active Directory" >ACTIVE DIRECTORY</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csractvedrctoryprob" id = "csractvedrctoryprob" placeholder = "Enter reported problem"><?php echo $row['csractvedrctoryprob'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csractvedrctoryact" id = "csractvedrctoryact" placeholder = "Enter action taken"><?php echo $row['csractvedrctoryact'];?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input <?php if($row['csrfilesrvrprob'] != "" || $row['csrfilesrvrprob'] != null){echo 'checked ';}?> name = "csrfilesrvr" id = "csrfilesrvr" type="checkbox" value="File Server">FILE SERVER</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrfilesrvrprob" id = "csrfilesrvrprob" placeholder = "Enter reported problem"><?php echo $row['csrfilesrvrprob'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrfilesrvract" id = "csrfilesrvract" placeholder = "Enter action taken"><?php echo $row['csrfilesrvract'];?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input <?php if($row['csrmailprob'] != "" || $row['csrmailprob'] != null){echo 'checked ';}?> name = "csrmail" id = "csrmail" type="checkbox" value="Mail Server">MAIL SERVER</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrmailprob" id = "csrmailprob" placeholder = "Enter reported problem"><?php echo $row['csrmailprob'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrmailact" id = "csrmailact" placeholder = "Enter action taken"><?php echo $row['csrmailact'];?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input  <?php if($row['csrappprob'] != "" || $row['csrappprob'] != null){echo 'checked ';}?> name = "csrapp" id = "csrapp" type="checkbox" value="Application Server">APPLICATION SERVER</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrappprob" id = "csrappprob" placeholder = "Enter reported problem"><?php echo $row['csrappprob'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrappact" id = "csrappact" placeholder = "Enter action taken"><?php echo $row['csrappact'];?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input <?php if($row['csrotherprob'] != "" || $row['csrotherprob'] != null){echo 'checked ';}?> name = "csrother" id = "csrother" type="checkbox" value="Other Server">OTHER SERVER</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrotherprob" id = "csrotherprob" placeholder = "Enter reported problem"><?php echo $row['csrotherprob'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrotheract" id = "csrotheract" placeholder = "Enter action taken"><?php echo $row['csrotheract'];?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
		</div>
		<div id = "pclaptop" style="display: ;">
			<!--<div class="row">
				<div class="col-md-4 form-inline">
					<div style="font-size: 15px; text-align: center;">
						Numbers Of PC <input name = "csrother" id = "numberofpc" class = "form-control" type="number" placeholder="Number of PC">
					</div>
				</div>
			</div>-->
			<div class="row" style = "text-align: center; font-weight: bold;">
				<div class="col-md-4">
					DESKTOP / LAPTOP<br>
				</div>
				<div class="col-md-4">
					REPORTED PROBLEM
				</div>
				<div class="col-md-4">
					ACTION TAKEN
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<div style="font-size: 15px; text-align: center;">
						<i>PC NAME</i>
					</div>
				</div>
				<div class="col-md-2">
					<div style="font-size: 15px; text-align: center;">
						<i>USER</i>
					</div>
				</div>
				
			</div>
			<div class="row" id = "pc1">
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcname1'];?>" class="form-control" name = "csrpcname1" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcuser1'];?>" class="form-control" name = "csrpcuser1" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob1" placeholder = "Enter reported problem"><?php echo $row['csrpcprob1'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact1" placeholder = "Enter action taken"><?php echo $row['csrpcact1'];?></textarea>
				</div>
			</div>
			<div class="row" id = "pc2">
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcname2'];?>" class="form-control" name = "csrpcname2" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcuser2'];?>" class="form-control" name = "csrpcuser2" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob2" placeholder = "Enter reported problem"><?php echo $row['csrpcprob2'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact2" placeholder = "Enter action taken"><?php echo $row['csrpcact2'];?></textarea>
				</div>
			</div>
			<div class="row" id = "pc3">
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcname3'];?>" class="form-control" name = "csrpcname3" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcuser3'];?>" class="form-control" name = "csrpcuser3" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob3" placeholder = "Enter reported problem"><?php echo $row['csrpcprob3'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact3" placeholder = "Enter action taken"><?php echo $row['csrpcact3'];?></textarea>
				</div>
			</div>
			<div class="row" id = "pc4">
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcname4'];?>" class="form-control" name = "csrpcname4" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcuser4'];?>" class="form-control" name = "csrpcuser4" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob4" placeholder = "Enter reported problem"><?php echo $row['csrpcprob4'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact4" placeholder = "Enter action taken"><?php echo $row['csrpcact4'];?></textarea>
				</div>
			</div>
			<div class="row" id = "pc5">
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcname5'];?>" class="form-control" name = "csrpcname5" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcuser5'];?>" class="form-control" name = "csrpcuser5" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob5" placeholder = "Enter reported problem"><?php echo $row['csrpcprob5'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact5" placeholder = "Enter action taken"><?php echo $row['csrpcact5'];?></textarea>
				</div>
			</div>
			<div class="row" id = "pc6">
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcname6'];?>" class="form-control" name = "csrpcname6" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text"autocomplete = "off"  value = "<?php echo $row['csrpcuser6'];?>" class="form-control" name = "csrpcuser6" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob6" placeholder = "Enter reported problem"><?php echo $row['csrpcprob6'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact6" placeholder = "Enter action taken"><?php echo $row['csrpcact6'];?></textarea>
				</div>
			</div>
			<div class="row" id = "pc7">
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcname7'];?>" class="form-control" name = "csrpcname7" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcuser7'];?>" class="form-control" name = "csrpcuser7" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob7" placeholder = "Enter reported problem"><?php echo $row['csrpcprob7'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact7" placeholder = "Enter action taken"><?php echo $row['csrpcact7'];?></textarea>
				</div>
			</div>
			<div class="row" id = "pc8">
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcname8'];?>" class="form-control" name = "csrpcname8" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcuser8'];?>" class="form-control" name = "csrpcuser8" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob8" placeholder = "Enter reported problem"><?php echo $row['csrpcprob8'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact8" placeholder = "Enter action taken"><?php echo $row['csrpcact8'];?></textarea>
				</div>
			</div>
			<div class="row" id = "pc9">
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcname9'];?>" class="form-control" name = "csrpcname9" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcuser9'];?>" class="form-control" name = "csrpcuser9" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob9" placeholder = "Enter reported problem"><?php echo $row['csrpcprob9'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact9" placeholder = "Enter action taken"><?php echo $row['csrpcact9'];?></textarea>
				</div>
			</div>
			<div class="row"id = "pc10">
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcname10'];?>" class="form-control" name = "csrpcname10" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrpcuser10'];?>" class="form-control" name = "csrpcuser10" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob10" placeholder = "Enter reported problem"><?php echo $row['csrpcprob10'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact10" placeholder = "Enter action taken"><?php echo $row['csrpcact10'];?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
		</div>
		<div id = "prinfax" style="display: ;">
			<div class="row" style = "text-align: center; font-weight: bold;">
				<div class="col-md-4">
					PRINTERS / FAX<br>
				</div>
				<div class="col-md-4">
					REPORTED PROBLEM
				</div>
				<div class="col-md-4">
					ACTION TAKEN
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<div style="font-size: 15px; text-align: center;">
						<i>BRAND</i>
					</div>
				</div>
				<div class="col-md-2">
					<div style="font-size: 15px; text-align: center;">
						<i>MODEL</i>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrprntbrand1'];?>" class="form-control" name = "csrprntbrand1" placeholder = "Enter Brand Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrprntmodel1'];?>" class="form-control" name = "csrprntmodel1" placeholder = "Enter Model"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrprntprob1" placeholder = "Enter reported problem"><?php echo $row['csrprntprob1'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrprntact1" placeholder = "Enter action taken"><?php echo $row['csrprntact1'];?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrprntbrand2'];?>" class="form-control" name = "csrprntbrand2" placeholder = "Enter Brand Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrprntmodel2'];?>" class="form-control" name = "csrprntmodel2" placeholder = "Enter Model"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrprntprob2" placeholder = "Enter reported problem"><?php echo $row['csrprntprob2'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrprntact2" placeholder = "Enter action taken"><?php echo $row['csrprntact2'];?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrprntbrand3'];?>" class="form-control" name = "csrprntbrand3" placeholder = "Enter Brand Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrprntmodel3'];?>"  class="form-control" name = "csrprntmodel3" placeholder = "Enter Model"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrprntprob3" placeholder = "Enter reported problem"><?php echo $row['csrprntprob3'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrprntact3" placeholder = "Enter action taken"><?php echo $row['csrprntact3'];?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
		</div>
		<div id = "telphone" style="display: ;">
			<div class="row" style = "text-align: center; font-weight: bold;">
				<div class="col-md-4">
					TELEPHONE / PABX<br>
				</div>
				<div class="col-md-4">
					REPORTED PROBLEM
				</div>
				<div class="col-md-4">
					ACTION TAKEN
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-2">
					<div style="font-size: 15px; text-align: center;">
						<i>LOCAL #</i>
					</div>
				</div>
				<div class="col-md-2">
					<div style="font-size: 15px; text-align: center;">
						<i>USER</i>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrtellocal1'];?>" class="form-control" name = "csrtellocal1" placeholder = "Enter Local #"/>
				</div>
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrtelusr1'];?>" class="form-control" name = "csrtelusr1" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrtelprob1" placeholder = "Enter reported problem"><?php echo $row['csrtelprob1'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrtelact1" placeholder = "Enter action taken"><?php echo $row['csrtelact1'];?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrtellocal2'];?>" class="form-control" name = "csrtellocal2" placeholder = "Enter Local #"/>
				</div>
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrtelusr2'];?>" class="form-control" name = "csrtelusr2" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrtelprob2" placeholder = "Enter reported problem"><?php echo $row['csrtelprob2'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrtelact2" placeholder = "Enter action taken"><?php echo $row['csrtelact2'];?></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrtellocal3'];?>" class="form-control" name = "csrtellocal3" placeholder = "Enter Local #"/>
				</div>
				<div class="col-md-2">
					<input type = "text" autocomplete = "off" value = "<?php echo $row['csrtelusr3'];?>" class="form-control" name = "csrtelusr3" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrtelprob3" placeholder = "Enter reported problem"><?php echo $row['csrtelprob3'];?></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrtelact3" placeholder = "Enter action taken"><?php echo $row['csrtelact3'];?></textarea>
				</div>
			</div>
		</div>
		<div id = "remarks" style="display: ;">
			<div class="row" style = "font-weight: bold;">
				<div class="col-md-12">
					<hr>
					REMARKS
				</div>
			</div>
			<div class="row">
				<div class="col-md-2" style="text-align:right;">
					<b>1.</b>
				</div>
				<div class="col-md-10">
					<input type="text" autocomplete = "off" value = "<?php echo $row['csrrmrks1'];?>" class="form-control" name = "csrrmrks1" placeholder = "Enter remakrs">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2" style="text-align:right;">
					<b>2.</b>
				</div>
				<div class="col-md-10">
					<input type="text" autocomplete = "off" value = "<?php echo $row['csrrmrks2'];?>" class="form-control" name = "csrrmrks2" placeholder = "Enter remakrs">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2" style="text-align:right;">
					<b>3.</b>
				</div>
				<div class="col-md-10">
					<input type="text" autocomplete = "off" value = "<?php echo $row['csrrmrks3'];?>"  class="form-control" name = "csrrmrks3" placeholder = "Enter remakrs">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2" style="text-align:right;">
					<b>4.</b>
				</div>
				<div class="col-md-10">
					<input type="text" autocomplete = "off" value = "<?php echo $row['csrrmrks4'];?>" class="form-control" name = "csrrmrks4" placeholder = "Enter remakrs">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2" style="text-align:right;">
					<b>5.</b>
				</div>
				<div class="col-md-10">
					<input type="text" autocomplete = "off" value = "<?php echo $row['csrrmrks5'];?>" class="form-control" name = "csrrmrks5" placeholder = "Enter remakrs">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6" style="font-size: 18px;">
					<i>Prepared By: <b><u><?php echo $_SESSION['name'];?></u></b></i>
				</div>
				<!--<div class="col-md-2" style="text-align: right;">
					<label for="csrconforme">Conforme:</label>			
				</div>
				<div class="col-md-4">
					<input name = "csrconforme" id = "csrconforme" type = "text" class="form-control"/>
				</div>-->
			</div>
			<div class="row">
				<div class="col-md-6 col-md-offset-5">
					<!--<button type = "submit" class="btn btn-success col-md-4" name = "upcsrsubmits"><span class="glyphicon glyphicon-off"></span> Update </button>-->
					<a style="margin-left: 10px;" href = "?ac=pencsr" class="btn btn-danger"><span class="glyphicon glyphicon-menu-left"></span> Back</a>
					<input type = "hidden" value = "<?php echo $row['csr_id'];?>" name = "csr_id"/>
				</div>
			</div>
			
		</div>
	</form>
</div>
	<script type="text/javascript">
	$('#checkbox').on('change', function() {
		$('#checkbox1').not(this).prop('checked', false);
	});
	$('#checkbox1').on('change', function() {
		$('#checkbox').not(this).prop('checked', false);
	});
	$(document).ready(function(){
		$('input[name="csrtimein"]').ptTimeSelect();
		$('input[name="csrtimeout"]').ptTimeSelect();
		$('#numberofpc').on('change', function() {
			var q = $('#numberofpc').val();
			var pc = ['#pc1','#pc2','#pc3','#pc4','#pc5','#pc6','#pc7','#pc8','#pc9','#pc10'];
			for(i = 0; i < 10; i++){			
				$(pc[i]).hide();
			}
			var pc = ['#pc1','#pc2','#pc3','#pc4','#pc5','#pc6','#pc7','#pc8','#pc9','#pc10'];
			for(i = 0; i < q; i++){			
				$(pc[i]).show();
			}
		});
	});
	</script>
<?php
			}
		}
	}
?>
<?php
	if(isset($_GET['ac']) && $_GET['ac'] == 'pencsr'){
		include("conf.php");
		$sql = "SELECT * FROM csr,login where login.account_id = $accid and csr.account_id = $accid order by (`state` = 'UATech') DESC";
		$result = $conn->query($sql);
		if($result->num_rows > 0){
?>
	<div style="padding: 10px 20px; text-align: center;" >
		<div class = "row">
			<div class="col-md-12">
		    	<div align = "center"class="page-header" style="margin-top: -10px;">
					<i><h3>Pending Customer's Service Report</h3></i>
				</div>
		    </div>
		</div>
		<div class = "row" >
			<div class="col-md-3" >
	        	<label style="text-decoration: underline;" for="usrname"> Date </label>
	        </div>
	        <div class="col-md-3" >
	        	<label style="text-decoration: underline;" for="usrname"> Time In / Time Out </label>
	        </div>
			<div class="col-md-3">
	        	<label style="text-decoration: underline;" for="usrname"> Customer Name </label>    	
	        </div>
	        <div class="col-md-3">
	        	<label style="text-decoration: underline;" for="usrname"> State </label>    	
	        </div>
	    </div>
<?php
			while($row = $result->fetch_assoc()){
?>
		<div class = "row">
			<div class="col-md-3">
	        	<?php echo date('M j, Y', strtotime($row['csrdate']));?>
	        </div>
	        <div class="col-md-3">
	        	<?php echo $row['csrtimein'] . ' - ' . $row['csrtimeout']; ?>
	        </div>
			<div class="col-md-3">
	        	<?php echo $row['csrname'];?>  	
	        </div>
	        <div class="col-md-3">
	        	<?php
	        		if($row['state'] == 'UATech'){
	        			//echo '<b>Pending to Tech. Supervisor</b><br>';
	        			echo '<a href = "?pencsr=1&update=' . $row['csr_id'] . '" class = "btn btn-danger">View Application</a>';
	        		}
	        	?>  	
	        </div>
	    </div>
<?php
			}
		}
	echo '</div>';
	}

?>

<?php 
	if(isset($_GET['csr'])){
?>
<div style="padding: 10px 20px;">
	<form role="form" action = "ocsr-exec.php" method = "post">
		<div class = "row">
			<div class="col-md-12">
		    	<div align = "center"class="page-header">
					<h2>Customer's Service Report</h2>
				</div>
		    </div>
		</div>
	    <div class="clear"></div>
		<div class = "row">
			<div class="col-md-7">
	        	<label for="usrname"> Customer Name <font color = "red">*</font></label>
	        	<input name = "csrname" type="text" required style = "font-weight:normal;text-transform:capitalize;" class="form-control" placeholder="Enter Customer Name">
	        </div>
	        <div class="col-md-5">
	        	<label for="usrname"> Tel #: <font color = "red">*</font></label>
	        	<input name = "csrtel" type="text" required style = "font-weight:normal;text-transform:capitalize;" class="form-control" placeholder="Enter Tel#">
	        </div>
	    </div>
	    <div class = "row">
	        <div class="col-md-7">
	        	<label for="usrname"> Address: <font color = "red">*</font></label>
	        	<textarea name = "csradd" required style = "font-weight:normal;text-transform:capitalize;" class="form-control" placeholder="Enter Address"></textarea>
	        </div>
	        <div class="col-md-5">
	        	<label for="usrname"> Date: <font color = "red">*</font></label>
	        	<input name = "csrdate" type="date" required class="form-control" placeholder="Enter Tel#">
	        </div>
		</div>
		<div class = "row">
			<div class="col-md-7">
				<div class="checkbox">
					<label><input name = "csrchckreg" id = "checkbox" type="checkbox" value="regular">Regular Time: 8:00 AM - 5:00 PM</label>
				</div>
				<div class="checkbox">
					<label><input name = "csrchckot" id = "checkbox1" type="checkbox" value="ot">Over Time</label>
				</div>
			</div>
		</div>
		<div class = "row">
	        <div class="col-md-3 col-md-offset-3">
	        	<label for="usrname"> Time Started <font color = "red">*</font></label>
	        	<input type="text" required name = "csrtimein" class="form-control" placeholder="Enter time you start">
	        </div>
	        <div class="col-md-3">
	        	<label for="usrname"> Time Finished <font color = "red">*</font></label>
	        	<input type="text" required name = "csrtimeout" class="form-control" placeholder="Enter time you finished">
	        </div>
		</div>
		<div class="row">
			<div class="col-md-12">
		    	<div class="page-header">
					<p style="font-size: 20px">Maintenance Report</p>
				</div>
		    </div>
		</div>
		<div id = "netcon" style="display: ;">
			<div class="row"  style = "text-align: center; font-weight: bold;">
				<div class="col-md-4">
					NETWORK CONNECTIONS
				</div>
				<div class="col-md-4">
					REPORTED PROBLEM
				</div>
				<div class="col-md-4">
					ACTION TAKEN
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input id = "csrinternet" name = "csrinternet" type="checkbox" value="Internet" >INTERNET</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrintprob" id = "csrintprob" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrintact" id = "csrintact" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input name = "csrrouter" id = "csrrouter" type="checkbox" value="Router">ROUTER</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrrouterprob" id = "csrrouterprob" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrrouteract" id = "csrrouteract" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input name = "csrfirewall" id = "csrfirewall" type="checkbox" value="Firewall">FIREWALL</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrfirewallprob" id = "csrfirewallprob" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrfirewallact" id = "csrfirewallact" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input name = "csrswitch" id = "csrswitch" type="checkbox" value="Switches">SWITCHES</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrswitchprob" id = "csrswitchprob" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrswitchact" id = "csrswitchact" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input name = "csracc" id = "csracc" type="checkbox" value="Access Point">ACCESS POINT</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csraccprob" id = "csraccprob" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csraccact" id = "csraccact" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
		</div>
		<div id = "servers" style="display: ;">
			<div class="row" style = "text-align: center; font-weight: bold;">
				<div class="col-md-4">
					SERVERS
				</div>
				<div class="col-md-4">
					REPORTED PROBLEM
				</div>
				<div class="col-md-4">
					ACTION TAKEN
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input name = "csractvedrctory" id = "csractvedrctory" type="checkbox" value="Active Directory" >ACTIVE DIRECTORY</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csractvedrctoryprob" id = "csractvedrctoryprob" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csractvedrctoryact" id = "csractvedrctoryact" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input name = "csrfilesrvr" id = "csrfilesrvr" type="checkbox" value="File Server">FILE SERVER</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrfilesrvrprob" id = "csrfilesrvrprob" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrfilesrvract" id = "csrfilesrvract" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input name = "csrmail" id = "csrmail" type="checkbox" value="Mail Server">MAIL SERVER</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrmailprob" id = "csrmailprob" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrmailact" id = "csrmailact" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input name = "csrapp" id = "csrapp" type="checkbox" value="Application Server">APPLICATION SERVER</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrappprob" id = "csrappprob" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrappact" id = "csrappact" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div style = "margin-left: 20px;"class="checkbox">
						<label style="margin-left: 30px;"><input name = "csrother"  id = "csrother" type="checkbox" value="Other Server">OTHER SERVER</label>
					</div>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrotherprob" id = "csrotherprob" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrotheract" id = "csrotheract" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
		</div>
		<div id = "pclaptop" style="display: ;">
			<!--<div class="row">
				<div class="col-md-4 form-inline">
					<div style="font-size: 15px; text-align: center;">
						Numbers Of PC <input name = "csrother" id = "numberofpc" class = "form-control" type="number" placeholder="Number of PC">
					</div>
				</div>
			</div>-->
			<div class="row" style = "text-align: center; font-weight: bold;">
				<div class="col-md-4">
					DESKTOP / LAPTOP<br>
				</div>
				<div class="col-md-4">
					REPORTED PROBLEM
				</div>
				<div class="col-md-4">
					ACTION TAKEN
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<div style="font-size: 15px; text-align: center;">
						<i>PC NAME</i>
					</div>
				</div>
				<div class="col-md-2">
					<div style="font-size: 15px; text-align: center;">
						<i>USER</i>
					</div>
				</div>
				
			</div>
			<div class="row" id = "pc1">
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcname1" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcuser1" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob1" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact1" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row" id = "pc2">
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcname2" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcuser2" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob2" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact2" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row" id = "pc3">
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcname3" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcuser3" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob3" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact3" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row" id = "pc4">
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcname4" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcuser4" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob4" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact4" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row" id = "pc5">
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcname5" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcuser5" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob5" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact5" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row" id = "pc6">
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcname6" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcuser6" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob6" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact6" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row" id = "pc7">
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcname7" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcuser7" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob7" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact7" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row" id = "pc8">
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcname8" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcuser8" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob8" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact8" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row" id = "pc9">
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcname9" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcuser9" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob9" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact9" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row"id = "pc10">
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcname10" placeholder = "Enter PC Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrpcuser10" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcprob10" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrpcact10" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
		</div>
		<div id = "prinfax" style="display: ;">
			<div class="row" style = "text-align: center; font-weight: bold;">
				<div class="col-md-4">
					PRINTERS / FAX<br>
				</div>
				<div class="col-md-4">
					REPORTED PROBLEM
				</div>
				<div class="col-md-4">
					ACTION TAKEN
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<div style="font-size: 15px; text-align: center;">
						<i>BRAND</i>
					</div>
				</div>
				<div class="col-md-2">
					<div style="font-size: 15px; text-align: center;">
						<i>MODEL</i>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrprntbrand1" placeholder = "Enter Brand Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrprntmodel1" placeholder = "Enter Model"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrprntprob1" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrprntact1" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrprntbrand2" placeholder = "Enter Brand Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrprntmodel2" placeholder = "Enter Model"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrprntprob2" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrprntact2" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrprntbrand3" placeholder = "Enter Brand Name"/>
				</div>
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrprntmodel3" placeholder = "Enter Model"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrprntprob3" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrprntact3" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
		</div>
		<div id = "telphone" style="display: ;">
			<div class="row" style = "text-align: center; font-weight: bold;">
				<div class="col-md-4">
					TELEPHONE / PABX<br>
				</div>
				<div class="col-md-4">
					REPORTED PROBLEM
				</div>
				<div class="col-md-4">
					ACTION TAKEN
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-2">
					<div style="font-size: 15px; text-align: center;">
						<i>LOCAL #</i>
					</div>
				</div>
				<div class="col-md-2">
					<div style="font-size: 15px; text-align: center;">
						<i>USER</i>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrtellocal1" placeholder = "Enter Local #"/>
				</div>
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrtelusr1" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrtelprob1" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrtelact1" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrtellocal2" placeholder = "Enter Local #"/>
				</div>
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrtelusr2" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrtelprob2" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrtelact2" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrtellocal3" placeholder = "Enter Local #"/>
				</div>
				<div class="col-md-2">
					<input type = "text" class="form-control" name = "csrtelusr3" placeholder = "Enter User"/>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrtelprob3" placeholder = "Enter reported problem"></textarea>
				</div>
				<div class="col-md-4">
					<textarea class="form-control" rows = "3" name = "csrtelact3" placeholder = "Enter action taken"></textarea>
				</div>
			</div>
		</div>
		<div id = "remarks" style="display: ;">
			<div class="row" style = "font-weight: bold;">
				<div class="col-md-12">
					<hr>
					REMARKS
				</div>
			</div>
			<div class="row">
				<div class="col-md-2" style="text-align:right;">
					<b>1.</b>
				</div>
				<div class="col-md-10">
					<input type="text" class="form-control" name = "csrrmrks1" placeholder = "Enter remakrs">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2" style="text-align:right;">
					<b>2.</b>
				</div>
				<div class="col-md-10">
					<input type="text" class="form-control" name = "csrrmrks2" placeholder = "Enter remakrs">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2" style="text-align:right;">
					<b>3.</b>
				</div>
				<div class="col-md-10">
					<input type="text" class="form-control" name = "csrrmrks3" placeholder = "Enter remakrs">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2" style="text-align:right;">
					<b>4.</b>
				</div>
				<div class="col-md-10">
					<input type="text" class="form-control" name = "csrrmrks4" placeholder = "Enter remakrs">
				</div>
			</div>
			<div class="row">
				<div class="col-md-2" style="text-align:right;">
					<b>5.</b>
				</div>
				<div class="col-md-10">
					<input type="text" class="form-control" name = "csrrmrks5" placeholder = "Enter remakrs">
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12" style="font-size: 18px;">
					<i>Prepared By: <b><u><?php echo $_SESSION['name'];?></u></b></i>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-md-offset-5">
					<button type = "submit" class="btn btn-primary col-md-4" name = "csrsubmits"><span class="glyphicon glyphicon-off"></span> Submit</button>
				</div>
			</div>
			
		</div>
	</form>
</div>
	<script type="text/javascript">
	$('#checkbox').on('change', function() {
		$('#checkbox1').not(this).prop('checked', false);
	});
	$('#checkbox1').on('change', function() {
		$('#checkbox').not(this).prop('checked', false);
	});
	$(document).ready(function(){
		$('input[name="csrtimein"]').ptTimeSelect();
		$('input[name="csrtimeout"]').ptTimeSelect();
		$('#numberofpc').on('change', function() {
			var q = $('#numberofpc').val();
			var pc = ['#pc1','#pc2','#pc3','#pc4','#pc5','#pc6','#pc7','#pc8','#pc9','#pc10'];
			for(i = 0; i < 10; i++){			
				$(pc[i]).hide();
			}
			var pc = ['#pc1','#pc2','#pc3','#pc4','#pc5','#pc6','#pc7','#pc8','#pc9','#pc10'];
			for(i = 0; i < q; i++){			
				$(pc[i]).show();
			}
		});

	});
	</script>
<?php
	}
?>
