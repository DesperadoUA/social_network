<section class="for_specialist">
	<img src="<?= $options['for-specialist']['image'][SRC]; ?>" class="for_specialist_img">
	<div class="container for_specialist_row">
		<div class="for_specialist_left"></div>
		<div class="for_specialist_right">
			<h1 class="for_specialist_title"><?= $body['content']['h1']; ?></h1>
			<?php
				if(!empty($settings['for-specialist']['images_and_text'])) {
					foreach ($settings['for-specialist']['images_and_text'] as $item) {
						echo "<div class='for_specialist_item'>
								<div class='for_specialist_item_left'>
									<img src='{$item['src']}' >
								</div>
								<div class='for_specialist_item_right'>
									{$item['description']}
								</div>
							  </div>";
					}
				}
			?>
		</div>
	</div>
</section>