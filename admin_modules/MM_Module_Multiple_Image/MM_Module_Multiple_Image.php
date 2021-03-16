<?php

class MM_Module_Multiple_Image extends MM_Module {
	static public function create($name, $settings, $img_data) {
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
		$strHTML .= "<div class='mm_container' data-type='mm_module_multiple_image_{$name}'>";

		foreach ($img_data as $img) {
			$strHTML .= "<div class='mm_row'>
						 	<span class='delete_module'>X</span>
							<span class='up_module'>⇑</span>
							<span class='bottom_module'>⇓</span>";

			$settings_img = [
			'title' => 'Desctop',
			'class_input' => $class_input
			];
			$strHTML .= self::createMultipleImage('mm_module_multiple_image_desctop_'.$name, $settings_img ,$img['src']);

			$settings_img = [
				'title' => 'Mobile',
				'class_input' => $class_input
			];
			$strHTML .= self::createMultipleImage('mm_module_multiple_image_mobile_'.$name, $settings_img ,$img['mobile_src']);

			$settingsInput = [
				'title' => 'Title',
				'read_only' => '',
				'type' => 'text',
				'class_wrapper_input' => '',
				'class_input' => ''
			];
			$strHTML .= self::createInput('mm_module_multiple_image_title_'.$name.'[]', $settingsInput, $img['title']);

			$settingsInput = [
				'title' => 'Alt',
				'read_only' => '',
				'type' => 'text',
				'class_wrapper_input' => '',
				'class_input' => ''
			];
			$strHTML .= self::createInput('mm_module_multiple_image_alt_'.$name.'[]', $settingsInput, $img['alt']);

			$strHTML .= "</div>";
		}

		$strHTML .= "</div>";

		$strHTML .= "<div class='wrapper_button_add'>
						<span class='btn_add mm_module_multiple_image_add' 
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
			'file_input_name' => 'mm_module_multiple_image_desctop_'.$name,
		    'default_input_name' => 'mm_module_multiple_image_desctop_'.$name.'_src'
		];
		$desctop_src = self::uploadMultipleImage($settings);

		$settings = [
			'file_input_name' => 'mm_module_multiple_image_mobile_'.$name,
			'default_input_name' => 'mm_module_multiple_image_mobile_'.$name.'_src'
		];
		$mobile_src = self::uploadMultipleImage($settings);


		$settings = [
			'input_name' => 'mm_module_multiple_image_alt_'.$name
		];
		$arr_alt = self::getDataFromMultipleInput($settings);

		$settings = [
			'input_name' => 'mm_module_multiple_image_title_'.$name
		];
		$arr_title = self::getDataFromMultipleInput($settings);

		for($i=0; $i<count($desctop_src); $i++) {
			$data[] = [
				'src'        => $desctop_src[$i],
				'mobile_src' => $mobile_src[$i],
				'title'      => $arr_title[$i],
				'alt'        => $arr_alt[$i]
			];
		}

		return $data;
	}
}