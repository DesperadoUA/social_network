<?php
class MM_Module_Rich_Text {
	static public function create(){
		$strHTML = "<div class='textarea_wrapper'>
                        <textarea 
                        name='main_content' 
                        class='summernote'>Hello
                        </textarea>
					</div>";
		echo $strHTML;
	}
}