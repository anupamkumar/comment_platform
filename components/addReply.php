<?php
	$username = $_GET['user'];
	$rid = $_GET['rid'];
	$cmt = $_GET['cmt'];

	$connection = mysqli_connect("localhost","admin1","1","comments_platform");
	if(mysqli_connect_errno())
	{
		echo "Failed to connect : " . mysqli_connect_error();
	}
	if(!mysqli_query($connection,"insert into comments (`ct`,`username`,`rid`) values ('".$cmt."','".$username."','".$rid."')"))
	{
		die('<script>alert("Error: '.mysqli_error($connection).'")</script>');
	}
	mysqli_close($connection);
?>