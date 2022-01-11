<?php
$this->load->view('components/head/head.php');
$this->load->view('components/header/header.php');
$this->load->view('components/doctors_main_screen/index.php');
$this->load->view('components/doctors_loop/index.php');
$this->load->view('components/pagination/index.php');
if(!empty($content['text'])) {
	$this->load->view('components/content/index.php');
}
$this->load->view('components/footer/index.php');