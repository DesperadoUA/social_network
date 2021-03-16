<?php
/*
 * $settings['value'] - содержит список всех возможных вариантов выбора
 * $settings['value'] = [
 * 		'Ru' => 'ru',
 * 		'Ua' => 'ua'
 * ]
 * $value - содержит текущее значение ('ru')
 * */

class MM_Module_Radio_Button extends MM_Module {
	static public function create( $name = 'name', $settings, $value = '') {

		if(array_key_exists('module_title', $settings)) {
			$strHTML = MM_Module::openMetaWrapper($settings);
		}

		if(array_key_exists('value', $settings)) {
			if(!is_array($settings['value'])) $settings['value'] = [];
		}
		else $settings['value'] = [];


		$strHTML .= MM_Module::createRadioButton($name, $settings, $value );

		if(array_key_exists('module_title', $settings)) {
			$strHTML .= MM_Module::closeMetaWrapper();
		}

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