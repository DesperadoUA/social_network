<?php
class MM_Module_Input {
	static public function create(
		$name = 'name',
		$value = '',
		$read_only = '',
		$type = 'text',
		$class_wrapper = 'wrapper_input',
		$class_input = 'mm_input'
	)
	{

		if($type === 'date') $value = substr($value, 0, 10);

		$strHTML = "<div class='{$class_wrapper}'>
						<label for='{$name}'>{$name}</label>
						<input type='{$type}'
							   class='{$class_input}'
							   name='{$name}'
							   value='{$value} '
							    {$read_only} />
					</div>";
		echo $strHTML;
	}
}