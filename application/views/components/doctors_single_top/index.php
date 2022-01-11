<?php
/*
echo "<pre>";
var_dump($body['research_completed']);
echo "</pre>";
*/
?>
<section class="doctors_single_top">
	<div class="container">
		<h1 class="doctors_single_top_title"><?= $body['h1']; ?></h1>
		<div class="doctors_single_top_row">
			<div class="doctors_single_top_img">
				<img src="<?= $body['thumbnail']['src']; ?>" />
				<div class="card_img_line"></div>
			</div>
			<div class="doctors_single_top_text style_content">
				<div class="doctors_single_characters_row">
					<div class="doctors_single_characters_left"><?= TRANSLATE['EDUCATION'][LANG] ?></div>
					<div class="doctors_single_characters_right"><?= $body['education']; ?></div>
				</div>
				<div class="doctors_single_characters_row">
					<div class="doctors_single_characters_left"><?= TRANSLATE['DEGREE'][LANG] ?></div>
					<div class="doctors_single_characters_right"><?= $body['degree']; ?></div>
				</div>
				<div class="doctors_single_characters_row">
					<div class="doctors_single_characters_left"><?= TRANSLATE['SPECIALIZATION'][LANG] ?></div>
					<div class="doctors_single_characters_right"><?= $body['specialization']; ?></div>
				</div>
				<div class="doctors_single_characters_row">
					<div class="doctors_single_characters_left"><?= TRANSLATE['MEDICAL_CENTER'][LANG] ?></div>
					<div class="doctors_single_characters_right"><?= $body['clinic']; ?></div>
				</div>
				<div class="doctors_single_characters_row">
					<div class="doctors_single_characters_left"><?= TRANSLATE['EXPERIENCE'][LANG] ?></div>
					<div class="doctors_single_characters_right"><?= $body['experience']; ?></div>
				</div>
				<div class="doctors_single_characters_row">
					<div class="doctors_single_characters_left"><?= TRANSLATE['CR_EXPERIENCE'][LANG] ?></div>
					<div class="doctors_single_characters_right"><?= $body['experience_cr']; ?></div>
				</div>
			</div>
		</div>
	</div>
</section>