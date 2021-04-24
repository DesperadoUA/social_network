<?php
$settings = [
	'module_title' => 'Public',
	'title' => 'public',
];
if(!isset($content['status'])) $content['status'] = "1";
MM_Module_Checkbox::create('status', $settings, $content['status']);
?>