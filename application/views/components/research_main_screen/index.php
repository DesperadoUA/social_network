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
							foreach ($settings['region']['list'] as $item) {
								if(!empty($item['text'])) echo "<option>{$item['text']}</option>";
							}
							?>
						</select>
					</div>
					<div class="research_main_item border_gradient">
						<select class="js_search_research_city">
							<option><?= TRANSLATE['CHOOSE_CITY'][LANG]; ?></option>
							<?php
							foreach($filter['city'] as $item) {
							    echo "<option>{$item}</option>";
							}
							?>
						</select>
					</div>
                    <div class="research_main_item border_gradient">
                        <select class="js_search_research_therapeutic_area">
                            <option><?= TRANSLATE['THERAPEUTIC_AREA'][LANG]; ?></option>
							<?php
							foreach ($settings['therapeutic_area']['list'] as $item) {
								if(!empty($item['text'])) echo "<option>{$item['text']}</option>";
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
							foreach ($settings['disease']['list'] as $item) {
								if(!empty($item['text'])) echo "<option>{$item['text']}</option>";
							}
							?>
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
                                <span class="checkbox_body active_checkbox js_paid_research js_search_checkbox_paid"
                                    data-value="1"
                                ></span>
                            </div> <?= TRANSLATE['PAID'][LANG]; ?>
                            </div>
                        <div class="research_main_item_checkbox_wrapper">
                            <div class="custom_checkbox border_gradient">
                                <span class="checkbox_body js_search_checkbox_paid"
                                      data-value="0"
                                ></span>
                            </div> <?= TRANSLATE['FREE'][LANG]; ?>
                        </div>
					</div>
				</div>
                <div class="row_research_main_buttons">
                    <button class="search_btn js_search_research">
                        <?= TRANSLATE['SEARCH'][LANG]; ?>
                    </button>
                    <span class="clear_filters">
                        <?= TRANSLATE['CLEAR_FILTERS'][LANG]; ?>
                    </span>
                    <button class="search_btn analyzes_btn js_form_analyzes">
                        <?= TRANSLATE['BTN_ANALYZES'][LANG]; ?>
                    </button>
                </div>
                <div class="research_main_total_count">
					<?= TRANSLATE['FOUND'][LANG]; ?> <span class="js_search_research_total"><?= $body['total_posts']; ?></span> <?= TRANSLATE['RESEARCHES'][LANG]; ?>
                </div>
			</div>
		</div>
	</div>
</section>