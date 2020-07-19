<?php
include ROOT_COMPONENTS . 'head/head.php';
include ROOT_COMPONENTS . 'header/header.php';
include ROOT_COMPONENTS . 'h1/index.php';
include ROOT_COMPONENTS . 'users/view.php';
echo '<hr>';
$this->load->view('components/users/view.php');
include ROOT_COMPONENTS . 'footer/footer.php';