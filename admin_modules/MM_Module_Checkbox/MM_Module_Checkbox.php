<?php
class MM_Module_Checkbox extends MM_Module {
	static public function create( $name = 'name', $settings, $value = '') {
		if(array_key_exists('module_title', $settings)) {
			$strHTML = MM_Module::openMetaWrapper($settings);
		}

		$strHTML .= MM_Module::createCheckbox($name, $settings, $value );

		if(array_key_exists('module_title', $settings)) {
			$strHTML .= MM_Module::closeMetaWrapper();
		}

		echo $strHTML;
	}
	static public function getData($name){

		$settings = [
			'input_name' => $name
		];
		$data = self::getDataFromCheckbox($settings);

		return $data;
	}
}