<?php
	if(!empty($body['relative_clinic'])) {
		echo "<section class='relative_clinics'>
 				<div class='container'>
 					<div class='relative_clinics_title'>
 						".TRANSLATE['WHERE_RESEARCH'][LANG]."
					</div>";
		foreach ($body['relative_clinic'] as $item) {
			if(!empty($item['title'])) {
				echo "<div class='relative_clinic_item'>
						<div class='relative_clinic_item_left'>
						   ".TRANSLATE['NAME_MEDICAL_INSTITUTION'][LANG]."
						</div>
						<div class='relative_clinic_item_right'>
						   <a href='{$item['permalink']}' class='relative_clinic_permalink'>{$item['title']}</a>
						</div>
				      </div>";
			}
			if(!empty($item['region'])) {
				echo "<div class='relative_clinic_item'>
						<div class='relative_clinic_item_left'>
						   ".TRANSLATE['REGION'][LANG]."
						</div>
						<div class='relative_clinic_item_right'>
						   {$item['region']}
						</div>
				      </div>";
			}
			if(!empty($item['city'])) {
				echo "<div class='relative_clinic_item'>
						<div class='relative_clinic_item_left'>
						   ".TRANSLATE['CITY'][LANG]."
						</div>
						<div class='relative_clinic_item_right'>
						   {$item['city']}
						</div>
				      </div>";
			}
			if(!empty($item['researchers'])) {
				echo "<div class='relative_clinic_item'>
						<div class='relative_clinic_item_left'>
						   ".TRANSLATE['RESEARCHERS'][LANG]."
						</div>
						<div class='relative_clinic_item_right'>
						   {$item['researchers']}
						</div>
				      </div>";
			}
			if(!empty($item['title'])) {
				echo "<div class='research_single_line'></div>";
			}
		}
		echo "</div>
              </section>";
	}
?>