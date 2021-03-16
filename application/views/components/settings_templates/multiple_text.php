<?php
$settings = [
	'module_title' => $title,
	'title' => $title,
	'class_input' => 'full_size',
	'class_wrapper_input' => 'full_size'
];
if(!isset($content['list'])) $content['list'] = [];
MM_Module_Multiple_Input::create('list', $settings, $content['list']); ?>