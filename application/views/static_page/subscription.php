<?php
$this->load->view('components/head/head.php');
$this->load->view('components/header/header.php');
$this->load->view('components/subscription_banner/index.php');
$this->load->view('components/subscription_description/index.php');
//$this->load->view('components/subscription_form/index.php');
/*
if(!empty($research)) {
	echo "<div class='revers'>";
	$this->load->view('components/research_loop/index.php');
	echo "</div>";
}
*/
$this->load->view('components/subscription_useful/index.php');
$this->load->view('components/subscription_how_it_work/index.php');
$this->load->view('components/subscription_form_main/index.php');
$this->load->view('components/footer/index.php');