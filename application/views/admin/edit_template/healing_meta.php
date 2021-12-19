<?php
$settings = [
	'module_title' => 'Имя',
	'title' => 'Имя',
	'class_wrapper_input' => 'full_size'
];
MM_Module_Input::create('name', $settings, $name);
$settings = [
	'class_wrapper' => 'full_size',
	'module_title' => 'Переводы'
];
MM_Module_Select::create('translate', $settings, $post_translate);
?>