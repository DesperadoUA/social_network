<header class="header overflow_hidden">
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
			<div class="burger">
				<img src="/uploads/burger_close.png" class="burger_img"/>
			</div>
			<div class="mobile_menu">
                <?php
				if(!empty($body['translate'])) {?>
				  <div class="lang">
					<ul class="lang_list">
						<li class="lang_item">
                          <?php  if(LANG === 'ru') {
                            echo "<a href='{$body['permalink']}'>ru</a>";
                            } else {
                              if(!empty($body['translate'])){
								  echo "<a href='{$body['translate']}'>ru</a>";
                              }
                            }
                            ?>
                    </li>
                    <li class="lang_item">
                        <?php  if(LANG === 'ua') {
                            echo "<a href='{$body['permalink']}'>ua</a>";
                        } else {
                            if(!empty($body['translate'])){
                                echo "<a href='{$body['translate']}'>ua</a>";
                            }
                        }
                        ?>
                    </li>
                    </ul>
                  </div>
             <?php   } ?>
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
                <?php
                    if(!empty($options['phone']['text'])) {
                        echo "<a href='tel:+{$options['phone']['text']}' class='mobile_phone'>
                                 {$options['phone']['text']}
                              </a>";
                        echo "<p class='schedule'>".TRANSLATE['RECEIVING_CALLS'][LANG]."</p>";
                        echo "<p class='schedule'>".$settings['sheduler']['text']."</p>";
                    }
                ?>
                <div class="mobile_social">
                    <?php
                        if(!empty($options['telegram']['text'])) {
                            echo "<a href='https://telegram.im/{$options['telegram']['text']}'
                                     target='_blank' class=''>
                                     <img src='/uploads/telega.png' class=''>
                                  </a>";
                        }
                    ?>
					<?php
					if(!empty($options['viber']['text'])) {
						echo "<a href='{$options['viber']['text']}'
                                     target='_blank' class=''>
                                     <img src='/uploads/viber.png' class=''>
                                  </a>";
					}
					?>

                </div>
			</div>
		</div>
	</div>
</header>