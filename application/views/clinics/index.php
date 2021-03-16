<?php
include ROOT_COMPONENTS . 'head/head.php';
include ROOT_COMPONENTS . 'header/header.php';
include ROOT_COMPONENTS . 'clinic_main_screen/index.php';
if(!empty($posts)) include ROOT_COMPONENTS . 'clinical_loop/index.php';
include ROOT_COMPONENTS . 'pagination/index.php';
include ROOT_COMPONENTS . 'footer/index.php';