<?php
$settings = [
	'module_title' => 'Имя автора',
	'title' => 'Имя',
	'class_wrapper_input' => 'full_size'
];
MM_Module_Input::create('autor_name', $settings, $autor_name);
$settings = [
	'module_title' => 'Опыт автора',
	'title' => 'Опыт автора',
	'class_wrapper_input' => 'full_size'
];
MM_Module_Input::create('autor_experience', $settings, $autor_experience);
$settings = [
	'module_title' => 'Специализация автора',
	'title' => 'Специализация автора',
	'class_wrapper_input' => 'full_size'
];
MM_Module_Input::create('autor_specialization', $settings, $autor_specialization);
$settings = [
	'module_title' => 'Название клиники',
	'title' => 'Название клиники',
	'class_input' => 'full_size',
	'class_wrapper_input' => 'full_size'
];
MM_Module_Input::create('autor_clinic', $settings, $autor_clinic); 

if(empty($autor_thumbnail)){
	$autor_thumbnail = [
		'src' => '',
		'mobile_src' => '',
		'title' => '',
		'alt' => ''
	];
} else {
	$autor_thumbnail = json_decode($autor_thumbnail, true);
}
$settings = [
	'module_title' => 'Фото автора',
	'title' => 'Фото автора',
	'class_input' => 'full_size',
	'class_wrapper_input' => 'full_size'
];
MM_Module_Image::create('autor_thumbnail', $settings, $autor_thumbnail);

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