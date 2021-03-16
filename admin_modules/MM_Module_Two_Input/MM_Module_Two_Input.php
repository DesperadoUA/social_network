<?php
class MM_Module_Two_Input extends MM_Module {
	static function create($name, $settings, $data){

		if(array_key_exists('class_wrapper', $settings)) {
			$settings['class_wrapper'] = $settings['class_wrapper'].' mm_module_two_input';
		}
		else {
			$settings['class_wrapper'] = 'mm_module_two_input';
		}

		$strHTML = self::openMetaWrapper($settings);

		$strHTML .= "<div class='mm_container' data-type='mm_module_two_input_{$name}'>";

		foreach ($data as $item) {
			$strHTML .= "<div class='mm_row'>
							<span class='delete_module'>X</span>
							<span class='up_module'>⇑</span>
							<span class='bottom_module'>⇓</span>";
				$strHTML .= self::createInput(
				   "first_input_{$name}[]",
				         ['title' => $settings['title'][0]],
				         $item['value_1']);
				$strHTML .= self::createInput(
					"second_input_{$name}[]",
					     ['title' => $settings['title'][1]],
					     $item['value_2']);
			$strHTML .= "</div>";
		}

		$strHTML .= "</div>";

		$strHTML .= "<div class='wrapper_button_add'>
						<span class='btn_add mm_module_two_input_add' 
						      data-name='{$name}' 
						      data-label-1='{$settings['title'][0]}'
						      data-label-2='{$settings['title'][1]}'
						      >
							Добавить
						</span>
					</div>";
		$strHTML .= self::closeMetaWrapper();
		echo $strHTML;
	}
	static function getData($name){
		$data = [];

		$settings = [
			'input_name' => 'first_input_'.$name
		];
		$first_input = self::getDataFromMultipleInput($settings);

		$settings = [
			'input_name' => 'second_input_'.$name
		];
		$second_input = self::getDataFromMultipleInput($settings);

		for($i=0; $i<count($first_input); $i++){
			$data[] = [
				'value_1' => $first_input[$i],
				'value_2' => $second_input[$i],
			];
		}

		return $data;
	}
}