<?php
include("configuration.php");
$name=$_POST['name'];
$username=$_POST['username'];
$email=$_POST['email'];
$pass=$_POST['pass'];
$repass=$_POST['repass'];

$match=mysqli_query($con,"SELECT * FROM users WHERE username='$username'");
if(mysqli_num_rows($match)==1){
	$info="Userame Already Exists";
}
if($name!=NULL && $username!=NULL && $email!=NULL && $_POST['pass']!=NULL && $_POST['repass']!=NULL){
	if($pass==$repass){
		$cpass=sha1($pass);
		$sql=mysqli_query($con,"INSERT INTO users(name,username,email,password,status) VALUES('$name','$username','$email','$cpass','0')");
		if($sql){
			$info="Successfully registered";
		} 
		else{
			$info = "Something wrong";
		}
	}
	else{
		$info="Password didn't matched";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration</title>
	<link href="scripts/styles.css" rel="stylesheet">
</head>
<body>
	<div align="center"><br><br>
		<span class="heading">Registration</span>
		<br><br><br>
		<form method="post" action="">
			<table class="table" cellpadding="5" cellspacing="5">
				<tr>
					<td colspan="4" align="center"><?php echo $info;?></td>
				</tr>
				<tr>
					<td class="labels">Full Name:</td>
					<td><input type="text" name="name" size="30" class="fields" placeholder="Enter Full Name" autocomplete="off" required="required"></td>
				</tr>
				<tr>
					<td class="labels">Username: </td>
					<td><input type="text" name="username" size="30" class="fields" placeholder="Enter Username" autocomplete="off" required="required" /></td>
				</tr>
				<tr>
					<td class="labels">Email: </td>
					<td><input type="email" name="email" size="30" class="fields" placeholder="Enter Email" autocomplete="off" required="required"></td>
				</tr>
				<tr>
					<td class="labels">Password:</td>
					<td><input type="password" name="pass" size="30" class="fields" placeholder="Enter Password" required="required"></td>
				</tr>
				<tr>
					<td class="labels">Re-Password:</td>
					<td><input type="password" name="repass" size="30" class="fields" placeholder="Enter Password" required="required"></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="Sign up" class="button">
					</td>
				</tr>
			</table>
		</form><br>
		<a href="index.php">Already have an account?</a>
	</div>
</body>
</html>