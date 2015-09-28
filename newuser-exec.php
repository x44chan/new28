<?php
if(isset($_POST['regsubmit'])){
		include('conf.php');
		$uname = mysqli_real_escape_string($conn,$_POST['reguname']);
		$pw = $_POST['regpword'];
		$cpw = $_POST['regcppword'];
		$regfname = $_POST['regfname'];
		$reglname = $_POST['reglname'];
		$level = $_POST['level'];
		$sql = "SELECT * FROM `login` where `uname` = '$uname'";
		$result = $conn->query($sql);
		if($pw != $cpw){
			header('location: admin.php?suc=3');
		}else if($result->num_rows > 0){
			$error =  '<div class="alert alert-warning" align = "center">
						<a href="#"  class="close" data-dismiss="alert" aria-label="close" >&times;</a>
						<strong>Warning!</strong> Username already exists.
					</div>';
			header("location: admin.php?suc=0");
			unset($_POST['regsubmit']);
			$conn->close();
		}else{
			$error = '<div class="alert alert-success" align = "center">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<strong>Success!</strong> New user added.
						</div>';
			$stmt = $conn->prepare("INSERT into `login` (uname, pword, fname, lname, level) VALUES (?, ?, ?, ?, ?)");
			$stmt->bind_param("sssss", $uname, $pw, $regfname, $reglname, $level);
			$stmt->execute();			
			header("location: admin.php?suc=1");
			unset($_POST['regsubmit']);
			$conn->close();
	 
	 }

}
?>