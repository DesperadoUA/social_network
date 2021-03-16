<div class="meta_wrapper">
	<?php
	$settings = [
		'module_title' => 'Title',
		'title' => 'Meta Title',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('title', $settings, $title); ?>
	<?php
	$settings = [
		'module_title' => 'H1',
		'title' => 'h1',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('h1', $settings, $h1); ?>
    <?php
	$settings = [
		'module_title' => 'Public',
		'title' => 'public',
	];
	MM_Module_Checkbox::create('public', $settings, $status);
    ?>
	<?php
	$settings = [
		'module_title' => 'Permalink',
		'title' => 'permalink',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('permalink', $settings, $permalink); ?>
	<?php
	$settings = [
		'module_title' => 'Meta Title',
		'title' => 'Meta Title',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('meta_title', $settings, $meta_title); ?>
	<?php
	$settings = [
		'module_title' => 'Description',
		'title' => 'Meta Description',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('description', $settings, $description); ?>
	<?php
	$settings = [
		'module_title' => 'Keywords',
		'title' => 'Meta Keywords',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('keywords', $settings, $keywords); ?>
	<?php
	$settings = [
		'module_title' => 'Short Desc',
		'title' => 'Short desc',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Textarea::create('short_desc', $settings, $short_desc); ?>
	<?php
	$settings = [
		'module_title' => 'Date of publication',
		'title' => 'Дата публикации',
		'type' => 'date',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('data_publick', $settings, $data_publick); ?>
	<?php
	$settings = [
		'module_title' => 'Editing date',
		'title' => 'Дата редактирования',
		'type' => 'date',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Input::create('data_change', $settings, $data_change); ?>
	<?php
	$settings = [
		'title' => 'Main content'
	];
	MM_Module_Rich_Text::create('main_content', $settings, $content); ?>
	<?php
	$settings = [
		'class_wrapper' => 'class_wrapper',
		'class_input'   => 'class_input',
		'title'         => 'Thumbnail'
	];
	if(empty($thumbnail)){
		$thumbnail = [
			'src' => '',
			'mobile_src' => '',
			'title' => '',
			'alt' => ''
		];
	} else {
		$thumbnail = json_decode($thumbnail, true);
	}
	MM_Module_Image::create('thumbnail', $settings, $thumbnail);
	?>
	<?php
	$settings = [
		'module_title' => 'Lang',
		'title' => 'lang',
		'class_wrapper_input' => 'full_size',
        'value' => ARRAY_LANG
	];
	MM_Module_Radio_Button::create('lang', $settings, $lang);
	?>
</div>