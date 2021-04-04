<div class="lang">
	<ul class="lang_list">
		<li class="lang_item">
			<?php
				if(LANG === 'ru') {
					echo "<a href='{$body['permalink']}'>ru</a>";
				} else {
					echo "<a href='{$body['translate']}'>ru</a>";
				}
			?>
		</li>
		<li class="lang_item">
			<?php
				if(LANG === 'ru') {
					echo "<a href='{$body['translate']}'>ua</a>";
				} else {
					echo "<a href='{$body['permalink']}'>ua</a>";
				}
			?>
		</li>
	</ul>
</div>