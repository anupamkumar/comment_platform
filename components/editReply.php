<!-- Copyright 2014 Anupam Kumar

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License. -->
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
	// die('<script>alert("Error: '.mysqli_error($connection).'")</script>');
	die('error');
}
mysqli_close($connection);
?>