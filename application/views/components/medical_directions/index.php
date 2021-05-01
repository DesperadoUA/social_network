<section class="medical_directions"> 
    <div class="container">
        <div class="current_research_title">
            <?= TRANSLATE['MEDICAL_DIRECTIONS'][LANG] ?>
        </div>
        <div class="row_medical_directions">
            <?php 
                foreach($settings['directions']['images_and_text'] as $item) {
                    echo "<div class='medical_directions_item'>
                            <div class='medical_directions_img'>
                                <img src='{$item[SRC]}' loading='lazy' />
                            </div>
                            <div class='medical_directions_desc'>
                                {$item['description']}
                            </div>
                        </div>";
                }
            ?>
        </div>
    </div>
</section>