<?php
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
				$data[] = $_POST[$settings['input_name']][$i];
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
			$data = $_POST[$settings['input_name']];
		}

		return $data;
	}
	protected static function getDataFromTextarea($settings) {
		$data = '';

		if(array_key_exists($settings['textarea_name'], $_POST)) {
			$data = $_POST[$settings['textarea_name']];
		}

		return $data;
	}
}