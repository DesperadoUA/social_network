<?php
/*
echo "<pre>";
var_dump($body);
echo "</pre>";
*/
?>
<section class="blog_single_top">
	<div class="container">
		<h1 class="blog_single_top_title"><?= $body['h1']; ?></h1>
		<div class="blog_single_top_row">
			<div class="blog_single_top_img">
				<img src="<?= $body['thumbnail']['src']; ?>" />
				<div class="card_img_line"></div>
				<div class="blog_main_loop_card_date">
					<?= $body['data_change']; ?>
				</div>
			</div>
			<div class="blog_single_top_text style_content">
				<?= $body['content']; ?>
			</div>
		</div>
	</div>
<?php if(!empty($body['content_2'])) include ROOT_COMPONENTS . 'content/content_2.php'; ?>
</section>