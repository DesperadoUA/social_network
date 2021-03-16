<?php
$settings = [
	'module_title' => $title,
	'title' => '',
	'class_input' => 'full_size',
	'class_wrapper_input' => 'full_size'
];
if(!isset($content['text'])) $content['text'] = '';
MM_Module_Input::create('text', $settings, $content['text']); ?>