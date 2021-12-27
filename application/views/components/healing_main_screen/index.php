<section class="healing_main_screen">
	<div class="container">
		<div class="row_healing">
			<div class="healing_main_screen_left">
				<h1><?= $body['content']['h1']; ?></h1>
				<p class="healing_main_screen_des">
					<?= $body['short_desc']; ?>
				</p>
				<div class="row_healing_main_filters">
					<div class="healing_main_item border_gradient">
						<input placeholder="Search" class="js_search_healing_keyword">
					</div>
				</div>
				<div class="row_healing_main_buttons">
                    <button class="search_btn js_search_healing"><?= TRANSLATE['SEARCH'][LANG]; ?></button>
                </div>
			</div>
		</div>
	</div>
</section>