<?php
class MM_Module_Input extends MM_Module {
	static public function create( $name = 'name', $settings, $value = '') {
		if(array_key_exists('module_title', $settings)) {
			$strHTML = MM_Module::openMetaWrapper($settings);
		}

		$strHTML .= MM_Module::createInput($name, $settings, $value );

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