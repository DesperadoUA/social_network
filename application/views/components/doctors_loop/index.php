<?php 
    if(!empty($posts)) {
        echo '<section class="doctors_loop">';
        foreach($posts as $item) {
            echo "<div class='doctors_row'>
                    <div class='container'>
                        <article class='doctors_loop_item'>
                            <div class='doctors_loop_title'>
                                <a href='{$item['permalink']}'>{$item['title']}</a>
                            </div>
                            <div class='doctors_loop_item_row'>
                                <div class='doctors_loop_item_left'>".TRANSLATE['CITY'][LANG]."</div>
                                <div class='doctors_loop_item_right'>{$item['city']}</div>
                                <div class='gradient_line'></div>
                            </div>
                            <div class='doctors_loop_item_row'>
                                <div class='doctors_loop_item_left'>".TRANSLATE['MEDICAL_INSTITUT'][LANG]."</div>
                                <div class='doctors_loop_item_right'>{$item['clinic']}</div>
                                <div class='gradient_line'></div>
                            </div>
                            <div class='doctors_loop_item_row'>
                                <div class='doctors_loop_item_left'>".TRANSLATE['CR_EXPERIENCE'][LANG]."</div>
                                <div class='doctors_loop_item_right'>{$item['experience_cr']}</div>
                                <div class='gradient_line'></div>
                            </div>
                            <div class='doctors_loop_item_row'>
                                <div class='doctors_loop_item_left'>".TRANSLATE['CR_COUNT'][LANG]."</div>
                                <div class='doctors_loop_item_right'>{$item['count_research']}</div>
                                <div class='gradient_line'></div>
                            </div>
                        </article>
                    </div>
                </div>";
        }
        echo "</section>";
    }
?>