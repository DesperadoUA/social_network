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
        if(!isset($content['h1'])) $content['h1'] = '';
        MM_Module_Input::create('h1', $settings, $content['h1']); ?>
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
                'readonly' => 'readonly',
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
         if(!isset($content['text'])) $content['text'] = '';
         MM_Module_Rich_Text::create('main_content', $settings, $content['text']); ?>
</div>