<?php
include("configuration.php");
session_start();
if(!isset($_SESSION['username']))
{
	header("location:index.php");
}
$username=$_SESSION['username'];
$sql=mysqli_query($con,"SELECT * FROM users WHERE username!='$username'");
$receiver=$_POST['users'];
$massages=$_POST['msg'];
if($receiver!=NULL && $_POST['msg']!=NULL){
	mysqli_query($con,"INSERT INTO massage(sender,receiver,msg,date) VALUES('$username','$receiver','$massages',CURRENT_TIMESTAMP)");
	$info="Message Sent!";
}
?>

<!DOCTYPE html>
<head>
	<title>Conversation</title>
	<link href="scripts/styles.css" rel="stylesheet">
</head>
<body>
	<span class="heading">Start Conversation</span>
	<hr style="border:2px solid #000;"/><br>
	<a class="home" href="home.php">Home</a>
	<span style="float:right">
		<a class="logout" href="logout.php">Logout</a>
	</span><br><br>
	<div align="center">
		<form method="post" action="">
			<table class="table" cellpadding="4" cellspacing="4">
				<tr>
					<td class="tablehead" colspan="2" align="center">Send Massages<hr></td>
				</tr>
				<tr>
					<td colspan="2" align="center"><?php echo $info;?></td>
				</tr>
				<tr>
					<td class="labels">Select user: </td>
					<td>
						<select name="users" class="fields">
						<option disabled="disabled" selected="selected">----------------</option>
						<?php while($users=mysqli_fetch_array($sql)){
							?>
							<option value="<?php echo $users['username'];?>">
								<?php echo $users['name'];?>	
							</option>
							<?php 
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="labels">Massage:</td>
					<td><textarea name="msg" class="fields" rows="4" cols="30" required="required"></textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input type="submit" value="Send" class="button">
					</td>
				</tr>
			</table>
		</form><br><br>
		<?php
		$data=mysqli_query($con,"SELECT * FROM massage WHERE receiver='$username' ORDER BY id DESC");
		?>
		<table cellpadding="4" cellspacing="4" class="table2">
			<tr>
				<td class="tablehead" align="center" colspan="2">Inbox Massages<hr></td>
			</tr>
			<?php 
			while($r=mysqli_fetch_array($data)){
				$e=$r['sender'];
				$f=mysqli_query($con,"SELECT * FROM users WHERE username='$e'");
				$s=mysqli_fetch_array($f);
				$recv=$s['name'];
			?>
			<tr>
				<td class="msg" style="font-size:12px;">
					<?php echo $r['msg'];?>
					<span style="color:indigo;">(From <?php echo $recv;?> on <?php echo $r['date'];?>)</span>
					<a href="deleteMassage.php?del=<?php echo $r['id'];?>"style="margin:5px;font-size:12px;">Delete</a>
				</td>
			</tr>
			<?php 
			}?>
		</table>
		<br><br>
		<?php 
		$data=mysqli_query($con,"SELECT * FROM massage WHERE sender='$username' ORDER BY id DESC LIMIT 10");
	?>
	<table cellpadding="4" cellspacing="4" class="table2">
		<tr>
			<td class="tablehead" align="center" colspan="2">Sent Massages<hr></td>
		</tr>
			<?php 
			while($r=mysqli_fetch_array($data)){
				$e=$r['receiver'];
				$f=mysqli_query($con,"SELECT * FROM users WHERE username='$e'");
				$s=mysqli_fetch_array($f);
				$recv=$s['name'];
			?>
		<tr>
			<td class="msg" style="font-size:12px;">
				<?php echo $r['msg'];?>
				<span style="color:darkgreen;">( To <?php echo $recv;?> on <?php echo $r['date'];?>)</span>
				<a href="deleteMassage.php?del=<?php echo $r['id'];?>"style="margin:5px;font-size:12px;">Delete</a>
			</td>
			</tr>
			<?php 
			}?>
		</table>
		<br>
	</div>
</body>
</html>