<div id="homeContent">
	<div class="contentBlog">
		<div class="flex-content">
			<?php
				if(!$postId) {
					if($pageType == 'blog'){
			?>
						<div class="flex-content">
							<h1>Travelling Campervan Blog</h1>
							<h2>Total miles travelled so far: <?php echo $latestMiles; ?></h2>
							<div id="map_canvas" style="width: 100%; height: 500px;"></div>

							<div id="blogContent"></div>
							<p>&nbsp;</p>
							<h2>Posts</h2>
						</div>
						<div class="gridContainer">
			<?php
								$item_type = null;
								foreach($list as $item) {

			?>	
			<?php								
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
			<?php				} ?>
							</div>
			<?php
					} 
					else 
					{
			?>
						<div class="flex-content">
							<h1>Articles</h1>
							<div class="gridContainer">
			<?php
								
								foreach($list as $item) 
								{	
									echo '<a class="boxLink" href="' . URL_ROOT . 'article/' . $item['slug'] . '">';			
										echo '<div class="box">';
											echo '<img src="' . URL_ROOT . 'images/article/' . $item['postImage'] . '" alt=""/>';	
											echo $item['postTitle'];							
										echo '</div>';
									echo '</a>';
								}
								
					}
				?>
							</div>
						</div>
			<?php
				} 
				else 
				{
			?>
					<div class="recipeIngredientsContainer">
							<div style="float: right;">
								<?php if($pageType == 'blog'){ ?>
									<?php if($prevPost || $prevPost <> 0){ ?>
										
										<a href="<?php echo URL_ROOT; ?>blog/<?php echo $prevPost; ?>">prev</a> | 
									<?php } ?>
									<?php if($nextPost || $nextPost <> 0) { ?>
										<a href="<?php echo URL_ROOT; ?>blog/<?php echo $nextPost; ?>">next</a> | 
									<?php } ?>

									<a href="<?php echo URL_ROOT; ?>blog"> back to posts</a>
								<?php } else { ?>
									<a href="<?php echo URL_ROOT; ?>articles"> back to articles</a>
								<?php } ?>

							
						</div>						
					</div>
					<?php if($pageType == 'article'){ ?>
						<h1 style="padding-top: 0;"><?php echo $post['postTitle']; ?></h1>
					<?php } else { ?>
						<h2 style="padding-top: 0;"><?php echo $post['postTitle']; ?></h2>
					<?php } ?>

					<?php  
						if($pageType == 'article')
						{
					?>
					<!--<h3><?php //echo $list[0]['postDate']; ?></h3>--> 
					<h2>Posted on <?php echo date("d/m/Y", strtotime($post['postDate'])); ?></h2>

					<?php
						}
					?>

					<?php  
						if($post['postImage'] && $pageType == 'article'){
					?>
						<div class="blogImage">
							<img src="<?php echo URL_ROOT; ?>images/<?php echo $pageType; ?>/<?php echo $post['postImage']; ?>" alt="<?php echo $post['postTitle']; ?>" />
						</div>
					<?php
						}
					?>

					<?php  
						if($post['postLocation']){
					?>
					<!--<h3><?php //echo $list[0]['postDate']; ?></h3>--> 
					<h1><?php echo $post['postLocation']; ?></h1>

					<?php
						}
					?>

					<?php echo $post['postContent']; ?>

					<?php if(isset($post['postMiles']) && $post['postMiles'] <> 0) { ?>
						<!--<h2>Total miles travelled so far: <?php// echo $post['postMiles']; ?></h2>-->
					<?php } ?>
					<?php
						if($post['postImages']) {
					?>
					<h2>Travel Photos</h2>
						<!--
						<p>&nbsp;</p>
						<div class="blogImage">
							<img src="images/<?php //echo $pageType; ?>/<?php //echo $post['postImage']; ?>" alt="<?php //echo $post['postTitle']; ?>" />
						</div>-->


						<div class="container">
							<a class="prev" onclick="plusSlides(-1)"><</a>
							<a class="next" onclick="plusSlides(1)">></a>
							<?php 
								$i = 1;
								foreach($post['postImages'] as $image) { ?>
									<div class="mySlides">
										<!--<div class="numbertext"><?php //echo $i; ?> / 6</div>-->
										<img src="<?php echo URL_ROOT; ?>images/blog/<?php echo $image['imageName']; ?>" alt="<?php echo $image['imageTitle']; ?>" style="width:100%" />
								</div>
							<?php 
									$i++;
								} ?>
						</div>

						<div class="caption-container">
							<?php if($image['imageTitle']){  ?>
								<p id="caption"><?php echo $image['imageTitle']; ?></p>
							<?php } ?>
						</div>

						<div class="row">
							<?php 
								$i = 1;
								foreach($post['postImages'] as $image) { ?>
									<div class="column">
										<img src="<?php echo URL_ROOT; ?>images/blog/<?php echo $image['imageName']; ?>" alt="<?php echo $image['imageTitle']; ?>" class="demo cursor" style="width:100%;" onclick="currentSlide(<?php echo $i; ?>)" />
									</div>
							<?php 
									$i++;
								} ?>		
						</div>					
					<?php
						}
					?>
					<?php include('comments.php'); ?>
					<p>&nbsp;</p>
			<?php
				}	
			?>
		</div>
	</div>
</div>
