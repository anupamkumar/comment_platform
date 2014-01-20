	<?php echo "<p id='user' hidden='true'>".$_GET['name']."</p>"; ?>
	<div class="none">
		<textarea name="comment" id="comment" ></textarea><br/>
		<input type="button" name="submit" id="submit" value="Submit">
	</div>
	<div id='op' class="none"><div class="none" align="right"><h2>Loading comments</h2></div><img src="img/wait.gif" /></div>
	<script src="js/jquery.js"></script>
	<script src="js/app.js"></script>
