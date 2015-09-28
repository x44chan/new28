<?php
	
	date_default_timezone_set('Asia/Manila');
	session_start();
	include("conf.php");
	if(isset($_SESSION['acc_id'])){
		$accid = $_SESSION['acc_id'];
		if($_SESSION['level'] == 'Employee'){
			header("location: index.php");
		}
	}else{
				header("location: index.php");
	
	}
	
	include('conf.php');
	if(isset($_GET['overtime'])){	
		$id = mysqli_real_escape_string($conn, $_GET['overtime']);
		$state = mysqli_real_escape_string($conn, $_GET['approve']);
		if(isset($_GET['dareason'])){
			$dareason = mysqli_real_escape_string($conn, $_GET['dareason']);
		}
		
		if($_SESSION['level'] == 'ACC'){
			$date = date('Y-m-d h:i A');
			$sql = "UPDATE overtime set state = '$state',dateacc = '$date',dareason = '$dareason' where overtime_id = $id and state = 'AHR'";			
			if($conn->query($sql) == TRUE){
				header('location: accounting.php?ac='.$_GET['ac'].'');			
			}else{
				die("Connection error:". $conn->connect_error);
			}
		}else if($_SESSION['level'] == 'HR'){
			$date = date('Y-m-d h:i A');
			$sql = "UPDATE overtime set state = '$state',datehr = '$date',dareason = '$dareason' where overtime_id = $id and state = 'UA'";			
			if($conn->query($sql) == TRUE){
				header('location: hr.php?ac='.$_GET['ac'].'');		
			}else{
				die("Connection error:". $conn->connect_error);
			}
		}else{
			$sql = "UPDATE overtime set state = '$state' where overtime_id = $id and state like 'AACC%'";
			if($conn->query($sql) == TRUE){
				echo 'added';
				header('location: admin.php');
			}else{
			die("Connection error:". $conn->connect_error);
		}		
	}	
	}
?>

<?php
	include('conf.php');
	if(isset($_GET['officialbusiness_id'])){
		$id = mysqli_real_escape_string($conn, $_GET['officialbusiness_id']);
		$state = mysqli_real_escape_string($conn, $_GET['approve']);		
		if(isset($_GET['dareason'])){
			$dareason = mysqli_real_escape_string($conn, $_GET['dareason']);
		}
		if($_SESSION['level'] == 'ACC'){
			$date = date('Y-m-d h:i A');
			$sql = "UPDATE officialbusiness set state = '$state',dateacc = '$date',dareason = '$dareason'  where officialbusiness_id = $id and state = 'AHR'";			
			if($conn->query($sql) == TRUE){
				header('location: accounting.php?ac='.$_GET['ac'].'');			
			}else{
				die("Connection error:". $conn->connect_error);
			}
		}else if($_SESSION['level'] == 'HR'){
			$date = date('Y-m-d h:i A');
			$sql = "UPDATE officialbusiness set state = '$state',datehr = '$date',dareason = '$dareason'  where officialbusiness_id = $id and state = 'UA'";			
			if($conn->query($sql) == TRUE){
				header('location: hr.php?ac='.$_GET['ac'].'');
			}else{
				die("Connection error:". $conn->connect_error);
			}
		}else{
			$sql = "UPDATE officialbusiness set state = '$state' where officialbusiness_id = $id and state like 'AACC%'";
			if($conn->query($sql) == TRUE){
				echo 'added';
				header('location: admin.php');
			}else{
			die("Connection error:". $conn->connect_error);
		}		
	}		
	}
?>


<?php
	include('conf.php');
	if(isset($_GET['undertime'])){
		$id = mysqli_real_escape_string($conn, $_GET['undertime']);
		$state = mysqli_real_escape_string($conn, $_GET['approve']);
		if(isset($_GET['dareason'])){
			$dareason = mysqli_real_escape_string($conn, $_GET['dareason']);
		}
		echo $id.''.$state;
		if($_SESSION['level'] == 'ACC'){
			$date = date('Y-m-d h:i A');
			$sql = "UPDATE undertime set state = '$state',dateacc = '$date',dareason = '$dareason'  where undertime_id = $id and state = 'AHR'";			
			if($conn->query($sql) == TRUE){
				header('location: accounting.php?ac='.$_GET['ac'].'');			
			}else{
				die("Connection error:". $conn->connect_error);
			}
		}else if($_SESSION['level'] == 'HR'){
			$date = date('Y-m-d h:i A');
			$sql = "UPDATE undertime set state = '$state',datehr = '$date',dareason = '$dareason'  where undertime_id = $id and state = 'UA'";			
			if($conn->query($sql) == TRUE){
				header('location: hr.php?ac='.$_GET['ac'].'');		
			}else{
				die("Connection error:". $conn->connect_error);
			}
		}else{
			$sql = "UPDATE undertime set state = '$state' where undertime_id = $id and state like 'AACC%'";
			if($conn->query($sql) == TRUE){
				echo 'added';
				header('location: admin.php');
			}else{
			die("Connection error:". $conn->connect_error);
		}		
	}
}
?>


<?php
	include('conf.php');
	if(isset($_GET['leave'])){
		$id = mysqli_real_escape_string($conn, $_GET['leave']);
		$state = mysqli_real_escape_string($conn, $_GET['approve']);
		if(isset($_GET['dareason'])){
			$dareason = mysqli_real_escape_string($conn, $_GET['dareason']);
		}
		if($_SESSION['level'] == 'ACC'){
			$date = date('F d, Y h:i A');
			$sql = "UPDATE nleave set state = '$state',dateacc = '$date',dareason = '$dareason'  where leave_id = $id and state = 'AHR'";			
			if($conn->query($sql) == TRUE){
				header('location: accounting.php?ac='.$_GET['ac'].'');			
			}else{
				die("Connection error:". $conn->connect_error);
			}
		}else if($_SESSION['level'] == 'HR'){
			$date = date('F d, Y h:i A');
			$sql = "UPDATE nleave set state = '$state',datehr = '$date',dareason = '$dareason'  where leave_id = $id and state = 'UA'";			
			if($conn->query($sql) == TRUE){
				header('location: hr.php?ac='.$_GET['ac'].'');		
			}else{
				die("Connection error:". $conn->connect_error);
			}
		}else{
			$sql = "UPDATE nleave set state = '$state' where leave_id = $id and state like 'AACC%'";
			if($conn->query($sql) == TRUE){
				echo 'added';
				header('location: admin.php');
			}else{
			die("Connection error:". $conn->connect_error);
		}		
	}			
	}
?>