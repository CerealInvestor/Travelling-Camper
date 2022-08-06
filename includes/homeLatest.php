<div class="homeLatestContentContainer">
	<h1>Our Camper Travels</h1>
	<p>Find out where we are, or look back at where we've travelled in our camper</p>
</div>


<div class="homeLatest">
	<div class="gridContainerHome">
		<?php 
			$i = 1;
			foreach($latestPosts as $latest) { 
		?>

				<div class="boxNew box_<?php echo $i; ?>">
					
					<a href="<?php echo URL_ROOT; ?>blog/<?php echo $latest['slug']; ?>" class="">
						<?php if($latest['postImages']) { ?>
							<img src="<?php echo URL_ROOT; ?>images/<?php echo $latest['postImages'][0]['imageName']; ?>" alt="<?php echo $latest['postTitle']; ?>" style="border-radius:15px;" />
						<?php } ?>
						<h2><?php echo $latest['postLocation']; ?></h2>
						<?php echo $latest['postTitle']; ?> <?php echo date('Y', strtotime($latest['postDate'])); ?>
						<p><?php echo $latest['postBlurb']; ?>...[read more]</p>		
					</a>
				</div>
		<?php
				$i++; 
			} 
		?>
		<a href="<?php echo URL_ROOT; ?>trip/<?php echo $latest['tripSlug']; ?>" class="viewAll">view all</a>
	</div>
</div>
		
<!--<div id="homeContent">
	<div class="contentHome">
		
	</div>
</div>-->
<div class="homeLatestContentContainerEssential">
	<h1>Travelling Essentials</h1>
		<p style="text-align: left;">We've put together some essential travelling information you won't want to miss</p>
</div>
<div class="homeLatest">
	<div class="gridContainerHome">
		<?php 
			$i = 1;
			foreach($latestArticles as $latest) { 
		?>

				<div class="boxNew box_<?php echo $i; ?>">
					<a href="<?php echo URL_ROOT; ?>article/<?php echo $latest['slug']; ?>" class="">
						<?php if($latest['postImage']) { ?>
							<img src="<?php echo URL_ROOT; ?>images/article/<?php echo $latest['postImage']; ?>" alt="<?php echo $latest['postTitle']; ?>" style="border-radius:15px;" />
						<?php } ?>
						<h2><?php echo $latest['postTitle']; ?></h2>
						<?php echo date('D dS F Y', strtotime($latest['postDate'])); ?>
						<p><?php echo $latest['postBlurb']; ?>...[read more]</p>	
					</a>
				</div>
		<?php
				$i++; 
			} 
		?>
		<a href="<?php echo URL_ROOT; ?>articles" class="viewAll">view all</a>
	</div>
</div>
