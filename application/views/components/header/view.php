<header>
	<div class="line"></div>
	<div class="container">
		<div class="row header_row">
			<div class="header_logo">
				<a href="<?= TRANSLATE['MAIN_LINK'][LANG]; ?>">
					<img src="<?= $options['logo']['image']['src']; ?>"
						 class="logo"
						 title="<?= $options['logo']['image']['title']; ?>"
						 alt="<?= $options['logo']['image']['alt']; ?>"
					>
				</a>
			</div>
			<div class="lang">
				<ul class="lang_list">
					<li class="lang_item">
						<a href='/'>ru</a>
					</li>
					<li class="lang_item">
						<a href='/ua/'>ua</a>
					</li>
				</ul>
			</div>
			<?php
			if(!empty($settings['header_menu']['menu'])) {
				echo "<nav>
				            <ul class='header_nav'>";
				foreach ($settings['header_menu']['menu'] as $item) {
					echo "<li>
                                <a href='{$item['value_1']}'>{$item['value_2']}</a>
                              </li>";
				}
				echo "</ul>
				            </nav>";
			}
			?>
			<div class="btn_profile_wrapper">
				<button class="btn_profile">
					<?= TRANSLATE['BTN_PROFILE'][LANG]; ?>
				</button>
			</div>
		</div>
	</div>
</header>