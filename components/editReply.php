<?php
$cmt = $_GET['cmt'];
$cid = $_GET['cid'];
$connection = mysqli_connect("localhost","admin1","1","comments_platform");
if(mysqli_connect_errno())
{
	echo "Failed to connect : " . mysqli_connect_error();
}
if(!mysqli_query($connection,"update comments set `ct` = '".$cmt."' where `cid`='".$cid."'"))
{
	die('<script>alert("Error: '.mysqli_error($connection).'")</script>');
}
mysqli_close($connection);
?>