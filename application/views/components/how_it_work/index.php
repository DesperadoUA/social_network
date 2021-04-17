<section class="how_it_work">
        <img src='<?= $options['men']['image'][SRC]; ?>' class="how_it_work_men">
        <div class="container">
            <div class="row_how_it_work">
                <div class="how_it_work_left"></div>
                <div class="how_it_work_right">
                    <div class="how_it_work_title">
                        <?= TRANSLATE['HOW_IT_WORK'][LANG]; ?>
                    </div>
                    <div class="how_it_work_description">
                        <ul class="how_it_work_list">
                            <?php
							 foreach ($settings['how_it_work']['list'] as $item) {
							    echo "<li>{$item['text']}</li>";
                             }
                            ?>
                        </ul>
                          <!--  <button class="btn_watch_video">
                                <?=  TRANSLATE['WATCH_VIDEO'][LANG]; ?>
                            </button> -->
                    </div>
                </div>
            </div>
        </div>
</section>