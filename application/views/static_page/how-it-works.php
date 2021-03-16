<?php
include ROOT_COMPONENTS . 'head/head.php';
include ROOT_COMPONENTS . 'header/header.php';
if(!empty($settings['how_it_work']['list'])) {
	include ROOT_COMPONENTS . 'how_it_work/index.php';
}
include ROOT_COMPONENTS . 'how_it_work_step/index.php';
include ROOT_COMPONENTS . 'cities/index.php';
include ROOT_COMPONENTS . 'profile_ad/index.php';
if(!empty($body['content']['text'])){
	include ROOT_COMPONENTS . 'content/index.php';
}
include ROOT_COMPONENTS . 'footer/index.php';