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

