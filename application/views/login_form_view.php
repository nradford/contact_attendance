<form action="<?print base_url();?>login/login_submit" method="post" class="form-signin">
	<input type="email" name="email" value="<?php if($this->session->flashdata('email') != "")print $this->session->flashdata('email');?>" id="email" class="input-block-level" placeholder="Email" autocorrect="off" autocapitalize="off" />
	<input type="password" name="password" value="" id="password" class="input-block-level" placeholder="Password" />

	<p>
        <input type="submit" name="login_btn" value="Log In" id="login_btn" class="btn btn-large btn-primary" />
    </p>
</form>

<script>
	$(document).ready(function(){
		$('#email').focus();
	});//end document.ready
</script>