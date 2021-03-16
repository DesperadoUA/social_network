<section class="cities for_specialist_cities">
	<div class="container">
		<div class="cities_title for_specialist_cities_title">
			<?= $body['short_desc']; ?>
		</div>
		<div class="cities_left">
			<div class="cities_loop">
			<?php
                foreach($settings['cities']['menu'] as $item) {
                    echo "<div class='cities_item'>
                            <a href='{$item['value_1']}' class='cities_item_link'>
                                {$item['value_2']}
                            </a>
                        </div>";
                }
            ?>
			</div>
			<div class="cities_all">
				<a class="cities_all_link" href="<?= TRANSLATE['RESEARCH_LINK'][LANG]; ?>" >
					<?= TRANSLATE['SEE_ALL_CITIES'][LANG]; ?>
				</a>
			</div>
		</div>
	</div>
</section>
