<?php

class MM_Module_Image extends MM_Module {
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

		$settings_img = [
			'title' => 'Desctop',
			'class_input' => $class_input
		];
		$strHTML .= self::createImage('mm_module_image_desctop_'.$name, $settings_img ,$img_data['src']);

		$settings_img = [
			'title' => 'Mobile',
			'class_input' => $class_input
		];
		$strHTML .= self::createImage('mm_module_image_mobile_'.$name, $settings_img ,$img_data['mobile_src']);

		$settingsInput = [
			'title' => 'Title',
			'read_only' => '',
			'type' => 'text',
			'class_wrapper_input' => '',
			'class_input' => ''
		];
		$strHTML .= self::createInput('mm_module_image_title_'.$name, $settingsInput, $img_data['title']);

		$settingsInput = [
			'title' => 'Alt',
			'read_only' => '',
			'type' => 'text',
			'class_wrapper_input' => '',
			'class_input' => ''
		];
		$strHTML .= self::createInput('mm_module_image_alt_'.$name, $settingsInput, $img_data['alt']);

		$strHTML .= self::closeMetaWrapper();
		echo $strHTML;
	}
	static public function getData($name){
		$data = [];

		$settings = [
			'file_input_name'    => 'mm_module_image_desctop_'.$name,
			'default_input_name' => 'mm_module_image_desctop_'.$name.'_src'
		];
		$desctop_src = self::uploadImage($settings);

		$settings = [
			'file_input_name'    => 'mm_module_image_mobile_'.$name,
			'default_input_name' => 'mm_module_image_mobile_'.$name.'_src'
		];
		$mobile_src = self::uploadImage($settings);

		$settings = [
			'input_name' => 'mm_module_image_title_'.$name
		];
		$title = self::getDataFromInput($settings);

		$settings = [
			'input_name' => "mm_module_image_alt_".$name
		];
		$alt = self::getDataFromInput($settings);

		$data = [
			'src'        => $desctop_src,
			'mobile_src' => $mobile_src,
			'title'      => $title,
			'alt'        => $alt
		];

		return $data;
	}
}