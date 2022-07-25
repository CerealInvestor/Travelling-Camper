<div class="activity">
	<h2>Recent updates</h2>
	<?php foreach($latestActivity as $activity) { ?>
		<div>
			<div class="link">
				<a href="<?php echo URL_ROOT . $activity['activityLink']; ?>">view</a>
			</div>
			<div>
				<?php echo $activity['activityTitle'] ?>
			</div>
		</div>
	<?php } ?>
</div>