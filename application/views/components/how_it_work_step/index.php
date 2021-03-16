<section class="how_it_work_step">
	<div class="container">
		<div class="how_it_work_step_row">
			<?php
				$counter = 1;
				foreach ($settings['how_it_work_step']['list'] as $item) {
					echo "<div class='how_it_work_step_item'>
							<div class='how_it_work_step_title gradient-text'>{$counter}";
					echo TRANSLATE['STEP'][LANG];
					echo "</div>
							<div class='how_it_work_step_desc'>
								{$item['text']}
							</div>
						</div>";
					$counter++;
				}
			?>
		</div>
	</div>
</section>