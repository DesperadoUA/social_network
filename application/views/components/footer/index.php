<footer class="footer">
    <div class="container">
        <div class="row_footer">
            <div class="footer_item">
                <img src="<?= $options['logo']['image']['src']; ?>"
                     alt="<?= $options['logo']['image']['alt']; ?>"
                     title="<?= $options['logo']['image']['title']; ?>"
                     class="footer_logo">
                <?php
                    if(!empty($settings['text_footer']['text'])) {
                        echo "<p class='footer_desc'>
                                {$settings['text_footer']['text']}
                              </p>";
                    }
                ?>
                <?php
                    if(!empty($options['phone']['text'])) {
                        if(IS_MOBILE) {
                            echo "<p class='footer_phone mt-20'>
                                    <a href='tel:{$options['phone']['text']}'>{$options['phone']['text']}</a>
                                </p>";
                        }
                        else {
                            echo "<p class='footer_phone mt-20'>
                                {$options['phone']['text']}
                            </p>";
                        }
                    }
                ?>
                <?php
                    if(!empty($options['mail_footer']['text'])) {
                        echo "<p class='footer_phone mt-20'>
                                  E-mail: <a href='mailto:{$options['mail_footer']['text']}'>{$options['mail_footer']['text']}</a>
                                </p>";
                    }
                ?>
            </div>
            <div class="footer_item">
                <p><?= TRANSLATE['INFORMATION_FOR_PATIENTS'][LANG] ?></p>
                <?php
                    if(!empty($settings['footer_menu_1']['menu'])) {
                        echo "<nav>
                                <ul class='footer_menu'>";
                        foreach ($settings['footer_menu_1']['menu'] as $item) {
                            echo "<li class='footer_menu_item'>
                                    <a href='{$item['value_1']}' >{$item['value_2']}</a>
                                  </li>";
                        }
                        echo "</ul>
                              </nav>";
                    }
                ?>
            </div>
            <div class="footer_item">
                <p><?= TRANSLATE['LEGAL_INFORMATION'][LANG] ?></p>
                <?php
                    if(!empty($settings['footer_menu_2']['menu'])) {
						echo "<nav>
                                <ul class='footer_menu'>";
						foreach ($settings['footer_menu_2']['menu'] as $item) {
							echo "<li class='footer_menu_item'>
                                    <a href='{$item['value_1']}' >{$item['value_2']}</a>
                                  </li>";
						}
						echo "</ul>
                              </nav>";
                    }
                ?>
            </div>
        </div>
        <div class="footer_line"></div>
        <div class="footer_copyright">
            <div class="row_button">
                <a href="#" class="footer_add_profile">
					<?= TRANSLATE['ADD_PROFILE'][LANG] ?>
                </a>
                <a href="#" class="footer_add_enter">
					<?= TRANSLATE['ENTER'][LANG] ?>
                </a>
            </div>
            <?php
                if(!empty($settings['text_copyright']['text'])) {
                    echo "<p class='text-copyright'>
                             {$settings['text_copyright']['text']}
                         </p>";
                }
            ?>
        </div>
    </div>
    <?php
	include ROOT_COMPONENTS . 'forms/research.php';
	include ROOT_COMPONENTS . 'forms/participate.php';
    ?>
</footer>
<script src="/js/script.js" ></script>
<script async src="https://crm.streamtele.com/widget/getwidget/743fa3a587babcc683e775673ad9d339" type="text/javascript" charset="UTF-8"></script>
</body>
</html>