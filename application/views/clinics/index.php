<?php
$this->load->view('components/head/head.php');
$this->load->view('components/header/header.php');
$this->load->view('components/clinic_main_screen/index.php');
if(!empty($posts)) $this->load->view('components/clinical_loop/index.php');
$this->load->view('components/pagination/index.php');
$this->load->view('components/footer/index.php');