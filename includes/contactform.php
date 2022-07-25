<?php
	if(isset($_GET['product'])) {
		$link = "http://tcweb.works/product.php?product=" . $_GET['product'] . "&e=1#quote";
	} else {
		$link = 'http://tcweb.works/index.php?e=1#quote';
	}
?>
<!-- Contact Me -->
<section id="section-e" class="grid">
	<div class="content-wrapper" style="padding-top: 0px;">
		<a id="quote"></a>
		<h2 style="padding: 0em;">Contact Me/Get a Quote</h2>
		<?php
			if(isset($_GET['e'])) {
				echo 'Thank you for your enquiry, we will be in touch soon.';
			} else {
		?>						
				<div class="contact" style="padding-top: 1em;">
					<form action="includes/quotemail.php?p=" method="POST">
						<p>
							<label>First Name</label>
							<input type="text" name="firstname" />
						</p>
						<p>
							<label>Last Name</label>
							<input type="text" name="lastname" />
						</p>
						<p>
							<label>Telephone</label>
							<input type="tel" name="telephone" />
						</p>
						<p>
							<label>Reason for contact</label>
							<select name="reason">
								<option value="NA">Please Select</option>
								<option value="quote">Quote</option>
								<option value="question">Question</option>
								<option value="other">Other</option>
							</select>
						</p>
						<p>
							<label>Email</label>
							<input type="email" name="email" />
						</p>
						<p>
							<label>Confirm Email</label>
							<input type="email" name="confirmemail" />
						</p>
						<p class="full">
							<label>Message</label>
							<textarea name="message"></textarea>
						</p>
						<p class="third">					
							<button name="submit">Submit</button>
						</p>
						<input type="hidden" name="link" value="<?php echo $link; ?>" />
					</form>
				</div>
		<?php
			}
		?>
	</div>
</section>