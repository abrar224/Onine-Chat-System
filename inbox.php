<?php
include("configuration.php");
session_start();
if(!isset($_SESSION['username']))
{
	header("location:index.php");
}
if(!empty($_POST))
{
	$massage = $_POST['msg'];
	$username = $_SESSION['username'];
	$sql = mysqli_query($con,"SELECT * FROM users WHERE username='$username'");
	$data= mysqli_fetch_array($sql);
	$name = $data['name'];
	$date = date('d-m-y');
	$time = date('h:i a');
	mysqli_query($con,"INSERT INTO inbox(sender,username,msg,time,date) VALUES('$name','$username','$massage','$time','$date')");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inbox</title>
	<link href="scripts/styles.css" rel="stylesheet">
	<script type="text/javascript" src="scripts/jquery-3.1.1.min.js"></script>
	<script>
		function ajax_function(){
			$.ajax({
				url:"script.php", 
        		success:(function(data){
        			$("#chat").html(data);
        		}),
        	})
        };
        ajax_function();
    	setInterval(ajax_function,(1000));
	</script>
</head>
<body>
	<span class="heading">Chat Room</span>
	<hr style="border:2px solid #000;"/><br>
	<a class="home" href="home.php">Home</a>
	<span style="float:right">
		<a class="logout" href="logout.php">Logout</a>
	</span><br><br>
	<div align="center">
		<form method="post" action="" id="myform">
			<table class="table2" cellpadding="4" cellspacing="4">
				<tr>
					<td align="center" class="tablehead" colspan="2">Chat Box</td>
				</tr>
				<tr>
					<td colspan="2"><div class="fields" style="overflow:scroll;height:300px;word-wrap:normal;width:600px;" id="chat"></div>
					</td>
				</tr>
				<tr>
					<td>
						<input name="msg" id="msg" class="fields" type="text" placeholder="Enter Your Massage" required="required" autocomplete="off" style="height:55px;" size="58">
					</td>
					<td>
						<input type="submit" value="Send" class="button" style="height:50px;">
					</td>
				</tr>
			</table>
		</form>
		<br><br>
	</div>
</body>
</html>