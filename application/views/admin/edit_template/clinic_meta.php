<div class="meta_wrapper">
	<?php
	$settings = [
		'module_title' => 'Full name',
		'title' => 'Наименование полное',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('full_name', $settings, $full_name); ?>
	<?php
	$settings = [
		'module_title' => 'City',
		'title' => 'Город',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('city', $settings, $city); ?>
	<?php
	$settings = [
		'module_title' => 'Region',
		'title' => 'Region',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('region', $settings, $region); ?>
	<?php
	$settings = [
		'module_title' => 'Address',
		'title' => 'Адрес',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('address', $settings, $address); ?>
	<?php
	$settings = [
		'module_title' => 'Researchers',
		'title' => 'Исследователи',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('researchers', $settings, $researchers); ?>

	<?php
	$settings = [
		'module_title' => 'Therapeutic area',
		'title' => 'Терапевтическая область',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('therapeutic_area', $settings, $therapeutic_area); ?>

</div>