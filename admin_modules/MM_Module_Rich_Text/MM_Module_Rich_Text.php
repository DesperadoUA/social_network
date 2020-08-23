<?php
class MM_Module_Rich_Text extends MM_Module {
	static public function create($name, $settings, $text=''){
		$title='';

		if(array_key_exists('title', $settings)) $title = $settings['title'];

		$strHTML = "<div class='meta_wrapper'>
						<div class='rich_text_title'>{$title}</div>
						<div class='mm_open_close'>&#9660;</div>
						<div class='mm_module_container hide'>
							<div class='textarea_wrapper'>
							<textarea 
							name='rich_text_{$name}' 
							class='summernote'>{$text}
							</textarea>
						</div>	
					</div></div>";
		echo $strHTML;
	}
	static public function getData($name){
		$settings = [
			'textarea_name' => 'rich_text_'.$name
		];
		$data = self::getDataFromTextarea($settings);

		return $data;
	}
}