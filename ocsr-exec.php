<?php
include 'conf.php';
mysqli_select_db($conn, 'csr');
session_start();
$account_id = $_SESSION['acc_id'];
/*
	custname to servers = 37
	desktop/laptop = 40
	printers to remarks = 29
*/

if(isset($_POST['csrsubmits'])){
	$csrname = $_POST['csrname'];
	$csrtel = $_POST['csrtel']; 
	$csradd = $_POST['csradd'];
	$csrdate = $_POST['csrdate'];

	if(isset($_POST['csrchckreg'])){
		$csrchck = "Regular: 8 AM - 6 PM";
	}elseif(isset($_POST['csrchckot'])){
		$csrchck = "Overtime";
	}else{
		$csrchck = null;
	}
	
	//$csrchckot = $_POST['csrchckot']; 

	$csrtimein = $_POST['csrtimein']; 
	$csrtimeout = $_POST['csrtimeout'];

	//$csrinternet = $_POST['csrinternet'];
	$csrintprob = $_POST['csrintprob'];
	$csrintact = $_POST['csrintact'];

	//$csrrouter = $_POST['csrrouter'];
	$csrrouterprob = $_POST['csrrouterprob'];
	$csrrouteract = $_POST['csrrouteract'];

	//$csrfirewall = $_POST['csrfirewall']; 
	$csrfirewallprob = $_POST['csrfirewallprob']; 
	$csrfirewallact = $_POST['csrfirewallact']; 

	//$csrswitch = $_POST['csrswitch']; 
	$csrswitchprob = $_POST['csrswitchprob'];
	$csrswitchact = $_POST['csrswitchact'];

	//$csracc = $_POST['csracc']; 
	$csraccprob = $_POST['csraccprob'];
	$csraccact = $_POST['csraccact'];

	//$csractvedrctory = $_POST['csractvedrctory'];
	$csractvedrctoryprob = $_POST['csractvedrctoryprob'];
	$csractvedrctoryact = $_POST['csractvedrctoryact'];

	//$csrfilesrvr = $_POST['csrfilesrvr']; 
	$csrfilesrvrprob = $_POST['csrfilesrvrprob']; 
	$csrfilesrvract = $_POST['csrfilesrvract']; 

	//$csrmail = $_POST['csrmail']; 
	$csrmailprob = $_POST['csrmailprob']; 
	$csrmailact = $_POST['csrmailact']; 

	//$csrapp = $_POST['csrapp']; 
	$csrappprob = $_POST['csrappprob']; 
	$csrappact = $_POST['csrappact']; 

	//$csrother = $_POST['csrother']; 
	$csrotherprob = $_POST['csrotherprob']; 
	$csrotheract = $_POST['csrotheract']; 

	$csrpcname1 = $_POST['csrpcname1']; 
	$csrpcuser1 = $_POST['csrpcuser1']; 
	$csrpcprob1 = $_POST['csrpcprob1']; 
	$csrpcact1 = $_POST['csrpcact1']; 

	$csrpcname2 = $_POST['csrpcname2']; 
	$csrpcuser2 = $_POST['csrpcuser2']; 
	$csrpcprob2 = $_POST['csrpcprob2']; 
	$csrpcact2 = $_POST['csrpcact2']; 

	$csrpcname3 = $_POST['csrpcname3']; 
	$csrpcuser3 = $_POST['csrpcuser3']; 
	$csrpcprob3 = $_POST['csrpcprob3']; 
	$csrpcact3 = $_POST['csrpcact3']; 

	$csrpcname4 = $_POST['csrpcname4']; 
	$csrpcuser4 = $_POST['csrpcuser4']; 
	$csrpcprob4 = $_POST['csrpcprob4']; 
	$csrpcact4 = $_POST['csrpcact4']; 

	$csrpcname5 = $_POST['csrpcname5']; 
	$csrpcuser5 = $_POST['csrpcuser5']; 
	$csrpcprob5 = $_POST['csrpcprob5']; 
	$csrpcact5 = $_POST['csrpcact5']; 

	$csrpcname6 = $_POST['csrpcname6']; 
	$csrpcuser6 = $_POST['csrpcuser6']; 
	$csrpcprob6 = $_POST['csrpcprob6']; 
	$csrpcact6 = $_POST['csrpcact6']; 

	$csrpcname7 = $_POST['csrpcname7']; 
	$csrpcuser7 = $_POST['csrpcuser7']; 
	$csrpcprob7 = $_POST['csrpcprob7']; 
	$csrpcact7 = $_POST['csrpcact7']; 

	$csrpcname8 = $_POST['csrpcname8']; 
	$csrpcuser8 = $_POST['csrpcuser8']; 
	$csrpcprob8 = $_POST['csrpcprob8']; 
	$csrpcact8 = $_POST['csrpcact8']; 

	$csrpcname9 = $_POST['csrpcname9']; 
	$csrpcuser9 = $_POST['csrpcuser9']; 
	$csrpcprob9 = $_POST['csrpcprob9']; 
	$csrpcact9 = $_POST['csrpcact9']; 

	$csrpcname10 = $_POST['csrpcname10']; 
	$csrpcuser10 = $_POST['csrpcuser10']; 
	$csrpcprob10 = $_POST['csrpcprob10']; 
	$csrpcact10 = $_POST['csrpcact10']; 

	$csrprntbrand1 = $_POST['csrprntbrand1']; 
	$csrprntmodel1 = $_POST['csrprntmodel1']; 
	$csrprntprob1 = $_POST['csrprntprob1']; 
	$csrprntact1 = $_POST['csrprntact1']; 

	$csrprntbrand2 = $_POST['csrprntbrand2']; 
	$csrprntmodel2 = $_POST['csrprntmodel2']; 
	$csrprntprob2 = $_POST['csrprntprob2']; 
	$csrprntact2 = $_POST['csrprntact2']; 

	$csrprntbrand3 = $_POST['csrprntbrand3']; 
	$csrprntmodel3 = $_POST['csrprntmodel3']; 
	$csrprntprob3 = $_POST['csrprntprob3']; 
	$csrprntact3 = $_POST['csrprntact3']; 

	$csrtellocal1 = $_POST['csrtellocal1']; 
	$csrtelusr1 = $_POST['csrtelusr1']; 
	$csrtelprob1 = $_POST['csrtelprob1']; 
	$csrtelact1 = $_POST['csrtelact1']; 

	$csrtellocal2 = $_POST['csrtellocal2']; 
	$csrtelusr2 = $_POST['csrtelusr2']; 
	$csrtelprob2 = $_POST['csrtelprob2']; 
	$csrtelact2 = $_POST['csrtelact2']; 

	$csrtellocal3 = $_POST['csrtellocal3']; 
	$csrtelusr3 = $_POST['csrtelusr3']; 
	$csrtelprob3 = $_POST['csrtelprob3']; 
	$csrtelact3 = $_POST['csrtelact3']; 

	$csrrmrks1 = $_POST['csrrmrks1']; 
	$csrrmrks2 = $_POST['csrrmrks2']; 
	$csrrmrks3 = $_POST['csrrmrks3']; 
	$csrrmrks4 = $_POST['csrrmrks4']; 
	$csrrmrks5 = $_POST['csrrmrks5']; 
	$state = 'UATech';
	$stmt = $conn->prepare("INSERT into `csr` 
								(account_id, csrdate, csrname, csrtel, csradd, csrchck, csrtimein, csrtimeout, csrintprob,
								csrintact, csrrouterprob, csrrouteract, csrfirewallprob, csrfirewallact, csrswitchprob, csrswitchact, csraccprob, csraccact, csractvedrctoryprob,
								csractvedrctoryact, csrfilesrvrprob, csrfilesrvract, csrmailprob, csrmailact, csrappprob, csrappact, csrotherprob, csrotheract, csrpcname1,
								csrpcuser1, csrpcprob1, csrpcact1, csrpcname2, csrpcuser2, csrpcprob2, csrpcact2, csrpcname3, csrpcuser3, csrpcprob3,
								csrpcact3, csrpcname4, csrpcuser4, csrpcprob4, csrpcact4, csrpcname5, csrpcuser5, csrpcprob5, csrpcact5, csrpcname6,
								csrpcuser6, csrpcprob6, csrpcact6, csrpcname7, csrpcuser7, csrpcprob7, csrpcact7, csrpcname8, csrpcuser8, csrpcprob8,
								csrpcact8, csrpcname9, csrpcuser9, csrpcprob9, csrpcact9, csrpcname10, csrpcuser10, csrpcprob10, csrpcact10, csrprntbrand1,
								csrprntmodel1, csrprntprob1, csrprntact1, csrprntbrand2, csrprntmodel2, csrprntprob2, csrprntact2, csrprntbrand3, csrprntmodel3, csrprntprob3,
								csrprntact3, csrtellocal1, csrtelusr1, csrtelprob1, csrtelact1, csrtellocal2, csrtelusr2, csrtelprob2, csrtelact2, csrtellocal3,
								csrtelusr3, csrtelprob3, csrtelact3, csrrmrks1, csrrmrks2, csrrmrks3, csrrmrks4, csrrmrks5, state) 
							VALUES 
								(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
								 ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("isssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss",
						$account_id, $csrdate, $csrname, $csrtel, $csradd, $csrchck, $csrtimein, $csrtimeout, $csrintprob,
						$csrintact, $csrrouterprob, $csrrouteract, $csrfirewallprob, $csrfirewallact, $csrswitchprob, $csrswitchact, $csraccprob, $csraccact, $csractvedrctoryprob,
						$csractvedrctoryact, $csrfilesrvrprob, $csrfilesrvract, $csrmailprob, $csrmailact, $csrappprob, $csrappact, $csrotherprob, $csrotheract, $csrpcname1,
						$csrpcuser1, $csrpcprob1, $csrpcact1, $csrpcname2, $csrpcuser2, $csrpcprob2, $csrpcact2, $csrpcname3, $csrpcuser3, $csrpcprob3,
						$csrpcact3, $csrpcname4, $csrpcuser4, $csrpcprob4, $csrpcact4, $csrpcname5, $csrpcuser5, $csrpcprob5, $csrpcact5, $csrpcname6,
						$csrpcuser6, $csrpcprob6, $csrpcact6, $csrpcname7, $csrpcuser7, $csrpcprob7, $csrpcact7, $csrpcname8, $csrpcuser8, $csrpcprob8,
						$csrpcact8, $csrpcname9, $csrpcuser9, $csrpcprob9, $csrpcact9, $csrpcname10, $csrpcuser10, $csrpcprob10, $csrpcact10, $csrprntbrand1,
						$csrprntmodel1, $csrprntprob1, $csrprntact1, $csrprntbrand2, $csrprntmodel2, $csrprntprob2, $csrprntact2, $csrprntbrand3, $csrprntmodel3, $csrprntprob3,
						$csrprntact3, $csrtellocal1, $csrtelusr1, $csrtelprob1, $csrtelact1, $csrtellocal2, $csrtelusr2, $csrtelprob2, $csrtelact2, $csrtellocal3,
						$csrtelusr3, $csrtelprob3, $csrtelact3, $csrrmrks1, $csrrmrks2, $csrrmrks3, $csrrmrks4, $csrrmrks5, $state);
	
	$stmt->execute();	
	if($_SESSION['level'] == 'EMP'){
    		echo '<script type="text/javascript">window.location.replace("employee.php?ac=pencsr"); </script>';
    	}elseif ($_SESSION['level'] == 'ACC') {
    		echo '<script type="text/javascript">window.location.replace("accounting.php?ac=pencsr"); </script>';
    	}elseif ($_SESSION['level'] == 'TECH') {
    		echo '<script type="text/javascript">window.location.replace("techsupervisor.php?ac=pencsr"); </script>';
    	}elseif ($_SESSION['level'] == 'HR') {
    		echo '<script type="text/javascript">window.location.replace("hr.php?ac=pencsr"); </script>';
    	}
	$conn->close();
}


if(isset($_POST['upcsrsubmits'])){
	$csrname = mysql_escape_string($_POST['csrname']);
	$csrtel = mysql_escape_string($_POST['csrtel']); 
	$csradd = mysql_escape_string($_POST['csradd']);
	$csrdate = mysql_escape_string($_POST['csrdate']);
	$csr_id = mysql_escape_string($_POST['csr_id']);
	if(isset($_POST['csrchckreg'])){
		$csrchck = "Regular: 8 AM - 6 PM";
	}elseif(isset($_POST['csrchckot'])){
		$csrchck = "Overtime";
	}else{
		$csrchck = null;
	}
	//$csrchckot = mysql_escape_string($_POST['csrchckot']); 

	$csrtimein = mysql_escape_string($_POST['csrtimein']); 
	$csrtimeout = mysql_escape_string($_POST['csrtimeout']);

	//$csrinternet = mysql_escape_string($_POST['csrinternet']);
	$csrintprob = mysql_escape_string($_POST['csrintprob']);
	$csrintact = mysql_escape_string($_POST['csrintact']);

	//$csrrouter = mysql_escape_string($_POST['csrrouter']);
	$csrrouterprob = mysql_escape_string($_POST['csrrouterprob']);
	$csrrouteract = mysql_escape_string($_POST['csrrouteract']);

	//$csrfirewall = mysql_escape_string($_POST['csrfirewall']); 
	$csrfirewallprob = mysql_escape_string($_POST['csrfirewallprob']); 
	$csrfirewallact = mysql_escape_string($_POST['csrfirewallact']); 

	//$csrswitch = mysql_escape_string($_POST['csrswitch']); 
	$csrswitchprob = mysql_escape_string($_POST['csrswitchprob']);
	$csrswitchact = mysql_escape_string($_POST['csrswitchact']);

	//$csracc = mysql_escape_string($_POST['csracc']); 
	$csraccprob = mysql_escape_string($_POST['csraccprob']);
	$csraccact = mysql_escape_string($_POST['csraccact']);

	//$csractvedrctory = mysql_escape_string($_POST['csractvedrctory']);
	$csractvedrctoryprob = mysql_escape_string($_POST['csractvedrctoryprob']);
	$csractvedrctoryact = mysql_escape_string($_POST['csractvedrctoryact']);

	//$csrfilesrvr = mysql_escape_string($_POST['csrfilesrvr']); 
	$csrfilesrvrprob = mysql_escape_string($_POST['csrfilesrvrprob']); 
	$csrfilesrvract = mysql_escape_string($_POST['csrfilesrvract']); 

	//$csrmail = mysql_escape_string($_POST['csrmail']); 
	$csrmailprob = mysql_escape_string($_POST['csrmailprob']); 
	$csrmailact = mysql_escape_string($_POST['csrmailact']); 

	//$csrapp = mysql_escape_string($_POST['csrapp']); 
	$csrappprob = mysql_escape_string($_POST['csrappprob']); 
	$csrappact = mysql_escape_string($_POST['csrappact']); 

	//$csrother = mysql_escape_string($_POST['csrother']); 
	$csrotherprob = mysql_escape_string($_POST['csrotherprob']); 
	$csrotheract = mysql_escape_string($_POST['csrotheract']); 

	$csrpcname1 = mysql_escape_string($_POST['csrpcname1']); 
	$csrpcuser1 = mysql_escape_string($_POST['csrpcuser1']); 
	$csrpcprob1 = mysql_escape_string($_POST['csrpcprob1']); 
	$csrpcact1 = mysql_escape_string($_POST['csrpcact1']); 

	$csrpcname2 = mysql_escape_string($_POST['csrpcname2']); 
	$csrpcuser2 = mysql_escape_string($_POST['csrpcuser2']); 
	$csrpcprob2 = mysql_escape_string($_POST['csrpcprob2']); 
	$csrpcact2 = mysql_escape_string($_POST['csrpcact2']); 

	$csrpcname3 = mysql_escape_string($_POST['csrpcname3']); 
	$csrpcuser3 = mysql_escape_string($_POST['csrpcuser3']); 
	$csrpcprob3 = mysql_escape_string($_POST['csrpcprob3']); 
	$csrpcact3 = mysql_escape_string($_POST['csrpcact3']); 

	$csrpcname4 = mysql_escape_string($_POST['csrpcname4']); 
	$csrpcuser4 = mysql_escape_string($_POST['csrpcuser4']); 
	$csrpcprob4 = mysql_escape_string($_POST['csrpcprob4']); 
	$csrpcact4 = mysql_escape_string($_POST['csrpcact4']); 

	$csrpcname5 = mysql_escape_string($_POST['csrpcname5']); 
	$csrpcuser5 = mysql_escape_string($_POST['csrpcuser5']); 
	$csrpcprob5 = mysql_escape_string($_POST['csrpcprob5']); 
	$csrpcact5 = mysql_escape_string($_POST['csrpcact5']); 

	$csrpcname6 = mysql_escape_string($_POST['csrpcname6']); 
	$csrpcuser6 = mysql_escape_string($_POST['csrpcuser6']); 
	$csrpcprob6 = mysql_escape_string($_POST['csrpcprob6']); 
	$csrpcact6 = mysql_escape_string($_POST['csrpcact6']); 

	$csrpcname7 = mysql_escape_string($_POST['csrpcname7']); 
	$csrpcuser7 = mysql_escape_string($_POST['csrpcuser7']); 
	$csrpcprob7 = mysql_escape_string($_POST['csrpcprob7']); 
	$csrpcact7 = mysql_escape_string($_POST['csrpcact7']); 

	$csrpcname8 = mysql_escape_string($_POST['csrpcname8']); 
	$csrpcuser8 = mysql_escape_string($_POST['csrpcuser8']); 
	$csrpcprob8 = mysql_escape_string($_POST['csrpcprob8']); 
	$csrpcact8 = mysql_escape_string($_POST['csrpcact8']); 

	$csrpcname9 = mysql_escape_string($_POST['csrpcname9']); 
	$csrpcuser9 = mysql_escape_string($_POST['csrpcuser9']); 
	$csrpcprob9 = mysql_escape_string($_POST['csrpcprob9']); 
	$csrpcact9 = mysql_escape_string($_POST['csrpcact9']); 

	$csrpcname10 = mysql_escape_string($_POST['csrpcname10']); 
	$csrpcuser10 = mysql_escape_string($_POST['csrpcuser10']); 
	$csrpcprob10 = mysql_escape_string($_POST['csrpcprob10']); 
	$csrpcact10 = mysql_escape_string($_POST['csrpcact10']); 

	$csrprntbrand1 = mysql_escape_string($_POST['csrprntbrand1']); 
	$csrprntmodel1 = mysql_escape_string($_POST['csrprntmodel1']); 
	$csrprntprob1 = mysql_escape_string($_POST['csrprntprob1']); 
	$csrprntact1 = mysql_escape_string($_POST['csrprntact1']); 

	$csrprntbrand2 = mysql_escape_string($_POST['csrprntbrand2']); 
	$csrprntmodel2 = mysql_escape_string($_POST['csrprntmodel2']); 
	$csrprntprob2 = mysql_escape_string($_POST['csrprntprob2']); 
	$csrprntact2 = mysql_escape_string($_POST['csrprntact2']); 

	$csrprntbrand3 = mysql_escape_string($_POST['csrprntbrand3']); 
	$csrprntmodel3 = mysql_escape_string($_POST['csrprntmodel3']); 
	$csrprntprob3 = mysql_escape_string($_POST['csrprntprob3']); 
	$csrprntact3 = mysql_escape_string($_POST['csrprntact3']); 

	$csrtellocal1 = mysql_escape_string($_POST['csrtellocal1']); 
	$csrtelusr1 = mysql_escape_string($_POST['csrtelusr1']); 
	$csrtelprob1 = mysql_escape_string($_POST['csrtelprob1']); 
	$csrtelact1 = mysql_escape_string($_POST['csrtelact1']); 

	$csrtellocal2 = mysql_escape_string($_POST['csrtellocal2']); 
	$csrtelusr2 = mysql_escape_string($_POST['csrtelusr2']); 
	$csrtelprob2 = mysql_escape_string($_POST['csrtelprob2']); 
	$csrtelact2 = mysql_escape_string($_POST['csrtelact2']); 

	$csrtellocal3 = mysql_escape_string($_POST['csrtellocal3']); 
	$csrtelusr3 = mysql_escape_string($_POST['csrtelusr3']); 
	$csrtelprob3 = mysql_escape_string($_POST['csrtelprob3']); 
	$csrtelact3 = mysql_escape_string($_POST['csrtelact3']); 

	$csrrmrks1 = mysql_escape_string($_POST['csrrmrks1']); 
	$csrrmrks2 = mysql_escape_string($_POST['csrrmrks2']); 
	$csrrmrks3 = mysql_escape_string($_POST['csrrmrks3']); 
	$csrrmrks4 = mysql_escape_string($_POST['csrrmrks4']); 
	$csrrmrks5 = mysql_escape_string($_POST['csrrmrks5']); 
	$state = 'UATech';
	$stmt = "UPDATE `csr` set 
				csrdate = '$csrdate', csrname = '$csrname', csrtel = '$csrtel', csradd = '$csradd', csrchck = '$csrchck', csrtimein = '$csrtimein', csrtimeout = '$csrtimeout', csrintprob = '$csrintprob',
				csrintact = '$csrintact', csrrouterprob = '$csrrouterprob', csrrouteract = '$csrrouteract', csrfirewallprob = '$csrfirewallprob', csrfirewallact = '$csrfirewallact', csrswitchprob = '$csrswitchprob', csrswitchact = '$csrswitchact', csraccprob = '$csraccprob', csraccact = '$csraccact', csractvedrctoryprob =  '$csractvedrctoryprob',
				csractvedrctoryact = '$csractvedrctoryact', csrfilesrvrprob = '$csrfilesrvrprob', csrfilesrvract = '$csrfilesrvract', csrmailprob = '$csrmailprob', csrmailact = '$csrmailact', csrappprob = '$csrappprob', csrappact = '$csrappact', csrotherprob = '$csrotherprob', csrotheract = '$csrotheract', csrpcname1 = '$csrpcname1',
				csrpcuser1 = '$csrpcuser1', csrpcprob1 = '$csrpcprob1', csrpcact1 = '$csrpcact1', csrpcname2 = '$csrpcname2', csrpcuser2 = '$csrpcuser2', csrpcprob2 = '$csrpcprob2', csrpcact2 = '$csrpcact2', csrpcname3 = '$csrpcname3', csrpcuser3 = '$csrpcuser3', csrpcprob3 = '$csrpcprob3',
				csrpcact3 = '$csrpcact3', csrpcname4 = '$csrpcname4', csrpcuser4 = '$csrpcuser4', csrpcprob4 = '$csrpcprob4', csrpcact4 = '$csrpcact4', csrpcname5 = '$csrpcname5', csrpcuser5 = '$csrpcuser5', csrpcprob5 = '$csrpcprob5', csrpcact5 = '$csrpcact5', csrpcname6 = '$csrpcname6',
				csrpcuser6 = '$csrpcuser6', csrpcprob6 = '$csrpcprob6', csrpcact6 = '$csrpcact6', csrpcname7 = '$csrpcname7', csrpcuser7 = '$csrpcuser7', csrpcprob7 = '$csrpcprob7', csrpcact7 = '$csrpcact7', csrpcname8 = '$csrpcname8', csrpcuser8 = '$csrpcuser8', csrpcprob8 = '$csrpcprob8',
				csrpcact8 = '$csrpcact8', csrpcname9 = '$csrpcname9', csrpcuser9 = '$csrpcuser9', csrpcprob9 = '$csrpcprob9', csrpcact9 = '$csrpcact9', csrpcname10 = '$csrpcname10', csrpcuser10 = '$csrpcuser10', csrpcprob10 = '$csrpcprob10', csrpcact10 = '$csrpcact10', csrprntbrand1 = '$csrprntbrand1',
				csrprntmodel1 = '$csrprntmodel1', csrprntprob1 = '$csrprntprob1', csrprntact1 = '$csrprntact1', csrprntbrand2 = '$csrprntbrand2', csrprntmodel2 = '$csrprntmodel2', csrprntprob2 = '$csrprntprob2', csrprntact2 = '$csrprntact2', csrprntbrand3 = '$csrprntbrand3', csrprntmodel3 = '$csrprntmodel3', csrprntprob3 = '$csrprntprob3',
				csrprntact3 = '$csrprntact3', csrtellocal1 = '$csrtellocal1', csrtelusr1 = '$csrtelusr1', csrtelprob1 = '$csrtelprob1', csrtelact1 = '$csrtelact1', csrtellocal2 = '$csrtellocal2', csrtelusr2 = '$csrtelusr2', csrtelprob2 = '$csrtelprob2' , csrtelact2 = '$csrtelact2', csrtellocal3 = '$csrtellocal3',
				csrtelusr3 = '$csrtelusr3', csrtelprob3 = '$csrtelprob3', csrtelact3 = '$csrtelact3', csrrmrks1 = '$csrrmrks1', csrrmrks2 = '$csrrmrks2', csrrmrks3 = '$csrrmrks3', csrrmrks4 = '$csrrmrks4', csrrmrks5 = '$csrrmrks5', state = '$state'

			WHERE
				csr_id = $csr_id and account_id = $account_id
				";
						
	
	if ($conn->query($stmt) === TRUE) {
		if($_SESSION['level'] == 'EMP'){
			echo '<script type="text/javascript">window.location.replace("employee.php?ac=pencsr"); </script>';
		}else if($_SESSION['level'] == 'TECH'){
			echo '<script type="text/javascript">window.location.replace("techsupervisor.php?ac=pencsr"); </script>';
		}else if($_SESSION['level'] == 'HR'){
			echo '<script type="text/javascript">window.location.replace("hr.php?ac=pencsr"); </script>';
		}	    	
  	}else {
    	echo "Error updating record: " . $conn->error;
  	}
	$conn->close();
}
?>	