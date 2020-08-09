<?php
class MM_Module_Rich_Text {
	static public function create($text='', $title='', $name){
		$strHTML = "<div class='textarea_wrapper'>
						<div class='rich_text_title'>
							{$title}
						</div>
                        <textarea 
                        name='rich_text_{$name}' 
                        class='summernote'>{$text}
                        </textarea>
					</div>";
		echo $strHTML;
	}
	static public function getData($name){
		$data = '';
		if(array_key_exists('rich_text_'.$name, $_POST)) {
			$data = $_POST['rich_text_'.$name];
		}
		return $data;
	}
}