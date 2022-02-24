<?php
include("configuration.php");
session_start();
if(isset($_SESSION['username']))
{
	mysqli_query($con,"UPDATE users SET status = 0 WHERE username = '".$_SESSION['username']."'");
}
unset($_SESSION['username']);
unset($_SESSION['id']);
session_destroy();
header("location:index.php");
?>