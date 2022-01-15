<?php 
    if(!empty($body['autor'])) {
        echo "<section class='healing_autor'>
                <div class='container'>
                    <div class='healing_autor_card'>
                        <div class='healing_autor_card_left'>
                            <img src='{$body['autor'][0]['thumbnail'][SRC]}' class='healing_autor_card_image'>
                        </div>
                        <div class='healing_autor_card_right'>
                            <div class='healing_autor_card_title'>{$body['autor'][0]['title']}</div>
                            <div class='healing_autor_card_text'>
                                <div class='healing_autor_card_text_left'>
                                    ".TRANSLATE['SPECIALIZATION'][LANG]."
                                </div>
                                <div class='healing_autor_card_text_right'>
                                    {$body['autor'][0]['specialization']}
                                </div>
                            </div>
                            <div class='healing_autor_card_text'>
                                <div class='healing_autor_card_text_left'>
                                    ".TRANSLATE['MEDICAL_CENTER'][LANG]."
                                </div>
                                <div class='healing_autor_card_text_right'>
                                    {$body['autor'][0]['clinic']}
                                </div>
                            </div>
                            <div class='healing_autor_card_text'>
                                <div class='healing_autor_card_text_left'>
                                    ".TRANSLATE['EXPERIENCE'][LANG]."
                                </div>
                                <div class='healing_autor_card_text_right'>
                                    {$body['autor'][0]['experience']}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </section>";
    }
?>