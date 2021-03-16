<div class="meta_wrapper">
	<?php
	$settings = [
		'module_title' => 'Название протокола',
		'title' => 'Название протокола',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Textarea::create('protocol_name', $settings, ''); ?>
	<?php
	$settings = [
		'module_title' => 'Терапевтическая область',
		'title' => 'Терапевтическая область',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('therapeutic_area', $settings, ''); ?>
	<?php
	$settings = [
		'module_title' => 'Название организации',
		'title' => 'Название организации',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Textarea::create('name_organization', $settings, ''); ?>
	<?php
	$settings = [
		'module_title' => 'Дата начала исследования',
		'title' => 'Дата начала исследования',
		'type' => 'date',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('data_start', $settings, $current_date); ?>
	<?php
	$settings = [
		'module_title' => 'Дата конца исследования',
		'title' => 'Дата конца исследования',
		'type' => 'date',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('data_finish', $settings, $current_date); ?>
	<?php
	$settings = [
		'module_title' => 'Активность',
		'title' => 'Активность исследования',
	];
	MM_Module_Checkbox::create('active', $settings, DEFAULT_STATUS);
	?>
	<?php
	$settings = [
		'module_title' => 'Регион',
		'title' => 'Регион',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('region', $settings, ''); ?>
	<?php
	$settings = [
		'module_title' => 'Город',
		'title' => 'Город',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('city', $settings, ''); ?>
	<?php
	$settings = [
		'module_title' => 'Заболевание',
		'title' => 'Заболевание',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('disease', $settings, ''); ?>
	<?php
	$settings = [
		'module_title' => 'Исследователи',
		'title' => 'Исследователи',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('researchers', $settings, ''); ?>
	<?php
	$settings = [
		'module_title' => 'Название клиники',
		'title' => 'Название клиники',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('clinic_name', $settings, ''); ?>
	<?php
	$settings = [
		'module_title' => 'С открытым набором',
		'title' => 'С открытым набором',
	];
	MM_Module_Checkbox::create('open_set', $settings, DEFAULT_STATUS);
	?>
	<?php
	$settings = [
		'module_title' => 'Для здоровых добровольцев',
		'title' => 'Для здоровых добровольцев',
	];
	MM_Module_Checkbox::create('for_volunteers', $settings, DEFAULT_STATUS);
	?>
	<?php
	$settings = [
		'module_title' => 'Дополнительные поля исследования',
		'title' => ['text 1', 'text 2']
	];
	if(!isset($additional_fields) or empty($additional_fields)) $additional_fields = [];
	MM_Module_Two_Input::create('additional_fields', $settings, $additional_fields);
	?>
</div>