<div class="commentArea">
	<a name="messageAdded"></a>
	<!--<a name="messageAdded"></a>
	<?php //if(isset($_GET['message']) && $_GET['message'] == 'added') { ?>
		<p class="messageAdded">Your message has been added.</p>
	<?php //} ?>-->
	<!-- List comments if they exit -->
	<div class="singleMessage no-border" style="padding-top: 0;">
	<?php
		if($messages) {
			echo '<h2>Comments</h2>';
			$i = 0;
			foreach($messages as $message) {

				$class = ($i%2 === 0) ? 'oddRow' : 'evenRow';

				echo '<div class="singleMessage no-border ' . $class . '">';
					echo '<h3>' . date('F j, Y, g:i a',strtotime($message['messageDate'])) . ' - by ' . $message['messageUser'] . '</h3>';
					echo $message['messageText'];
				echo '</div>';
				$i++;
			}
		} else {
			echo 'No comments yet...';
		}

	?>
	</div>
	<!-- If comments are disabled tell the user -->
	<?php 
		$disabled = false;
		if($disabled){
			echo '<p>Comments are currently disabled, please try back later.</p>';
		} else {
	?>

	<!-- Comment form to submit one  -->
	<div class="singleMessage no-border" style="padding-top: 0;">
		<h2>Comment on this <?php if($pageType == 'article') { echo 'article'; } else { echo 'blog'; } ?></h2>

		<form class="commentForm" method="post" action="<?php echo URL_ROOT; ?>_requests/addMessage.php?postId=<?php echo $postId; ?>">
			
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
			<input type="submit" value="Send" class="homeBtn" />
		</form>
		<div style="clear: right;"></div>
	</div>

	<?php } ?>
</div>
