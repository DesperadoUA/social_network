<?php
/*
echo "<pre>";
var_dump($filter['clinics']);
echo "</pre>";
*/
?>
<section class="doctors_main_screen">
	<div class="container">
		<div class="row_research">
			<div class="doctors_main_screen_left">
				<h1><?= $body['content']['h1']; ?></h1>
				<div class="row_doctors_main_filters">
					<div class="doctors_main_item border_gradient">
						<select class="js_search_doctors_region">
							<option><?= TRANSLATE['CHOOSE_REGION'][LANG]; ?></option>
							<?php
							foreach ($settings['region']['list'] as $item) {
								if(!empty($item['text'])) echo "<option>{$item['text']}</option>";
							}
							?>
						</select>
					</div>
					<div class="doctors_main_item border_gradient">
						<select class="js_search_doctors_city">
							<option><?= TRANSLATE['CHOOSE_CITY'][LANG]; ?></option>
							<?php
							foreach($filter['city'] as $item) {
							    echo "<option>{$item}</option>";
							}
							?>
						</select>
					</div>
					<div class="doctors_main_item border_gradient">
						<input placeholder="<?= TRANSLATE['NAME_RESEARCH'][LANG]; ?>"
                               class="js_search_doctors_name"
                        />
					</div>
					<div class="doctors_main_item border_gradient">
						<select class="js_search_doctors_specialization">
							<option><?= TRANSLATE['SPECIALIZATION'][LANG]; ?></option>
							<?php
							foreach($filter['specialization'] as $item) {
							    echo "<option>{$item}</option>";
							}
							?>
						</select>
					</div>
					<div class="doctors_main_item border_gradient">
						<input placeholder="<?= TRANSLATE['NAME_MEDICAL_INSTITUTION'][LANG]; ?>"
                               class="js_search_doctors_clinics"
                        />
					</div>
					<div class="doctors_main_item border_gradient">
						<input placeholder="<?= TRANSLATE['CR_EXPERIENCE'][LANG]; ?>"
                               class="js_search_doctors_cr_experience"
							   type="number"
                        />
					</div>
				</div>
                <div class="row_doctors_main_buttons">
                    <button class="search_btn js_search_doctors">
                        <?= TRANSLATE['SEARCH'][LANG]; ?>
                    </button>
                    <span class="clear_filters js_search_doctors_clear_filters">
                        <?= TRANSLATE['CLEAR_FILTERS'][LANG]; ?>
                    </span>
                </div>
                <div class="doctors_main_total_count">
					<?= TRANSLATE['FOUND'][LANG]; ?> <span class="js_search_doctors_total"><?= $body['total_posts']; ?></span> <?= TRANSLATE['RESEARCHER'][LANG]; ?>
                </div>
			</div>
		</div>
	</div>
</section>