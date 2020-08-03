<?php
    include ROOT.'/admin_modules/MM_Module_Input/MM_Module_Input.php';
    include ROOT.'/admin_modules/MM_Module_Rich_Text/MM_Module_Rich_Text.php';
?>
<div class="meta_wrapper">
    <?php MM_Module_Input::create('title', $title); ?>
	<?php MM_Module_Input::create('permalink', $permalink); ?>
	<?php MM_Module_Input::create('description', $description); ?>
	<?php MM_Module_Input::create('keywords', $keywords); ?>
	<?php MM_Module_Input::create('data_publick', $data_publick, 'readonly','date'); ?>
	<?php MM_Module_Input::create('data_change', $data_change,'readonly', 'date'); ?>
	<?php MM_Module_Rich_Text::create($content->text, 'Основной контент'); ?>
</div>