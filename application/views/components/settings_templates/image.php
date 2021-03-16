<?php
if(!isset($content['image'])){
	$content['image'] = [
		'src' => '',
		'mobile_src' => '',
		'title' => '',
		'alt' => ''
	];
}
MM_Module_Image::create('image',
	array(
		'class_wrapper' => 'class_wrapper',
		'class_input'   => 'class_input',
		'title'         => $title
	),
	$content['image']);