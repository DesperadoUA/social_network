<section class="research_main_screen clinic_main_screen">
	<div class="container">
		<div class="row_research">
			<div class="research_main_screen_left">
				<h1><?= $body['content']['h1']; ?></h1>
				<p class="research_main_screen_des">
					<?= $body['short_desc']; ?>
				</p>
				<div class="row_research_main_filters max_width_500">
					<div class="research_main_item border_gradient">
						<select class="js_search_clinic_region">
							<option><?= TRANSLATE['CHOOSE_REGION'][LANG]; ?></option>
							<?php
							    foreach ($filter['region'] as $item) echo "<option>{$item['value']}</option>";
							?>
						</select>
					</div>
					<div class="research_main_item border_gradient">
						<select class="js_search_clinic_city">
							<option><?= TRANSLATE['CHOOSE_CITY'][LANG]; ?></option>
							<?php
							    foreach ($filter['city'] as $item) echo "<option>{$item['value']}</option>";
							?>
						</select>
					</div>
					<div class="research_main_item border_gradient">
						<input placeholder="<?= TRANSLATE['KEYWORD'][LANG]; ?>"
                               class="js_search_clinic_keyword"
                        />
					</div>
					<div class="research_main_item border_gradient">
						<select class="js_search_clinic_therapeutic_area">
							<option><?= TRANSLATE['THERAPEUTIC_AREA'][LANG]; ?></option>
							<?php
							    foreach ($filter['therapeutic_area'] as $item) echo "<option>{$item['value']}</option>";
							?>
						</select>
					</div>
				</div>
                <div class="row_research_main_buttons">
                    <button class="search_btn js_search_clinic"><?= TRANSLATE['SEARCH'][LANG]; ?></button>
                </div>
				<div class="research_main_total_count">
                    <?= TRANSLATE['FOUND'][LANG]; ?> <span class="js_search_clinic_total"><?= $total_posts; ?></span> <?= TRANSLATE['MEDICAL_INSTITUTIONS'][LANG]; ?>
				</div>
			</div>
		</div>
	</div>
</section>