<div class="homeLatestContentContainer">
	<h1>Our Camper Travels</h1>
	<p>Find out where we are, or look back at where we've travelled in our camper</p>
</div>


<div class="homeLatest">
	<div class="gridContainerHome">
		<div class="boxNew box_<?php echo $i; ?>">
			
			<a href="<?php echo URL_ROOT; ?>blog/<?php echo $latestPosts[0]['slug']; ?>" class="">
				<?php if($latestPosts[0]['postImages']) { ?>
					<img src="<?php echo URL_ROOT; ?>images/<?php echo $latestPosts[0]['postImages'][0]['imageName']; ?>" alt="<?php echo $latestPosts[0]['postTitle']; ?>" style="border-radius:15px;" />
				<?php } ?>
				<h2><?php echo $latestPosts[0]['postLocation']; ?></h2>
				<?php echo $latestPosts[0]['postTitle']; ?> <?php echo date('Y', strtotime($latestPosts[0]['postDate'])); ?>
				<p><?php echo $latestPosts[0]['postBlurb']; ?>...[read more]</p>		
			</a>
			<a href="<?php echo URL_ROOT; ?>trip/<?php echo $latestPosts[0]['tripSlug']; ?>" class="viewAll">view all</a>
		</div>
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
		<div class="boxNew box_<?php echo $i; ?>">
			<a href="<?php echo URL_ROOT; ?>article/<?php echo $latestArticles[0]['slug']; ?>" class="">
				<?php if($latestArticles[0]['postImage']) { ?>
					<img src="<?php echo URL_ROOT; ?>images/article/<?php echo $latestArticles[0]['postImage']; ?>" alt="<?php echo $latestArticles[0]['postTitle']; ?>" style="border-radius:15px;" />
				<?php } ?>
				<h2><?php echo $latestArticles[0]['postTitle']; ?></h2>
				<?php echo date('D dS F Y', strtotime($latestArticles[0]['postDate'])); ?>
				<p><?php echo $latestArticles[0]['postBlurb']; ?>...[read more]</p>	
			</a>
			<a href="<?php echo URL_ROOT; ?>articles" class="viewAll">view all</a>
		</div>
	</div>
</div>
