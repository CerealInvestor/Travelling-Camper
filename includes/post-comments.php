
here
<a name="messageAdded"></a>
<!--<a name="messageAdded"></a>
<?php //if(isset($_GET['message']) && $_GET['message'] == 'added') { ?>
	<p class="messageAdded">Your message has been added.</p>
<?php //} ?>-->
<h2>Comment on this blog</h2>
<div class="singleMessage no-border" style="padding-top: 0em;">
<?php
	if($messages) {
		foreach($messages as $message) {
			echo '<div class="singleMessage" class="no-border">';
				echo '<h3>' . date('F j, Y, g:i a',strtotime($message['messageDate'])) . ' - by ' . $message['messageUser'] . '</h3>';
				echo $message['messageText'];
			echo '</div>';
		}
	} else {
		echo 'No comments yet...';
	}

?>
</div>

<?php 
	$disabled = true;
	if($disabled){
		echo '<p>Comments are currently disabled, please try back later.</p>';
	} else {
?>
<div class="singleMessage no-border" style="padding-top: 0em;">
	<form method="post" id="commentForm" action="<?php echo URL_ROOT; ?>_requests/addMessage.php?postId=<?php echo $postId; ?>">
		
		<p>
			<label for="messageUser">Name</label>
			<?php if(isset($_SESSION['errors']['messageUser'])) { echo '<span class="errorMessage">' . MESSAGE_USER_EMPTY_ERROR . '</span>'; } ?>
			<br />
			<input name="messageUser" type="text" value="" required />
		</p>

		<label for="messageText" style="vertical-align: top;">Comment</label>
		<?php if(isset($_SESSION['errors']['messageText'])) { echo '<span class="errorMessage">' . MESSAGE_EMPTY_ERROR . '</span>'; } ?>
		<br />
		<textarea name="messageText" class="messageText" required></textarea>

		<input name="pageType" type="hidden" value="<?php echo $pageType; ?>" />
		<input name="postId" type="hidden" value="<?php echo $postId; ?>" />
		<input name="slug" type="hidden" value="<?php echo $slug; ?>" />
		<input type="submit" value="Send" class="homeBtn" 
        data-sitekey="reCAPTCHA_site_key" 
        data-callback='onSubmit' 
        data-action='submit' />
	</form>
	<div style="clear: right;"></div>
</div>

<?php } ?>