<section class="clinic_loop_wrapper">
    <?php
        foreach ($posts as  $item){
            echo "<div class='clinic_loop_row'>
                    <div class='container'>
                        <div class='clinic_loop_item'>
                            <div class='clinic_loop_item_title'>
                                <a href='{$item['permalink']}'>
                                {$item['full_name']}
                                </a>
                            </div>
                            <div class='clinic_loop_item_characters'>
                                <div class='clinic_loop_item_characters_left'>".TRANSLATE['CITY'][LANG]."</div>
                                <div class='clinic_loop_item_characters_right'>{$item['city']}</div>
                            </div>
                            <div class='clinic_loop_item_characters'>
                                <div class='clinic_loop_item_characters_left'>".TRANSLATE['ADDRESS'][LANG]."</div>
                                <div class='clinic_loop_item_characters_right'>{$item['address']}</div>
                            </div>
                            <div class='clinic_loop_item_characters'>
                                <div class='clinic_loop_item_characters_left'>".TRANSLATE['RESEARCHERS'][LANG]."</div>
                                <div class='clinic_loop_item_characters_right'>{$item['researchers']}</div>
                            </div>
                            <div class='clinic_loop_item_characters'>
                                <div class='clinic_loop_item_characters_left'>".TRANSLATE['CURRENT_CI'][LANG]."</div>
                                <div class='clinic_loop_item_characters_right'>{$item['total_active_research']}</div>
                            </div>
                            <div class='clinic_loop_item_characters'>
                                <div class='clinic_loop_item_characters_left'>".TRANSLATE['ALL_CI'][LANG]."</div>
                                <div class='clinic_loop_item_characters_right'>{$item['total_research']}</div>
                            </div>
                        </div>
                    </div>
                </div>";
        }
    ?>
</section>