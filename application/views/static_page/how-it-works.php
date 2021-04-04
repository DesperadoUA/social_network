<?php
$this->load->view('components/head/head.php');
$this->load->view('components/header/header.php');
if(!empty($settings['how_it_work']['list'])) {
	$this->load->view('components/how_it_work/index.php');
}
$this->load->view('components/how_it_work_step/index.php');
$this->load->view('components/cities/index.php');
$this->load->view('components/profile_ad/index.php');
if(!empty($body['content']['text'])){
	$this->load->view('components/content/index.php');
}
$this->load->view('components/footer/index.php');