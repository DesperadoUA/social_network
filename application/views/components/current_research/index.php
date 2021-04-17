<section class="current_research">
    <div class="container">
        <div class="current_research_title">
            <?= TRANSLATE['CURRENT_RESEARCH'][LANG]; ?>
        </div>
        <div class="row_current_research">
            <?php
			foreach ($research as $item) {
			    echo "<div class='current_research_item'>
                        <div class='card_img'>";
                if(!empty($item['thumbnail'][SRC])) echo "<img src='{$item['thumbnail'][SRC]}' />";
                echo "<div class='card_img_line'></div>
                        </div>
                        <div class='card_desc'>
                            <a href='".LANG_PREFIX_LINK."/{$item['slug']}/{$item['permalink']}' class='card_permalink'>
                            {$item['title']}
                            </a>
                        </div>
                    </div>";
            }
            ?>
        </div>
        <div class='current_research_link'>
            <a href="<?= TRANSLATE['RESEARCH_LINK'][LANG]; ?>">
                <?= TRANSLATE['ALL_RESEARCH'][LANG] ?>
            </a>
        </div>
    </div>
</section>