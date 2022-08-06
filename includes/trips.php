<h1 style="padding-top: 0;">Our Trips</h1>

<div class="gridContainer" style="padding-bottom: 2em;">
<?php
	/* Lists all the trips we have been on */
	if($trips)
	{
		foreach($trips as $trip)
		{
?>
			<a class="boxLink" href="<?php echo URL_ROOT; ?>trip/<?php echo $trip['tripSlug']; ?>">	
				<div class="box">
					<p style="font-weight: bold;"><?php echo $trip['tripName']; ?></p>
				</div>
			</a>
<?php
		}
	}	
?>
</div>
<div id="map_canvas" style="width: 100%; height: 350px;"></div>
<div id="trip" data-trips="true"></div>
<p style="font-size: 0.8em; font-style: italic;">Click a marker to view post.</p>