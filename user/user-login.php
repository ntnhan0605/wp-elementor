<?php 
/*
*
*	Template Name: User login
*	Template Post Type: page
*/
 ?>
 <?php
if (is_user_logged_in()) {
	wp_redirect( './user-profile/' );
} else {
	echo 'message';
}


  ?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<form name="loginform" id="loginform">
	<p class="login-username">
		<label for="user_login">Username or Email Address</label>
		<input type="text" name="log" id="user_login" class="input" value="" size="20">
	</p>
	<p class="login-password">
		<label for="user_pass">Password</label>
		<input type="password" name="pwd" id="user_pass" class="input" value="" size="20">
	</p>
	<p class="login-remember"><label><input name="rememberme" type="checkbox" id="rememberme" value="forever"> Remember Me</label></p>
	<p class="login-submit">
		<input type="submit" name="wp-submit" id="wp-submit" class="button button-primary" value="Log In">

		<input type="hidden" name="redirect_to" value="http://localhost/wp-git/user-profile/">
	</p>
</form>

<script>
	
	jQuery(document).ready(function($) {
		var $form = $('[name="loginform"]');
		$form.submit(function(e) {
			return false;
		});
		$form.each(function(index, el) {
			$(el).submit(function() {
				$.ajax({
					url: '<?= admin_url( 'admin-ajax.php' ) ?>',
					type: 'POST',
					dataType: 'json',
					data: {
						action: 'loginuser',
						user: {
							log: $(el).find('[name="log"]').val(),
							pwd: $(el).find('[name="pwd"]').val(),
							rememberme: $(el).find('[name="rememberme"]').val(),
							redirect_to: $(el).find('[name="redirect_to"]').val()
						}
					},
				})
				.done(function(r) {
					if (r === true) {
						window.location.href = $(el).find('[name="redirect_to"]').val();
					}
				})
				.fail(function() {
					console.log("error");
				})
				.always(function() {
					console.log("complete");
				});
				
			});
		});
	});
</script>