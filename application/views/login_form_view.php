<form action="<?print base_url();?>login/login_submit" method="post">
	<div class="row">
		<label for="email">Email:</label>
		<input type="email" name="email" value="<?php print $this->input->post('username');?>" id="email" class="inputf ui-widget-content ui-corner-all" />
	</div>

	<div class="row">
		<label for="password">Password:</label>
		<input type="password" name="password" value="" id="password" class="inputf ui-widget-content ui-corner-all" />
	</div>

	<div class="row">
		<input type="submit" name="login_btn" value="Log In" id="login_btn" class="button ui-widget-content ui-corner-all ui-button ui-widget ui-state-default" />
	</div>
</form>

<script>
	$(document).ready(function(){
		$('#email').focus();
	});//end document.ready
</script>

<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>