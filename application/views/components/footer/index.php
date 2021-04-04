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
</body>
</html>