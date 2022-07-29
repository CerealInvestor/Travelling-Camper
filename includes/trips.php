<h1 style="padding-top: 0;">Our Trips</h1>
<div id="map_canvas" style="width: 100%; height: 350px;"></div>
<div id="trip" data-trips="true"></div>

<div class="gridContainer">
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