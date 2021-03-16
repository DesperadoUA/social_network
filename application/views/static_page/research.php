<?php
include ROOT_COMPONENTS . 'head/head.php';
include ROOT_COMPONENTS . 'header/header.php';
include ROOT_COMPONENTS . 'research_main_screen/index.php';
include ROOT_COMPONENTS . 'research_loop/index.php';
include ROOT_COMPONENTS . 'pagination/index.php';
if(!empty($content['text'])){
	include ROOT_COMPONENTS . 'content/index.php';
}
include ROOT_COMPONENTS . 'footer/index.php';