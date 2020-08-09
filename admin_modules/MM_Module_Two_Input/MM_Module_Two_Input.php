<?php
class MM_Module_Two_Input {
	static function create($data, $name, $title, $label_1, $label_2){
		$strHTML = '<div class="meta_wrapper mm_module_two_input">';
		$strHTML .= "<div class='mm_container' 
                        data-type='mm_module_two_input_{$name}'>";
		$strHTML .= "<div class='rich_text_title'>{$title}</div>";

		foreach ($data as $item) {
			$strHTML .= "<div class='mm_row'>
							<span class='delete_module'>X</span>
							<span class='up_module'>⇑</span>
							<span class='bottom_module'>⇓</span>
                        <div class='wrapper_input'>
						<label for='description'>{$label_1}</label>
						<input type='text' 
						class='mm_input' 
						name='first_input_{$name}[]' 
						value='{$item['value_1']}'>
				    </div>
					<div class='wrapper_input'>
						<label for='description'>{$label_2}</label>
						<input type='text' 
						class='mm_input' 
						name='second_input_{$name}[]'  
						value='{$item['value_2']}'>
					</div></div>";
		}

		$strHTML .= "</div>";
		$strHTML .= "<div class='wrapper_button_add'>
						<span class='btn_add mm_module_two_input_add' 
						      data-name='{$name}' 
						      data-label-1='{$label_1}' 
						      data-label-2='{$label_2}'
						      >
							Добавить
						</span>
					</div>";
		$strHTML .= '</div>';
		echo $strHTML;
	}
	static function getData($name){
		$data = [];
		if(array_key_exists('first_input_'.$name, $_POST)){
			$first_input = $_POST['first_input_'.$name];
			$second_input = $_POST['second_input_'.$name];
			for($i=0; $i<count($first_input); $i++){
				$data[] = [
					'value_1' => $first_input[$i],
					'value_2' => $second_input[$i],
				];
			}
		}
		return $data;
	}
}