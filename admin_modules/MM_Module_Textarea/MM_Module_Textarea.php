<?php
class MM_Module_Textarea extends MM_Module {
	static public function create( $name = 'name', $settings, $value = '') {
		if(array_key_exists('module_title', $settings)) {
			$strHTML = MM_Module::openMetaWrapper($settings);
		}

		$strHTML .= MM_Module::createTextarea($name, $settings, $value );

		if(array_key_exists('module_title', $settings)) {
			$strHTML .= MM_Module::closeMetaWrapper();
		}

		echo $strHTML;
	}
	static public function getData($name){

		$settings = [
			'textarea_name' => $name
		];
		$data = self::getDataFromTextarea($settings);

		return $data;
	}
}