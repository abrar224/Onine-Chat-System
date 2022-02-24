<?php
include("configuration.php");
session_start();
if(isset($_SESSION['username']))
{
	header("location:home.php");
}
$username=$_POST['username'];
$password=$_POST['password'];
if($username!=NULL && $_POST['password']!=NULL)
{
	$sql=mysqli_query($con,"SELECT * FROM users WHERE username='".mysqli_real_escape_string($con,$username).
		"'AND password='".mysqli_real_escape_string($con,sha1($password))."'");	
	if(mysqli_num_rows($sql)==1)
	{
		$_SESSION['username']=$_POST['username'];
		mysqli_query($con,"UPDATE users SET status = 1 WHERE username = '".$_SESSION['username']."'");
		header("location:home.php");
	}
	else
	{
		$info="Incorrect Username or Password";
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Login User</title>
		<link href="scripts/styles.css" rel="stylesheet">
	</head>
	<body>
	<div align="center"><br><br><br>
		<span class="heading">Welcome to Chatbox</span><br><br><br>
		<form method="post" action="">
			<table class="table" cellpadding="4" cellspacing="4">
				<tr>
					<td align="center" colspan="2" class="tablehead">Login here</td>
				</tr>
				<tr>
					<td align="center" colspan="2"><?php echo $info;?></td>
				</tr>
				<tr>
					<td class="labels">Username: </td><td><input type="text" name="username" class="fields" size="30" required="required" placeholder="Enter Username" autocomplete="off" /></td>
				</tr>
				<tr>
					<td class="labels">Password : </td><td><input type="password" name="password" class="fields" size="30" required="required" placeholder="Enter password" /></td></tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" value="Login" class="button"></td>
				</tr>
			</table>
		</form><br>
		<a href="registration.php">Don't have any account?</a><br>
	</div>
	</body>
</html>