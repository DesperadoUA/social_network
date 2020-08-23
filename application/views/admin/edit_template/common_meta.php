<div class="meta_wrapper">
    <?php
         $settings = [
                 'title' => 'Meta Title',
                 'class_wrapper' => 'full_size'
         ];
         MM_Module_Input::create('title', $settings, $title); ?>
	<?php
        $settings = [
            'title' => 'Permalink',
			'class_wrapper' => 'full_size'
        ];
          MM_Module_Input::create('permalink', $settings, $permalink); ?>
	<?php
        $settings = [
                'title' => 'Description',
			    'class_wrapper' => 'full_size'
          ];
          MM_Module_Input::create('description', $settings, $description); ?>
	<?php
            $settings = [
                'title' => 'Keywords',
				'class_wrapper' => 'full_size'
            ];
          MM_Module_Input::create('keywords', $settings, $keywords); ?>
	<?php
            $settings = [
                'title' => 'Дата публикации',
                'readonly' => 'readonly',
                'type' => 'date',
				'class_wrapper' => 'full_size'
            ];
          MM_Module_Input::create('data_publick', $settings, $data_publick); ?>
	<?php
            $settings = [
                'title' => 'Дата редактирования',
                'type' => 'date',
				'class_wrapper' => 'full_size'
            ];
          MM_Module_Input::create('data_change', $settings, $data_change); ?>
	<?php
         $settings = [
                 'title' => 'Основной контент'
         ];
         MM_Module_Rich_Text::create('main_content', $settings, $content['text']); ?>
</div>