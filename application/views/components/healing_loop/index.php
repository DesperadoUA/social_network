<section class="healing_loop_wrapper">
    <?php
        foreach ($posts as  $item){
            echo "<div class='healing_loop_row'>
                    <div class='container'>
                        <article class='healing_loop_item'>
                            <div class='healing_loop_item_title'>
                               {$item['title']}
                            </div>";
            if(!empty($item['child'])) {
                echo "<div class='row_healing_loop_item_disease'>";
                foreach($item['child'] as $item) {
                    echo "<div class='item_disease'>
                            <a href='{$item['permalink']}'>{$item['title']}</a>
                          </div>";
                }
                echo "</div>";
            }
            echo                "</div>
                        </article>
                    </div>
                </div>";
        }
    ?>
</section>