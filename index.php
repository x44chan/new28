<?php
	session_start();
	if(isset($_SESSION['acc_id'])){
		if($_SESSION['level'] == 'Admin'){
			header("location: admin.php");
		}else if($_SESSION['level'] == 'EMP'){
			header("location: employee.php?ac=penot");
		}
		else if($_SESSION['level'] == 'HR'){
			header("location: hr.php?ac=penot");
		}else{
			header("location: accounting.php?ac=penot");
		}
	}
	$title="Login Page";
	include('header.php');
?>
<div align = "center" style = "margin-top: 10px;">
			<img class="img-rounded" src = "img/netlink.jpg" height = "200">
		</div>
		<form role = "form" action = "index.php" method = "post">	
			<table align = "center" class = "table table-hover form-horizontal" style = "margin-top: 0px; width: 800px;" >
				<thead>
					<tr style = "border: none;">
						<td colspan = 2 align = center><h2> Login Form</h2></td> 
					</tr>
				</thead>
				<tr >
					<td><label for = "uname"> Username: </label><input id = "uname" title = "Input your username." type = "text" class = "form-control" required name = "uname"/></td>
				
					<td><label for = "pword"> Password: </label><input id = "pword" title = "Input your password." type = "password" class = "form-control" required name = "password"/></td>
				</tr>
				<tr >
					<td colspan = 4 align = "center" ><input style = "width: 150px;" class = "btn btn-default" name = "submit" type = "submit" value = "Submit"/></td>
				</tr>
			</table>
		</form>

<?php
	if(isset($_POST['submit'])){
		include('conf.php');
		$uname = mysqli_real_escape_string($conn, $_POST['uname']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		
		$sql = "SELECT * FROM `login` where uname = '$uname' and pword = '$password'";
		$result = $conn->query($sql);
		
		if($result->num_rows > 0){
			while($row = $result->fetch_assoc()){
				if($row['level'] == 'Admin'){		
					$_SESSION['name'] = $row['fname'] . ' ' . $row['lname'];				
					$_SESSION['level'] = $row['level'];
					$_SESSION['acc_id'] = $row['account_id'];
					header("location: admin.php");
				}else if($row['level'] == 'Employee'){
					$_SESSION['name'] = $row['fname'] . ' ' . $row['lname'];				
					$_SESSION['level'] = $row['level'];
					$_SESSION['acc_id'] = $row['account_id'];
					header("location: employee.php?ac=penot");		
				}else if($row['level'] == 'HR'){
					$_SESSION['name'] = $row['fname'] . ' ' . $row['lname'];				
					$_SESSION['level'] = $row['level'];
					$_SESSION['acc_id'] = $row['account_id'];
					header("location: hr.php?ac=penot");		
				}else{
					$_SESSION['name'] = $row['fname'] . ' ' . $row['lname'];				
					$_SESSION['level'] = $row['level'];
					$_SESSION['acc_id'] = $row['account_id'];
					header("location: accounting.php?ac=penot");	
				}
			}
		}else{
	echo  '<div class="alert alert-warning" align = "center">
						<a href="#"  class="close" data-dismiss="alert" aria-label="close" >&times;</a>
						<strong>Warning!</strong> Incorrect Login.
					</div>';
			
			}
		$conn->close();
	}
	
	include('footer.php');
?>