<?php

class MM_Module_Multiple_Input extends MM_Module {
	static public function create($name, $settings, $input_data) {
		$class_wrapper = '';
		$title = '';
		$class_input = '';

		if(array_key_exists('class_wrapper', $settings)) {
			$class_wrapper = $settings['class_wrapper'];
		}
		if(array_key_exists('title', $settings)) {
			$title = $settings['title'];
		}
		if(array_key_exists('class_input', $settings)) {
			$class_input = $settings['class_input'];
		}

		$settings_wrapper = [
			'class_wrapper' => $class_wrapper,
			'module_title' => $title,
		];
		$strHTML = self::openMetaWrapper($settings_wrapper);
		$strHTML .= "<div class='mm_container' data-type='mm_module_multiple_input_{$name}'>";

		foreach ($input_data as $input) {
			$strHTML .= "<div class='mm_row'>
						 	<span class='delete_module'>X</span>
							<span class='up_module'>⇑</span>
							<span class='bottom_module'>⇓</span>";

			$settingsInput = [
				'title' => 'Text',
				'read_only' => '',
				'type' => 'text',
				'class_wrapper_input' => 'full_size',
				'class_input' => ''
			];
			$strHTML .= self::createInput('mm_module_multiple_input_'.$name.'[]', $settingsInput, $input['text']);

			$strHTML .= "</div>";
		}

		$strHTML .= "</div>";

		$strHTML .= "<div class='wrapper_button_add'>
						<span class='btn_add mm_module_multiple_input_add' 
						      data-name='{$name}' 
						      >
							Добавить
						</span>
					</div>";
		$strHTML .= '</div></div>';
		echo $strHTML;
	}
	static public function getData($name){
		$data = [];

		$settings = [
			'input_name' => 'mm_module_multiple_input_'.$name
		];
		$arr_text = self::getDataFromMultipleInput($settings);

		for($i=0; $i<count($arr_text); $i++) {
			$data[] = [
				'text' => $arr_text[$i],
			];
		}

		return $data;
	}
}