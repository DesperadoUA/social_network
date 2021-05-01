<section class="advantages"> 
    <div class="container">
        <div class="row_advantages">
            <?php
                foreach ($settings['pluses']['images_and_text'] as $item){
                    echo "<div class='advantages_item'>
                            <img src='{$item[SRC]}'
                            title='{$item['title']}' 
                            loading='lazy' 
                            alt='{$item['alt']}' 
                            class='advantages_icon'>
                            <p class='advantages_desc'>
                               {$item['description']}
                            </p>
                          </div>";
                }
            ?>
        </div>
    </div>
</section>