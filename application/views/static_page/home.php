<?php
include ROOT_COMPONENTS . 'head/head.php';
include ROOT_COMPONENTS . 'header/header.php';
include ROOT_COMPONENTS . 'home_main/index.php';
if(!empty($settings['pluses']['images_and_text'])) {
	include ROOT_COMPONENTS . 'advantages/index.php';
}
if(!empty($settings['how_it_work']['list'])) {
	include ROOT_COMPONENTS . 'how_it_work/index.php';
}
if(!empty($research)) {
	include ROOT_COMPONENTS . 'current_research/index.php';
}
include ROOT_COMPONENTS . 'medical_directions/index.php';
include ROOT_COMPONENTS . 'cities/index.php';
include ROOT_COMPONENTS . 'profile_ad/index.php';
if(!empty($body['content']['text'])){
	include ROOT_COMPONENTS . 'content/index.php';
}
include ROOT_COMPONENTS . 'footer/index.php';