<?php
$settings = [
	'module_title' => $title,
	'title' => ['text 1', 'text 2']
];
if(!isset($content['menu'])) $content['menu'] = [];
MM_Module_Two_Input::create(
	'menu',
	$settings,
	$content['menu']);