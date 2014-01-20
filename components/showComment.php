<?php 
	$u = $_GET['u']." says:";
	$user = $_GET['user'];
	$comment = $_GET['comm'];
	$s = "<p><i>".$u."</i></p>";
	$s = $s."<p>".$comment."</p>";
	$s = $s."<span><a id='rep'>Reply</a></span>&nbsp;";
	if($user == $u)
	{
		$s = $s."<span><a id='edt'>Edit</a></span>&nbsp;<span><a id='del'>Delete</a></span>";
	}
	echo $s;
?>

