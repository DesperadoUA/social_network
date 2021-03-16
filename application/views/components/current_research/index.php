<section class="current_research">
    <div class="container">
        <div class="current_research_title">
            <?= TRANSLATE['CURRENT_RESEARCH'][LANG]; ?>
        </div>
        <div class="row_current_research">
            <?php
			foreach ($research as $item) {
			    echo "<div class='current_research_item'>
                        <div class='card_img'>
                            <img src='{$item['thumbnail'][SRC]}' />
                            <div class='card_img_line'></div>
                        </div>
                        <div class='card_desc'>
                            <a href='/{$item['slug']}/{$item['permalink']}' class='card_permalink'>
                            {$item['title']}
                            </a>
                        </div>
                    </div>";
            }
            ?>
        </div>
    </div>
</section>