<?php
	include("config.php");
	$id=$_GET['id'];
	
	
	$res=mysqli_query($con,"SELECT * FROM user WHERE id=$id");

    while($row=mysqli_fetch_array($res))
	{
		$delete=$row['image'];
		unlink("upload/$delete");
		header("Location:list.php");
	}
	
	$query="delete from user where id=$id";
	$result=mysqli_query($con,$query);
		
			
	
	
?>
	
	
	

