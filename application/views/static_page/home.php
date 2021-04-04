<?php
$this->load->view('components/head/head.php');
$this->load->view('components/header/header.php');
$this->load->view('components/home_main/index.php');
if(!empty($settings['pluses']['images_and_text'])) {
	$this->load->view('components/advantages/index.php');
}
if(!empty($settings['how_it_work']['list'])) {
	$this->load->view('components/how_it_work/index.php');
}
if(!empty($research)) {
	$this->load->view('components/current_research/index.php');
}
if(!empty($settings['directions']['images_and_text'])) {
	$this->load->view('components/medical_directions/index.php');
}
$this->load->view('components/cities/index.php');
$this->load->view('components/profile_ad/index.php');
if(!empty($body['content']['text'])){
	$this->load->view('components/content/index.php');
}
$this->load->view('components/footer/index.php');