<?php
include("configuration.php");
session_start();
if(!isset($_SESSION['username']))
{
	header("location:index.php");
}
$del=$_GET['del'];
mysqli_query($con,"DELETE FROM massage WHERE id='$del'");
header("location:conversation.php");
?>