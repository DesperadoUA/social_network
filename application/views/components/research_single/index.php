<?php
/*
echo "<pre>";
var_dump($body);
echo "</pre>";
*/
?>
<section class="research_single">
	<div class="container">
		<h1 class="research_single_title"><?= $body['h1']; ?></h1>
		<div class="research_single_row">
			<?php
				if(!empty($body['protocol_name'])) {
					echo "<div class='research_single_item'>
							<div class='research_single_left'>
							".TRANSLATE['PROTOCOL_NAME'][LANG]."
							</div>
							<div class='research_single_right'>
								{$body['protocol_name']}
							</div>
							<div class='research_single_line'></div>
						</div>";
				}
			?>
			<?php
			if(!empty($body['therapeutic_area'])) {
				echo "<div class='research_single_item'>
							<div class='research_single_left'>
							".TRANSLATE['THERAPEUTIC_AREA'][LANG]."
							</div>
							<div class='research_single_right'>
								{$body['therapeutic_area']}
							</div>
							<div class='research_single_line'></div>
						</div>";
			}
			?>
			<?php
				echo "<div class='research_single_item'>
							<div class='research_single_left'>
							".TRANSLATE['START_END_DATE'][LANG]."
							</div>
							<div class='research_single_right'>
								{$body['data_start']} - {$body['data_finish']}
							</div>
							<div class='research_single_line'></div>
						</div>";
			?>
			<?php
			if(!empty($body['name_organization'])) {
				echo "<div class='research_single_item'>
							<div class='research_single_left'>
							".TRANSLATE['NAME_ORGANIZATION_CONDUCTING'][LANG]."
							</div>
							<div class='research_single_right'>
								{$body['name_organization']}
							</div>
							<div class='research_single_line'></div>
						</div>";
			}
			?>
			<?php
			if(!empty($body['city'])) {
				echo "<div class='research_single_item'>
							<div class='research_single_left'>
							".TRANSLATE['CITY'][LANG]."
							</div>
							<div class='research_single_right'>
								{$body['city']}
							</div>
							<div class='research_single_line'></div>
						</div>";
			}
			?>
			<?php
				if(!empty($body['additional_fields'])) {
					foreach ($body['additional_fields'] as $item) {
						echo "<div class='research_single_item'>
							<div class='research_single_left'>
								{$item['value_1']}
							</div>
							<div class='research_single_right'>
								{$item['value_2']}
							</div>
							<div class='research_single_line'></div>
						</div>";
					}
				}
			?>
		</div>
	</div>
</section>