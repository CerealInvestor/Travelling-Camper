<a name="messageAdded"></a>
<div class="homeLatestContentContainer">
	<div class="newsletter">
		<img src="<?php echo URL_ROOT; ?>images/newsletter.png" class="" />
		<h2>Newsletter</h2>
		<p>Sign up to our upcoming newsletter, to receive updates on future trips and exclusive travel tips </p>

		<form action="<?php echo URL_ROOT; ?>_requests/newsletterSignup.php" method="post" class="newsletterForm">
			<label for="newsletterEmail">Enter email:</label>
			<input type="email" name="newsletterEmail" required="required" /><br />
			<input type="submit" name="newsletterSignup" value="signup" class="newsletterSubmit" />
		</form>
	</div>
</div>