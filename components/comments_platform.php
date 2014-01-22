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
<?php echo "<p id='user' hidden='true'>".$_GET['name']."</p>"; ?>
<div class="none">
	<textarea name="comment" id="comment" ></textarea><br/>
	<input type="button" name="submit" id="submit" value="Submit">
</div>
<div id='op' class="none"><div class="none" align="right"><h2>Loading comments</h2></div><img src="img/wait.gif" /></div>
<script src="js/jquery.js"></script>
<script src="js/comments_platform.js"></script>
