<div class="meta_wrapper">
	<?php
	$settings = [
		'module_title' => 'Имя',
		'title' => 'Имя',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('name', $settings, ''); 
	$settings = [
		'module_title' => 'Опыт',
		'title' => 'Опыт',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('experience', $settings, '');
	$settings = [
		'module_title' => 'Опыт в КИ',
		'title' => 'Опыт в КИ',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('experience_cr', $settings, '');
	$settings = [
		'module_title' => 'Регион',
		'title' => 'Регион',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('region', $settings, '');
	$settings = [
		'module_title' => 'Специализация',
		'title' => 'Специализация',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('specialization', $settings, '');
	$settings = [
		'module_title' => 'Степень',
		'title' => 'Степень',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('degree', $settings, '');
	$settings = [
		'module_title' => 'Образование',
		'title' => 'Образование',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('education', $settings, '');
	
	?>
</div>