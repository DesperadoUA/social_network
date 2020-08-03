<?php
class MM_Module_Rich_Text {
	static public function create($text='', $title=''){
		$strHTML = "<div class='textarea_wrapper'>
						<div class='rich_text_title'>
							{$title}
						</div>
                        <textarea 
                        name='main_content' 
                        class='summernote'>{$text}
                        </textarea>
					</div>";
		echo $strHTML;
	}
}