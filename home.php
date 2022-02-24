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
$name=$data['name'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Homepage</title>
	<link href="scripts/styles.css" rel="stylesheet">
</head>

<body>
	<span class="heading">Welcome <?php echo $name;?></span>
	<hr style="border:2px solid #000;"/><br>
	<span style="float:right">
		<a class="logout" href="logout.php">Logout</a>
	</span><br><br>
	<div align="center">
		<table class="table2" cellpadding="10" cellspacing="10">
			<tr>
				<td align="center">
					<span class="tablehead">User Panal</span><hr>
					<a href="inbox.php">Chat Room</a><br>
					<a href="conversation.php">Start Conversation</a><br>
					<a href="changeUserPassword.php">Change Password</a>
				</td>
			</tr>
		</table><br><br>
		<table class="table2" cellpadding="10" cellspacing="10">
			<tr>
				<td>
					<span class="tablehead">Online Users</span><hr>
					<?php $on = mysqli_query($con, "SELECT * FROM users WHERE status = 1");
					while($pr = mysqli_fetch_array($on)){
					?>
      		  			<span class="labels" style="color:darkgreen;"><?php echo $pr['name'];?><br></span>
    	  		  	<?php
					}?>
				</td>
			</tr>
		</table>
	</div>
</body>
</html>