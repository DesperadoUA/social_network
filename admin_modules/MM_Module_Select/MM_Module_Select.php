<?php
/*
 * Параметр дата содержит массив с ключами
 * $data[
       'all_data' => [
                       ['post_title' => 'Title 1', 'id' => '1'],
                       ['post_title' => 'Title 2', 'id' => '2'],
                     ],
       'id' => '1'
  ];
 * $settings[
 * 	 'class_wrapper' => 'full_size',
 *   'module_title' => 'Связаные посты по содержанию'
 * ]
 * $name - ключ для получения данных
 */

class MM_Module_Select extends MM_Module {
	static function create($name, $settings, $data){

		if(array_key_exists('class_wrapper', $settings)) {
			$settings['class_wrapper'] = $settings['class_wrapper'].' mm_module_two_input';
		}
		else {
			$settings['class_wrapper'] = '';
		}

		$strHTML = self::openMetaWrapper($settings);
		$strHTML .= self::createSelect($name, $data);
		$strHTML .= self::closeMetaWrapper();
		echo $strHTML;
	}
	static function getData($name){
		$data = self::getSelect($name);
		return $data;
	}
}