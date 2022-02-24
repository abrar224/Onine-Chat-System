<?php
include("configuration.php");
session_start();
if(!isset($_SESSION['username']))
{
	header("location:index.php");
}
$username=$_SESSION['username'];
$sql=mysqli_query($con,"SELECT * FROM users WHERE username='$username'");

$data=mysqli_fetch_array($sql);
$curr_pass=$data['password'];
$old_pass=sha1($_POST['old']);
$new_pass=sha1($_POST['new']);
$re_pass=sha1($_POST['re']);
if($_POST['old']!=NULL && $_POST['new']!=NULL && $_POST['re']!=NULL)
{
	if($old_pass!=$curr_pass)
	{
	$info="Incorrect old password";
	}
	elseif($new_pass!=$re_pass)
	{
		$info="New password didn't matched";
	}
	else
	{
		mysqli_query($con,"UPDATE users SET password='$new_pass' WHERE username='$username'");
		$info="Password changed successfully!";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<link href="scripts/styles.css" rel="stylesheet" type="text/css" />
	<title>Password</title>
</head>
<body>
	<span class="heading">Change Password</span>
	<hr style="border:2px solid #000;"/><br>
	<a class="home" href="home.php">Home</a>
	<span style="float:right">
		<a class="logout" href="logout.php">Logout</a>
	</span><br><br><br>
	<div align="center">
		<form method="post" action="">
			<table cellpadding="4" cellspacing="4" class="table">
				<tr>
					<td colspan="2" class="info" align="center"><?php echo $info;?></td>
				</tr>
				<tr>
					<td class="labels">Old Password:</td>
					<td><input type="password" name="old" size="25" class="fields" placeholder="Enter old password" required="required"></td>
				</tr>
				<tr>
					<td class="labels">New Password:</td>
					<td><input type="password" name="new" size="25" class="fields" placeholder="Enter new password" required="required"></td>
				</tr>
				<tr>
					<td class="labels">Re-New Password :</td>
					<td><input type="password" name="re" size="25" class="fields" placeholder="Re-enter new password" required="required"></td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="Confirm" class="button">
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>