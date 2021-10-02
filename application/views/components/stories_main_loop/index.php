<section class="stories_main_loop">
	<div class="container">
		<div class="stories_main_loop_row">
			<?php
                foreach ($posts as $item) {
                    echo "<div class='stories_main_loop_item'>
                            <div class='stories_main_loop_card_img'>
                                <img src='{$item['thumbnail']['src']}'>
                                <div class='card_img_line'></div>
                            </div>
                            <div class='stories_main_loop_card_desc'>
                                <div>
                                    <a href='{$item['permalink']}' 
                                        class='stories_main_loop_card_permalink'>
                                        {$item['title']}
                                    </a>
                                    <p>{$item['short_desc']}</p>
                                </div>
                                <div class='stories_main_loop_action'>
                                    <a href='{$item['permalink']}' 
                                       class='stories_main_loop_card_permalink_button'>
                                       ".TRANSLATE['READ'][LANG]."
                                    </a>
                                </div>
                            </div>
                        </div>";
                }
            ?>
		</div>
        <?php
        if($body['total_posts'] > 6) {?>
        <div class="stories_main_loop_btn_wrapper">
            <button class="download_btn js_stories_download"
                    data-lang="<?= LANG ?>"
                    data-posts="<?= $body['posts_on_page'] ?>"
            >
                <?= TRANSLATE['DOWNLOAD_STORIES'][LANG]; ?>
            </button>
        </div>
        <?php } ?>
	</div>
</section>