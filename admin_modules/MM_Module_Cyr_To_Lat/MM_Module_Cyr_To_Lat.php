<?php
class MM_Module_Cyr_To_Lat extends MM_Module {
	static public function create(
		$name = [ 'title', 'permalink'],
		$settings = [
			'module_title' => 'Default header',
			'title' => ['title', 'permalink']
		],
		$value = [
			'title' => 'value Title',
			'permalink' => 'value Permalink'
		]
){
		if(array_key_exists('class_wrapper', $settings)) {
			$settings['class_wrapper'] = $settings['class_wrapper'].' mm_module_cyr_to_lat';
		} else {
			$settings['class_wrapper'] = 'mm_module_cyr_to_lat';
		}

		$strHtml = self::openMetaWrapper($settings);
		$strHtml .= self::createInput('cyr_to_lat_'.$name[0], [
			'title' => $settings['title'][0],
			'class_input' => 'mm_module_cyr_to_lat_one',
		], $value['title']);
		$strHtml .= self::createInput('cyr_to_lat_'.$name[1], [
			'title' => $settings['title'][1],
			'class_input' => 'mm_module_cyr_to_lat_two'
		], $value['permalink']);
		$strHtml .= self::closeMetaWrapper();

		echo $strHtml;
		}
		static public function getData($name){
			$settings = [
				'input_name' => 'cyr_to_lat_'.$name
			];
			$data = self::getDataFromInput($settings);

			return $data;
		}
}