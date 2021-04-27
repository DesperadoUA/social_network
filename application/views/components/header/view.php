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
			    <?php if(!empty($body['translate'])) include 'lang.php'; ?>
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
				<a href="<?= $options['google_doc']['text'] ?>" target="_blank" class="btn_profile">
					<?= TRANSLATE['BTN_PROFILE'][LANG]; ?>
				</a>
			</div>
		</div>
	</div>
</header>