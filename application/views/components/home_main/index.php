<section class="home_main">
	<img src="<?= $options['woman']['image'][SRC]; ?>" class="women">
	<div class="container">
		<div class="row_home_main">
			<div class="home_main_left">
				<h1><?= $body['content']['h1']; ?></h1>
				<p class="home_main_des">
					<?= $body['short_desc']; ?>
				</p>
				<div class="row_home_main_buttons">
					<a href="<?= $options['google_doc']['text'] ?>" target="_blank" class="home_main_btn_profile">
						<?= TRANSLATE['BTN_PROFILE'][LANG] ?>
					</a>
					<a class="home_main_btn_research" href="<?= TRANSLATE['RESEARCH_LINK'][LANG] ?>">
						<?= TRANSLATE['RESEARCH'][LANG] ?>
					</a>
				</div>
				<div class="row_home_main_items">
                    <?php
					 foreach ($settings['home_main_screen']['menu'] as $item) {
					     echo "<div class='home_main_item'>
                                <span>{$item['value_1']}</span>
                                <p class='home_main_item_desc'>
                                    {$item['value_2']}
                                </p>
                               </div>";
                     }
                    ?>
				</div>
			</div>
		</div>
	</div>
</section>