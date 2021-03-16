<div class="meta_wrapper">
	<?php
	$settings = [
		'module_title' => 'Заголовок модуля',
		'title' => 'Meta Title',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Textarea::create('title', $settings, $title); ?>
	<?php
	$settings = [
		'module_title' => 'Заголовок модуля пермалик',
		'title' => 'Permalink',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Textarea::create('permalink', $settings, $permalink); ?>
	<?php
	$settings = [
		'module_title' => 'Заголовок модуля Description',
		'title' => 'Description',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Textarea::create('description', $settings, $description); ?>
	<?php
	$settings = [
		'module_title' => 'Заголовок модуля Keywords',
		'title' => 'Keywords',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Textarea::create('keywords', $settings, $keywords); ?>
	<?php
	$settings = [
		'module_title' => 'Заголовок модуля Data',
		'title' => 'Дата публикации',
		'readonly' => 'readonly',
		'type' => 'date',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Textarea::create('data_publick', $settings, $data_publick); ?>
	<?php
	$settings = [
		'module_title' => 'Заголовок модуля Дата редактирования',
		'title' => 'Дата редактирования',
		'type' => 'date',
		'class_input' => 'full_size',
		'class_wrapper_input' => 'full_size'
	];
	MM_Module_Textarea::create('data_change', $settings, $data_change); ?>
	<?php
	$settings = [
		'title' => 'Основной контент'
	];
	MM_Module_Rich_Text::create('main_content', $settings, $content['text']); ?>
</div>



//-------------------------------------------------------//
<?php
$settings = [
'module_title' => 'My new header',
'title' => ['Input title', 'Input permalink']
];
MM_Module_Cyr_To_Lat::create(['title','permalink'], $settings,
$value = [
'title' => 'value Title 1',
'permalink' => 'value Permalink 1'
]);

$settings = [
'module_title' => 'Хлебные крошки',
'title' => ['Ссылка', 'Анкор']
];
MM_Module_Two_Input::create(
'breadcrumbs',
$settings,
$content['breadcrumbs']);

$settings = [
'module_title' => 'Меню',
'title' => ['Ссылка', 'Анкор']
];
MM_Module_Two_Input::create(
'menu',
$settings,
$content['menu']);

MM_Module_Image::create('thumbnail',
array(
'class_wrapper' => 'class_wrapper',
'class_input'   => 'class_input',
'title'         => 'Модуль изображения новый'
),
$thumbnail);

MM_Module_Image::create('support_img',
array(
'class_wrapper' => 'class_wrapper',
'class_input'   => 'class_input',
'title'         => 'Новое изображение'
),
$content['support_img']);

$settings = [
'title' => 'Второе описание'
];
MM_Module_Rich_Text::create('second_text', $settings , $content['second_text']);

$settings = [
'title' => 'Множество изображений'
];
MM_Module_Multiple_Image::create('multiple_image', $settings, $content['multiple_img']);

$settings = [
'title' => 'Множество изображений и текст'
];
MM_Module_Multiple_Image_And_Text::create('multiple_image_and_text',
$settings, $content['multiple_image_and_text']);

$settings = [
'module_title' => 'Связаные посты'
];
$content['relative_posts'] = [
'all_data' => [
['post_title' => 'Title 1', 'id' => '1'],
['post_title' => 'Title 2', 'id' => '2'],
],
'id' => $content['relative']
];
MM_Module_Relative::create('relative_posts', $settings, $content['relative_posts']);