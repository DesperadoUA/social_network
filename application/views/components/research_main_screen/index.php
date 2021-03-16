<section class="research_main_screen">
	<div class="container">
		<div class="row_research">
			<div class="research_main_screen_left">
				<h1><?= $body['h1']; ?></h1>
				<p class="research_main_screen_des">
					<?= $body['short_desc']; ?>
				</p>
				<div class="row_research_main_filters">
					<div class="research_main_item border_gradient">
						<select class="js_search_research_region">
							<option><?= TRANSLATE['CHOOSE_REGION'][LANG]; ?></option>
							<?php
                                foreach($filter['region'] as $item) {
                                    if(!empty($item['region'])) echo "<option>{$item['region']}</option>";
                                }
                            ?>
						</select>
					</div>
					<div class="research_main_item border_gradient">
						<select class="js_search_research_city">
							<option><?= TRANSLATE['CHOOSE_CITY'][LANG]; ?></option>
							<?php
							foreach($filter['city'] as $item) {
								if(!empty($item['city'])) echo "<option>{$item['city']}</option>";
							}
							?>
						</select>
					</div>
					<div class="research_main_item border_gradient">
						<input placeholder="<?= TRANSLATE['KEYWORD'][LANG]; ?>"
                               class="js_search_research_keyword"
                        />
					</div>
					<div class="research_main_item border_gradient">
						<select class="js_search_research_disease">
							<option><?= TRANSLATE['DISEASE'][LANG]; ?></option>
							<?php
							foreach($filter['disease'] as $item) {
								if(!empty($item['disease'])) echo "<option>{$item['disease']}</option>";
							}
							?>
						</select>
					</div>
                    <div class="research_main_item border_gradient">
                        <select class="js_search_research_held">
                            <option><?= TRANSLATE['HELD'][LANG]; ?></option>
                            <option><?= TRANSLATE['COMPLETED'][LANG]; ?></option>
                        </select>
                    </div>
					<div class="research_main_item border_gradient">
                        <select class="js_search_research_clinic">
                            <option value=""><?= TRANSLATE['NAME_MEDICAL_INSTITUTION'][LANG]; ?></option>
							<?php
							foreach($filter['clinics'] as $item) {
								if(!empty($item)) echo "<option value='{$item['id']}'>{$item['title']}</option>";
							}
							?>
                        </select>
					</div>
					<div class="research_main_item research_main_item_checkbox">
                        <div class="research_main_item_checkbox_wrapper">
                            <div class="custom_checkbox border_gradient">
                                <span class="checkbox_body active_checkbox js_open_research js_search_checkbox_open"
                                    data-value="<?= TRANSLATE['OPEN_SET'][LANG]; ?>"
                                ></span>
                            </div> <?= TRANSLATE['OPEN_SET'][LANG]; ?>
                            </div>
                        <div class="research_main_item_checkbox_wrapper">
                            <div class="custom_checkbox border_gradient">
                                <span class="checkbox_body js_search_checkbox_open"
                                      data-value="<?= TRANSLATE['HEALTHY_VOLUNTEERS'][LANG]; ?>"
                                ></span>
                            </div> <?= TRANSLATE['HEALTHY_VOLUNTEERS'][LANG]; ?>
                        </div>
					</div>
				</div>
                <div class="row_research_main_buttons">
                    <button class="search_btn js_search_research"><?= TRANSLATE['SEARCH'][LANG]; ?></button>
                    <span class="clear_filters">
                        <?= TRANSLATE['CLEAR_FILTERS'][LANG]; ?>
                    </span>
                </div>
                <div class="research_main_total_count">
					<?= TRANSLATE['FOUND'][LANG]; ?> <span class="js_search_research_total"><?= $body['total_posts']; ?></span> <?= TRANSLATE['RESEARCHES'][LANG]; ?>
                </div>
			</div>
		</div>
	</div>
</section>