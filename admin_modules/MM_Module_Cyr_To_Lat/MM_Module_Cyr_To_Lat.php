<?php
class MM_Module_Cyr_To_Lat extends MM_Module {
	static public function create(
		$title = 'title',
		$permalink = 'permalink',
		$name_1 = 'title',
		$name_2 = 'permalink',
		$value = [
			'title' => 'value Title',
			'permalink' => 'value Permalink'
		]
){
		echo "<div class='meta_wrapper mm_module_cyr_to_lat'>
				<div class='rich_text_title'>Permalink</div>
				<div class='mm_open_close'>▼</div>
				<div class='mm_module_container hide'>
					<div class='wrapper_input'>
					   <label for='title'>{$title}</label>
						<input type='text' 
						       class='mm_input mm_module_cyr_to_lat_one' 
							   name='cyr_to_lat_{$name_1}' 
							   value='{$value['title']}' />
					</div>
					<div class='wrapper_input'>
					   <label for='title'>{$permalink}</label>
						<input type='text' 
						       class='mm_input mm_module_cyr_to_lat_two' 
							   name='cyr_to_lat_{$name_2}' 
							   value='{$value['permalink']}' />
					</div>
				</div>
			  </div>";
		}
		static public function getData($name){
			$settings = [
				'input_name' => $name
			];
			$data = self::getDataFromInput($settings);

			return $data;
		}
}