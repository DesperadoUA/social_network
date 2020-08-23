<?php
class MM_Module_Input extends MM_Module {
	static public function create(
		$name = 'name',
		$settings,
		$value = ''
	)
	{
		$title = '';
		$read_only = '';
		$type = 'text';
		$class_wrapper = '';
		$class_input = '';

		if(array_key_exists('title', $settings)) $title = $settings['title'];
		if(array_key_exists('read_only', $settings)) $read_only = $settings['read_only'];
		if(array_key_exists('type', $settings)) $type = $settings['type'];
		if(array_key_exists('class_wrapper', $settings)) $class_wrapper = $settings['class_wrapper'];
		if(array_key_exists('class_input', $settings)) $class_input = $settings['class_input'];

		if($type === 'date') $value = substr($value, 0, 10);

		$strHTML = "<div class='meta_wrapper'>
                        <div class='rich_text_title'>{$title}</div>
						<div class='mm_open_close'>&#9660;</div>
						<div class='wrapper_input {$class_wrapper} hide'>
						<input type='{$type}'
							   class='mm_input {$class_input}'
							   name='{$name}'
							   value='{$value}'
							    {$read_only} />
						</div>
					</div>";
		echo $strHTML;
	}
	static public function getData($name){

		$settings = [
			'input_name' => $name
		];
		$data = self::getDataFromInput($settings);

		return $data;
	}
}