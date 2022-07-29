<div class="backLink">
	<a href="<?php echo URL_ROOT; ?>articles"> back to articles</a>
</div>
<h1 style="padding-top: 0;"><?php echo $article['postTitle']; ?></h1>
<h2>Posted on <?php echo date("d/m/Y", strtotime($article['postDate'])); ?></h2>

<div class="blogImage">
	<img src="<?php echo URL_ROOT; ?>images/<?php echo $pageType; ?>/<?php echo $article['postImage']; ?>" alt="<?php echo $article['postTitle']; ?>" />
</div>

<?php echo $article['postContent']; ?>