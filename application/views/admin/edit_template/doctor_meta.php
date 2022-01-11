<?php
$settings = [
	'module_title' => 'Имя',
	'title' => 'Имя',
	'class_wrapper_input' => 'full_size'
];
MM_Module_Input::create('name', $settings, $name);
$settings = [
	'module_title' => 'Опыт',
	'title' => 'Опыт',
	'class_wrapper_input' => 'full_size'
];
MM_Module_Input::create('experience', $settings, $experience);
$settings = [
	'module_title' => 'Опыт в КИ',
	'title' => 'Опыт в КИ',
	'class_wrapper_input' => 'full_size'
];
MM_Module_Input::create('experience_cr', $settings, $experience_cr);
$settings = [
	'module_title' => 'Регион',
	'title' => 'Регион',
	'class_wrapper_input' => 'full_size'
];
MM_Module_Input::create('region', $settings, $region);
$settings = [
	'module_title' => 'Специализация',
	'title' => 'Специализация',
	'class_wrapper_input' => 'full_size'
];
MM_Module_Input::create('specialization', $settings, $specialization);
$settings = [
	'module_title' => 'Степень',
	'title' => 'Степень',
	'class_wrapper_input' => 'full_size'
];
MM_Module_Input::create('degree', $settings, $degree);
$settings = [
	'module_title' => 'Образование',
	'title' => 'Образование',
	'class_wrapper_input' => 'full_size'
];
MM_Module_Input::create('education', $settings, $education);
$settings = [
		'class_wrapper' => 'full_size',
		'module_title' => 'Список клиник'
	];
MM_Module_Relative::create('relative_clinic', $settings, $relative_clinics);
$settings = [
		'class_wrapper' => 'full_size',
		'module_title' => 'Города'
	];
MM_Module_Relative::create('relative_city', $settings, $relative_cityes);

$settings = [
	'class_wrapper' => 'full_size',
	'module_title' => 'Переводы'
];
MM_Module_Select::create('translate', $settings, $post_translate);
?>