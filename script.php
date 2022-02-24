<?php 
include("configuration.php");
$fetch=mysqli_query($con,"SELECT * FROM inbox ORDER BY id");
while($f=mysqli_fetch_array($fetch))
{
	print('');
	$data = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM users WHERE username='".$f['username']."'"));
	?>
	<span style="color:grey;">
		<?php echo $f['sender'];?></span>:
	<span class="msg">
		<?php echo $f['msg']."<br>";?>
		<span style="font-size:10px;color:green;">
			<?php echo $f['time']." | ".$f['date']."<br><br>";?>
		</span>
	</span>
	<?php 
} 
?>
