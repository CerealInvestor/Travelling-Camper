<div class="backLink">
	<a href="<?php echo URL_ROOT; ?>trips"> back to trips</a>
</div>

<h1 style="padding-top: 0;"><?php echo $trip['tripName']; ?></h1>

<h2>Total miles travelled: <?php echo $trip['tripMiles']; ?></h2>

<p><?php echo $trip['tripDesc']; ?></p>

<div id="trip" data-trips="false" data-tripslug="<?php echo $tripSlug; ?>" data-triplat="<?php echo $tripLat; ?>" data-triplong="<?php echo $tripLong; ?>"></div>
<div id="map_canvas" style="width: 100%; height: 350px;"></div>

<div id="blogContent"></div>

<div class="gridContainer">
<?php
	$item_type = null;
	foreach($tripPosts as $item) 
	{
		/* Breaks uo the posts in to locations and add a heading */							
		if ($item_type != $item['postCountry']) 
		{
			$item_type = $item['postCountry'];
			echo '
				<div class="locationTitle">
					<h2>' . $item_type . '</h2>
				</div>
				';
		} 
?>	
		<a class="boxLink" href="<?php echo URL_ROOT; ?>blog/<?php echo $item['slug']; ?>">	
			<div class="box">
				<?php 
					if($item['postImages'])
					{
				?>
					<?php echo '<img src="' . URL_ROOT . 'images/blog/thumbs/tn_' . $item['postImages'][0]['imageName'] . '" />'; ?>
				<?php
					}
				?>
					<p style="font-size: 0.8em;"><?php echo $item['postTitle']; ?></p>
					<p style="font-weight: bold;"><?php echo $item['postLocation']; ?></p>
			</div>
		</a>
<?php				
	} 
?>


</div>