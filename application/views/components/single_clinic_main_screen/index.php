<section class="single_clinic_main_screen">
	<div class="container">
		<div class="row_research">
			<div class="single_clinic_main_screen_title">
				<h1><?= $body['h1']; ?></h1>
			</div>
            <div class="single_clinic_main_item">
                <div class="single_clinic_main_item_left">
					<?= TRANSLATE['FULL_NAME'][LANG]; ?>
                </div>
                <div class="single_clinic_main_item_right">
					<?= $body['full_name']; ?>
                </div>
            </div>
            <div class="single_clinic_main_item">
                <div class="single_clinic_main_item_left">
                    <?= TRANSLATE['CITY'][LANG]; ?>
                </div>
                <div class="single_clinic_main_item_right">
                    <?= $body['city']; ?>
                </div>
            </div>
            <div class="single_clinic_main_item">
                <div class="single_clinic_main_item_left">
					<?= TRANSLATE['ADDRESS'][LANG]; ?>
                </div>
                <div class="single_clinic_main_item_right">
					<?= $body['address']; ?>
                </div>
            </div>
            <div class="single_clinic_main_item">
                <div class="single_clinic_main_item_left">
					<?= TRANSLATE['THERAPEUTIC_AREA'][LANG]; ?>
                </div>
                <div class="single_clinic_main_item_right">
					<?= $body['therapeutic_area']; ?>
                </div>
            </div>
            <div class="single_clinic_main_item">
                <div class="single_clinic_main_item_left">
					<?= TRANSLATE['CURRENT_CI'][LANG]; ?>
                </div>
                <div class="single_clinic_main_item_right">
					<?= $total_research; ?>
                </div>
            </div>
            <?php
            if(!empty($body['additional_fields'])) {
                foreach ($body['additional_fields'] as $item) {
                    echo "<div class='single_clinic_main_item'>
                            <div class='single_clinic_main_item_left'>
                                {$item['value_1']}
                            </div>
                            <div class='single_clinic_main_item_right'>
                                {$item['value_2']}
                            </div>
                          </div>";
                }
            }
            ?>
		</div>
	</div>
</section>