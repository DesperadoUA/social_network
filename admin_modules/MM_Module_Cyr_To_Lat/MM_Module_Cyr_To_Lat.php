<?php
class MM_Module_Cyr_To_Lat {
	static public function create(
		$title = 'title',
		$permalink = 'permalink',
		$name_1 = 'title',
		$name_2 = 'permalink'
){
		echo "<div class='meta_wrapper mm_module_cyr_to_lat'>
		        <div class='wrapper_input'>
				   <label for='title'>{$title}</label>
					<input type='text' class='mm_input mm_module_cyr_to_lat_one' 
						 name='{$name_1}' value=''>
				</div>
				<div class='wrapper_input'>
				   <label for='title'>{$permalink}</label>
					<input type='text' class='mm_input mm_module_cyr_to_lat_two' 
						 name='{$name_2}' value=''>
				</div>
			  </div>";
	}
}