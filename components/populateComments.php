<?php 
	$op="";
	$max=0;
	$u = $_GET['user'];
	$connection = mysqli_connect("localhost","admin1","1","comments_platform");
	if(mysqli_connect_errno())
	{
		echo "Failed to connect : " . mysqli_connect_error();
	}
	$res = mysqli_query($connection,"select * from comments");
	$cids = array();
	$comments = array();
	$usernames = array();
	$rids = array();
	$tempStack = array();
	while($row = mysqli_fetch_array($res))
	{
		array_push($cids, $row['cid']);
		array_push($comments,$row['ct']);
		array_push($usernames,$row['username']);
		array_push($rids,$row['rid']);		
	}
	mysqli_close($connection);
	for($index=0;$index<count($cids);$index++)
	{
		if($cids[$index] != -1)
		{
			$cur = $cids[$index];
			array_push($tempStack,$cur);								
		}			
		$lp = true;
		while($cur != null)
		{
			$cidPos = search($cur,$cids);
			if( $cidPos != -1)
			{
				if($comments[$cidPos] == '[comment deleted]')
					$op = $op."<div id='postedComment".$cur."' reply-level='0'><p><i>".$usernames[$cidPos]." says: </i></p><p id='comm".$cur."'>".$comments[$cidPos]."</p><div id='controls".$cur."' class='none'>";
				else 
				{
					$op = $op."<div id='postedComment".$cur."' reply-level='0'><p><i>".$usernames[$cidPos]." says: </i></p><p id='comm".$cur."'>".$comments[$cidPos]."</p><div id='controls".$cur."' class='none'><span><a href='#' id='rep".$cur."' onclick='fnRep(".$cur.")'>Reply</a></span>&nbsp;";
					if($u == $usernames[$cidPos])
					{
						$op = $op."<span><a href='#' id='edt".$cur."' onclick='fnEd(".$cur.")'>Edit</a></span>&nbsp;<span><a href='#' id='del".$cur."' onclick='fnD(".$cur.")'>Delete</a></span>&nbsp;";
					}
				}					
				$op = $op."</div>";
				$cids[$cidPos] = -1;
			}				
			$childPos = search($cur,$rids);
			if($childPos == -1)
			{
				$cur = array_pop($tempStack);
				if($max < $cur)
					$max = $cur;
				if($cur == null)
					$op = $op."</div>";					
			}
			else
			{
				if(empty($tempStack))
					array_push($tempStack,$cur);	
				$cur = $cids[$childPos];
				array_push($tempStack,$cur);
				$noOfBQ = count($tempStack)-1;
				while($noOfBQ > 0)
				{
					$op = $op."<blockquote>";
					$noOfBQ--;
				}
				$noOfBQ = count($tempStack)-1;
				if($comments[$childPos] == '[comment deleted]')
					$op = $op."<div id='postedComment".$cur."' reply-level='".$noOfBQ."'><p><i>".$usernames[$childPos]." says: </i></p><p id='comm".$cur."'>".$comments[$childPos]."</p><div id='controls".$cur."' class='none'>";
				else
				{
					$op = $op."<div id='postedComment".$cur."' reply-level='".$noOfBQ."'><p><i>".$usernames[$childPos]." says: </i></p><p id='comm".$cur."'>".$comments[$childPos]."</p><div id='controls".$cur."' class='none'><span><a href='#' id='rep".$cur."' onclick='fnRep(".$cur.")'>Reply</a></span>&nbsp;";
					if($u == $usernames[$childPos])
					{
						$op = $op."<span><a href='#' id='edt".$cur."' onclick='fnEd(".$cur.")'>Edit</a></span>&nbsp;<span><a href='#' id='del".$cur."' onclick='fnD(".$cur.")'>Delete</a></span>&nbsp;";
					}	
				}
				
				$op = $op."</div>";					
				while($noOfBQ > 0)
				{
					$op = $op."</blockquote>";
					$noOfBQ--;
				}		
				$rids[$childPos] = -1;
				$cids[$childPos] = -1;
			}
		}
		$op = $op."</div>";			
	}
	$op = $op."<p id='maxcid' hidden='true'>".$max."</p>";
	echo $op;

	function search($curCid,$arr)
	{
		$x = -1;
		if($curCid == 0)
			return $x;
		for($i=0;$i<count($arr);$i++)
		{
			if($curCid == $arr[$i])
			{
				return $i;
			}
		}
		return $x;
	}
	
	
?>