<section class="research_loop">
    <?php
	foreach ($research as $item) {
	    echo "<div class='research_loop_item'>
                <div class='container'>
                    <div class='research_loop_item_title'>
                        <a href='{$item['permalink']}'>{$item['title']}</a>
                    </div>
                    <div class='research_loop_item_row'>
                        <div class='research_loop_item_left'>".TRANSLATE['PROTOCOL_NAME'][LANG]."</div>
                        <div class='research_loop_item_right'>{$item['protocol_name']}</div>
                        <div class='research_line'></div>
                    </div>
                    <div class='research_loop_item_row'>
                        <div class='research_loop_item_left'>".TRANSLATE['THERAPEUTIC_AREA'][LANG]."</div>
                        <div class='research_loop_item_right'>{$item['therapeutic_area']}</div>
                        <div class='research_line'></div>
                    </div>
                    <div class='research_loop_item_row'>
                        <div class='research_loop_item_left'>".TRANSLATE['START_END_DATE'][LANG]."</div>
                        <div class='research_loop_item_right'>{$item['data_start']} - {$item['data_finish']}</div>
                        <div class='research_line'></div>
                    </div>
                    <div class='research_loop_item_row'>
                        <div class='research_loop_item_left'>".TRANSLATE['NAME_ORGANIZATION_CONDUCTING'][LANG]."</div>
                        <div class='research_loop_item_right'>{$item['name_organization']}</div>
                        <div class='research_line'></div>
                    </div>
                    <div class='research_loop_item_row_btn'>
                        <button class='research_loop_btn research_participate border_gradient' 
                           data-id='{$item['id']}'>
                           ".TRANSLATE['WANT_PARTICIPATE'][LANG]."
                        </button>
                        <button class='research_loop_btn research_active border_gradient' 
                           data-id='{$item['id']}'>
                           ".TRANSLATE['WRITE_RESEARCHERS'][LANG]."
                        </button>
                    </div>
                </div>
            </div>";
    }
    ?>
</section>