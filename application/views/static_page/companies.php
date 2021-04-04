<?php
$this->load->view('components/head/head.php');
$this->load->view('components/header/header.php');
if(!empty($content['text'])){
	$this->load->view('components/content/index.php');
}
$this->load->view('components/footer/index.php');