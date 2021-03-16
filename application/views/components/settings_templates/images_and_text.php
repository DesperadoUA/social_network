<?php
if(!isset($content['images_and_text'])){
	$content['images_and_text'] = [];
}
MM_Module_Multiple_Image_And_Text::create('images_and_text',
	array(
		'class_wrapper' => 'class_wrapper',
		'class_input'   => 'class_input',
		'title'         => $title
	),
	$content['images_and_text']);