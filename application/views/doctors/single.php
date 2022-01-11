<?php
$this->load->view('components/head/head.php');
$this->load->view('components/header/header.php');
$this->load->view('components/doctors_single_top/index.php');
if(!empty($body['research'])) {
    $section_heading = TRANSLATE['CURRENT_CR'][LANG];
    include ROOT.'/application/views/components/title_section/index.php';
    $research = $body['research'];
    include ROOT.'/application/views/components/research_loop/index.php';
}
if(!empty($body['research_completed'])) {
    $section_heading = TRANSLATE['COMPLETED_CR'][LANG];
    include ROOT.'/application/views/components/title_section/index.php';
    $research = $body['research_completed'];
    include ROOT.'/application/views/components/research_loop/index.php';
}
$this->load->view('components/footer/index.php');