<?php
/*
 * $settings = [
 * 		'module_title',
 * 		'title',
 *      'read_only',
 *  	'type',
 *      'class_wrapper',
 *      'class_input'
 * ];
 */
class MM_Module {
	const PATH_UPLOADS = '/uploads/';
	protected static function uploadMultipleImage($settings) {
		$data = [];

		if(array_key_exists($settings['file_input_name'], $_FILES)) {
			for($i=0; $i<count($_FILES[$settings['file_input_name']]['name']); $i++){
				if(empty($_FILES[$settings['file_input_name']]['name'][$i])){
					if(!empty($_POST[$settings['default_input_name']][$i])){
						$data[] = $_POST[$settings['default_input_name']][$i];
					}
				}
				else {
					$file_tmp = $_FILES[$settings['file_input_name']]['tmp_name'][$i];
					$file_name = Cyr_To_Lat::translate(self::PATH_UPLOADS . time() . $_FILES[$settings['file_input_name']]['name'][$i]);
					move_uploaded_file($file_tmp, ROOT.$file_name);
					$data[] = $file_name;
				}
			}
		}

		return $data;
	}
	protected static function getDataFromMultipleInput($settings){
		$data = [];
		
		if(array_key_exists($settings['input_name'], $_POST)){
			for($i=0; $i<count($_POST[$settings['input_name']]); $i++){
				$data[] = trim($_POST[$settings['input_name']][$i]);
			}
		}
		
		return $data;
	}
	protected static function uploadImage($settings){
		$data = '';
		
		if(array_key_exists($settings['file_input_name'], $_FILES)) {
			if(empty($_FILES[$settings['file_input_name']]['name'])){
				$data = $_POST[$settings['default_input_name']];
			}
			else {
				$file_tmp = $_FILES[$settings['file_input_name']]['tmp_name'];
				$file_name = Cyr_To_Lat::translate( self::PATH_UPLOADS . time() . $_FILES[$settings['file_input_name']]['name']);
				move_uploaded_file($file_tmp, ROOT.$file_name);
				$data = $file_name;
			}
		}
		
		return $data;
	}
	protected static function getDataFromInput($settings){
		$data = '';

		if(array_key_exists($settings['input_name'], $_POST)) {
			$data = trim($_POST[$settings['input_name']]);
		}

		return $data;
	}
	protected static function getDataFromCheckbox($settings){
		$data = 0;
		if(array_key_exists($settings['input_name'], $_POST)) $data = 1;
		return $data;
	}
	protected static function getDataFromTextarea($settings) {
		$data = '';

		if(array_key_exists($settings['textarea_name'], $_POST)) {
			$data = trim($_POST[$settings['textarea_name']]);
		}

		return $data;
	}
	protected static function openMetaWrapper($settings){
		$class_wrapper = '';
		if(array_key_exists('class_wrapper', $settings)) {
			$class_wrapper = $settings['class_wrapper'];
		}
		return "<div class='meta_wrapper {$class_wrapper}'>
                        <div class='rich_text_title'>{$settings['module_title']}</div>
						<div class='mm_open_close'>&#9660;</div>
						<div class='mm_module_container hide'>";
	}
	protected static function closeMetaWrapper(){
		return "</div></div>";
	}
	protected static function createInput($name, $settings, $value){

		$title = '';
		$read_only = '';
		$type = 'text';
		$class_wrapper_input = '';
		$class_input = '';

		if(array_key_exists('title', $settings)) $title = $settings['title'];
		if(array_key_exists('read_only', $settings)) $read_only = $settings['read_only'];
		if(array_key_exists('type', $settings)) $type = $settings['type'];
		if(array_key_exists('class_wrapper_input', $settings)) $class_wrapper_input = $settings['class_wrapper_input'];
		if(array_key_exists('class_input', $settings)) $class_input = $settings['class_input'];

		if($type === 'date') $value = substr($value, 0, 10);

		$strHtml = "<div class='wrapper_input {$class_wrapper_input}'>
						<label for='description'>{$title}</label>
						<input type='{$type}'
							   class='mm_input {$class_input}'
							   name='{$name}'
							   value='{$value}'
							   {$read_only} />
					 </div>";

		return $strHtml;
	}
	protected static function createRadioButton($name, $settings, $value){

		$type = 'radio';
		$class_wrapper_input = '';
		$class_input = '';
		$strHtml = '';

		if(array_key_exists('class_wrapper_input', $settings)) {
			$class_wrapper_input = $settings['class_wrapper_input'];
		}
		if(array_key_exists('class_input', $settings)) {
			$class_input = $settings['class_input'];
		}

		foreach ($settings['value'] as $key => $key_value) {
			$strHtml .= "<div class='wrapper_input mm_margin_bottom_none {$class_wrapper_input}'>
						<label for='description'>{$key}</label>
						<input type='{$type}'
							   class='mm_input {$class_input}'
							   name='{$name}'
							   value='{$key_value}'";
			if($value === $key_value) $strHtml .= "checked='checked'";
			$strHtml .=	"/>
					 </div>";
		}

		return $strHtml;
	}
	protected static function createImage($name, $settings, $value) {

		$title = '';
		$class_input = '';

		if(array_key_exists('title', $settings)) $title = $settings['title'];
		if(array_key_exists('class_input', $settings)) $class_input = $settings['class_input'];

		$strHTML = "<div class='wrapper_input space_between'>
						    <div>
								<label>{$title}</label>
								<input type='file'
									   class='{$class_input}'
									   name='{$name}'
									   />
								<input 
									   type='hidden'
									   name='{$name}_src'  
									   value='{$value}'>
							</div>";
		if(!empty($value)){
			$strHTML .= "<div>
				           <img src='{$value}' class='mm_thumbnail'>
				        </div>";
		}
		$strHTML .= "</div>";
		return $strHTML;
	}
	protected static function createMultipleImage($name, $settings, $value) {

		$title = '';
		$class_input = '';

		if(array_key_exists('title', $settings)) $title = $settings['title'];
		if(array_key_exists('class_input', $settings)) $class_input = $settings['class_input'];

		$strHTML = "<div class='wrapper_input space_between margin_top_30'>
						    <div>
								<label>{$title}</label>
								<input type='file'
									   class='{$class_input}'
									   name='{$name}[]'
									   />
								<input 
									   type='hidden'
									   name='{$name}_src[]'  
									   value='{$value}'>
							</div>";
		if(!empty($value)){
			$strHTML .= "<div>
				           <img src='{$value}' class='mm_thumbnail'>
				        </div>";
		}
		$strHTML .= "</div>";
		return $strHTML;
	}
	protected static function createRelative($name, $value){
		$strHtml = '<div class="mm_module_relative_wrapper">';
		foreach ($value['all_data'] as $item) {
			$strHtml .= "<div class='mm_module_relative_input_wrapper'>";
			$strHtml .= "<input type='checkbox' name='{$name}[]' value='{$item['id']}' class='mm_checkbox'";
			if(in_array($item['id'], $value['id'])) $strHtml .= ' checked />';
			else $strHtml .= ' />';
			$strHtml .= "<div class='mm_module_relative_title'>{$item['post_title']}</div>";
			$strHtml .= "</div>";
		}
		$strHtml .= '</div>';
		return $strHtml;
	}
	protected static function getRelative($name){
		$data = [];
		if(array_key_exists($name, $_POST)) $data = $_POST[$name];
		return $data;
	}
	protected static function createTextarea($name, $settings, $value){

		$title = '';
		$class_wrapper_input = '';
		if(array_key_exists('title', $settings)) $title = $settings['title'];
		if(array_key_exists('class_wrapper_input', $settings)) $class_wrapper_input = $settings['class_wrapper_input'];
		$strHtml = "<div class='wrapper_input {$class_wrapper_input}'>
						<label for='description'>{$title}</label>
						<textarea 
							   class='mm_textarea'
							   name='{$name}'>{$value}</textarea>
					 </div>";
		return $strHtml;
	}
	protected static function createCheckbox($name, $settings, $value){

		$title = '';
		$type = 'checkbox';
		$class_wrapper_input = '';
		$class_input = '';

		if(array_key_exists('title', $settings)) {
			$title = $settings['title'];
		}
		if(array_key_exists('class_wrapper_input', $settings)) {
			$class_wrapper_input = $settings['class_wrapper_input'];
		}

		if(array_key_exists('class_input', $settings)) {
			$class_input = $settings['class_input'];
		}


		$strHtml = "<div class='wrapper_input {$class_wrapper_input}'>
						<label for='description'>{$title}</label>
						<input type='{$type}'
							   class='mm_input {$class_input}'
							   name='{$name}' ";
		if(!empty($value)) $strHtml .= "checked='checked'";
		$strHtml .=	"/>
					 </div>";

		return $strHtml;
	}
	protected static function createSelect($name, $value){
		$strHtml = "<div class='wrapper_input'>
						<select name='${name}' class='mm_select'> 
							<option value='0'>Все</option>";
		foreach ($value['all_data'] as $item) {
			    $strHtml .= "<option value='{$item['id']}'";
                if($item['id'] === $value['id']) $strHtml .= 'selected ';
			    $strHtml .= ">{$item['post_title']}</option>";
		}
		$strHtml .= "</select>
					 </div>";

		return $strHtml;
	}
	protected static function getSelect($name){
		$data = '0';
		if(array_key_exists($name, $_POST)) $data = $_POST[$name];
		return $data;
	}

}