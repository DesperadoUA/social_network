<div class="meta_wrapper">
	<?php
	$settings = [
		'module_title' => 'Имя автора',
		'title' => 'Имя автора',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('autor_name', $settings, ''); 
	$settings = [
		'module_title' => 'Опыт автора',
		'title' => 'Опыт автора',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('autor_experience', $settings, ''); 
	$settings = [
		'module_title' => 'Специализация автора',
		'title' => 'Специализация автора',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('autor_specialization', $settings, ''); 
	$settings = [
		'module_title' => 'Название клиники',
		'title' => 'Название клиники',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('autor_clinic', $settings, ''); 
	
	$settings = [
		'class_wrapper' => 'class_wrapper',
		'class_input'   => 'class_input',
		'title'         => 'Автор Thumbnail'
	];
	$thumbnail = [
		'src' => '',
		'mobile_src' => '',
		'title' => '',
		'alt' => ''
	];
	MM_Module_Image::create('autor_thumbnail', $settings, $thumbnail);
	?>
</div>