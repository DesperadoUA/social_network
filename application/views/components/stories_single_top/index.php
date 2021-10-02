<section class="stories_single_top">
	<div class="container">
		<h1 class="stories_single_top_title"><?= $body['h1']; ?></h1>
		<div class="stories_single_top_row">
			<div class="stories_single_top_img">
				<img src="<?= $body['thumbnail']['src']; ?>" />
				<div class="card_img_line"></div>
			</div>
			<div class="stories_single_top_text style_content">
				<?= $body['content']; ?>
			</div>
		</div>
	</div>
<?php if(!empty($body['content_2'])) include ROOT_COMPONENTS . 'content/content_2.php'; ?>
</section>