<?php

class MM_Module_Multiple_Image extends MM_Module {
	static public function create($name, $settings, $img_data) {
		$class_wrapper = '';
		$title = '';
		$class_input = '';
		$strHTML = '';

		if(array_key_exists('class_wrapper', $settings)) {
			$class_wrapper = $settings['class_wrapper'];
		}
		if(array_key_exists('title', $settings)) {
			$title = $settings['title'];
		}
		if(array_key_exists('class_input', $settings)) {
			$class_input = $settings['class_input'];
		}

		$strHTML = "<div class='meta_wrapper {$class_wrapper}'>
						<div class='rich_text_title'>{$title}</div>
						<div class='mm_open_close'>&#9660;</div>
						<div class='mm_container hide'>
						<div class='mm_container' data-type='mm_module_multiple_image_{$name}'>";

		foreach ($img_data as $img) {
			$strHTML .= "<div class='mm_row'>
						 	<span class='delete_module'>X</span>
							<span class='up_module'>⇑</span>
							<span class='bottom_module'>⇓</span>
						 <div class='wrapper_input space_between margin_top_30'>
						    <div>
								<label>Desctop</label>
								<input type='file'
									   class='{$class_input}'
									   name='mm_module_multiple_image_desctop_{$name}[]'
									   />
								<input 
									   type='hidden'
									   name='mm_module_multiple_image_desctop_src_{$name}[]'  
									   value='{$img['src']}' 
									   />
							</div>";

			if(!empty($img['src'])){
				$strHTML .= "<div>
				           <img src='{$img['src']}' class='mm_thumbnail'>
				        </div>";
			}
			$strHTML .= "</div><div class='wrapper_input space_between margin_top_30'>
					        <div>
								<label>Mobile</label>
								<input type='file'
									   class='{$class_input}'
									   name='mm_module_multiple_image_mobile_{$name}[]'
									   />
								<input 
									   type='hidden'
									   name='mm_module_multiple_image_mobile_src_{$name}[]'  
									   value='{$img['mobile_src']}' 
									   />
							</div>";
			if(!empty($img['mobile_src'])){
				$strHTML .= "<div>
							<img src='{$img['mobile_src']}' class='mm_thumbnail'>
						 </div>";
			}
			$strHTML .= "</div>
					     <div class='wrapper_input'>
							<label for='description'>Title</label>
							<input type='text' 
							       class='mm_input' 
							       name='mm_module_multiple_image_title_{$name}[]' 
							       value='{$img['title']}' 
							       />
				    	</div>
				    	 <div class='wrapper_input'>
							<label for='description'>Alt</label>
							<input type='text' 
							       class='mm_input' 
							       name='mm_module_multiple_image_alt_{$name}[]' 
							       value='{$img['alt']}' 
							       />
				    	</div>
				    	</div>";
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
		    'default_input_name' => 'mm_module_multiple_image_desctop_src_'.$name
		];
		$desctop_src = self::uploadMultipleImage($settings);

		$settings = [
			'file_input_name' => 'mm_module_multiple_image_mobile_'.$name,
			'default_input_name' => 'mm_module_multiple_image_mobile_src_' . $name
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