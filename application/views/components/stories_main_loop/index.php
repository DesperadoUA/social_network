<section class="blog_main_loop">
	<div class="container">
		<h1 class="blog_main_loop_title"><?= $body['content']['h1']; ?></h1>
		<div class="blog_main_loop_row">
			<?php
                foreach ($posts as $item) {
                    echo "<div class='blog_main_loop_item'>
                            <div class='blog_main_loop_card_img'>
                                <img src='{$item['thumbnail']['src']}'>
                                <div class='blog_main_loop_card_date'>
                                    {$item['data_change']}
                                </div>
                                <div class='card_img_line'></div>
                            </div>
                            <div class='blog_main_loop_card_desc'>
                                <div>
                                    <a href='{$item['permalink']}' 
                                        class='blog_main_loop_card_permalink'>
                                        {$item['title']}
                                    </a>
                                    <p>{$item['short_desc']}</p>
                                </div>
                                <div class='blog_main_loop_action'>
                                    <a href='{$item['permalink']}' 
                                       class='blog_main_loop_card_permalink_button'>
                                       ".TRANSLATE['READ'][LANG]."
                                    </a>
                                </div>
                            </div>
                        </div>";
                }
            ?>
		</div>
	</div>
</section>