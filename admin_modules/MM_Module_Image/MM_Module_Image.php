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

		$strHTML = "<div class='meta_wrapper {$class_wrapper}'>
						<div class='rich_text_title'>{$title}</div>
						<div class='mm_open_close'>&#9660;</div>
						<div class='mm_module_container hide'>
						 <div class='wrapper_input space_between'>
						    <div>
								<label>Desctop</label>
								<input type='file'
									   class='{$class_input}'
									   name='mm_module_image_desctop_{$name}'
									   />
								<input 
									   type='hidden'
									   name='mm_module_image_desctop_src_{$name}'  
									   value='{$img_data['src']}'>
							</div>";
		if(!empty($img_data['src'])){
			$strHTML .= "<div>
				           <img src='{$img_data['src']}' class='mm_thumbnail'>
				        </div>";
		}
		$strHTML .= "</div>
					     <div class='wrapper_input space_between'>
					        <div>
								<label>Mobile</label>
								<input type='file'
									   class='{$class_input}'
									   name='mm_module_image_mobile_{$name}'
									   />
								<input 
									   type='hidden'
									   name='mm_module_image_mobile_src_{$name}'  
									   value='{$img_data['mobile_src']}'>
							</div>";
		if(!empty($img_data['mobile_src'])){
			$strHTML .= "<div>
							<img src='{$img_data['mobile_src']}' class='mm_thumbnail'>
						 </div>";
		}
		$strHTML .= "</div>
					     <div class='wrapper_input'>
							<label for='description'>Title</label>
							<input type='text' 
							       class='mm_input' 
							       name='mm_module_image_title_{$name}' 
							       value='{$img_data['title']}'>
				    	</div>
				    	 <div class='wrapper_input'>
							<label for='description'>Alt</label>
							<input type='text' 
							       class='mm_input' 
							       name='mm_module_image_alt_{$name}' 
							       value='{$img_data['alt']}'>
				    	</div>
				    	</div>
					</div>";
		echo $strHTML;
	}
	static public function getData($name){
		$data = [];

		$settings = [
			'file_input_name'    => 'mm_module_image_desctop_'.$name,
			'default_input_name' => 'mm_module_image_desctop_src_'.$name
		];
		$desctop_src = self::uploadImage($settings);

		$settings = [
			'file_input_name'    => 'mm_module_image_mobile_'.$name,
			'default_input_name' => 'mm_module_image_mobile_src_'.$name
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