<?php
$settings = [
	'module_title' => 'Имя',
	'title' => 'Имя',
	'class_wrapper_input' => 'full_size'
];
MM_Module_Input::create('name', $settings, $name);
$settings = [
	'class_wrapper' => 'full_size',
	'module_title' => 'Заболевание'
];
MM_Module_Relative::create('relative_disease', $settings, $relative_disease);
$settings = [
	'class_wrapper' => 'full_size',
	'module_title' => 'Врачи'
];
MM_Module_Relative::create('relative_doctors', $settings, $relative_doctors);
$settings = [
	'class_wrapper' => 'full_size',
	'module_title' => 'Переводы'
];
MM_Module_Select::create('translate', $settings, $post_translate);
?>