<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $body['meta_title']; ?></title>
    <meta name="keywords" content="<?= $body['keywords']; ?>" />
    <meta name="description" content="<?= $body['description']; ?>" />
    <link rel="icon" href="<?= $options['icon']['image']['src']; ?>" sizes="32x32" />
    <style>
    <?php
        include ROOT_COMPONENTS . 'fonts/style.css';
        include ROOT_COMPONENTS . 'common/style.css';
        include ROOT_COMPONENTS . 'header/style.css';
        include ROOT_COMPONENTS . 'content/style.css';
        include ROOT_COMPONENTS . 'footer/style.css';
        include ROOT_COMPONENTS . 'forms/style.css';

        if($body['post_type'] === 'home') {
             include ROOT_COMPONENTS . 'home_main/style.css';
             include ROOT_COMPONENTS . 'advantages/style.css';
             include ROOT_COMPONENTS . 'how_it_work/style.css';
             include ROOT_COMPONENTS . 'current_research/style.css';
             include ROOT_COMPONENTS . 'medical_directions/style.css';
             include ROOT_COMPONENTS . 'cities/style.css';
             include ROOT_COMPONENTS . 'profile_ad/style.css';
        }
        elseif ($body['post_type'] === 'research') {
             include ROOT_COMPONENTS . 'research_main_screen/style.css';
             include ROOT_COMPONENTS . 'research_loop/style.css';
             include ROOT_COMPONENTS . 'pagination/style.css';
             include ROOT_COMPONENTS . 'research_single/style.css';
             include ROOT_COMPONENTS . 'research_relative_clinic/style.css';
        }
        elseif ($body['post_type'] === 'city') {
          include ROOT_COMPONENTS . 'research_main_screen/style.css';
          include ROOT_COMPONENTS . 'research_loop/style.css';
          include ROOT_COMPONENTS . 'pagination/style.css';
        }
        elseif ($body['post_type'] === 'clinics') {
             include ROOT_COMPONENTS . 'research_main_screen/style.css';
             include ROOT_COMPONENTS . 'clinical_loop/style.css';
             include ROOT_COMPONENTS . 'pagination/style.css';
        }
        elseif ($body['post_type'] === 'clinic') {
             include ROOT_COMPONENTS . 'single_clinic_main_screen/style.css';
             include ROOT_COMPONENTS . 'research_loop/style.css';
             include ROOT_COMPONENTS . 'pagination/style.css';
        }
        elseif ($body['post_type'] === 'how-it-works') {
             include ROOT_COMPONENTS . 'how_it_work/style.css';
             include ROOT_COMPONENTS . 'how_it_work_step/style.css';
             include ROOT_COMPONENTS . 'cities/style.css';
             include ROOT_COMPONENTS . 'profile_ad/style.css';
        }
        elseif ($body['post_type'] === 'for-specialists') {
             include ROOT_COMPONENTS . 'for-specialists/style.css';
             include ROOT_COMPONENTS . 'cities/style.css';
        }
        elseif ($body['post_type'] === 'blog') {
             include ROOT_COMPONENTS . 'blog_main_loop/style.css';
             include ROOT_COMPONENTS . 'pagination/style.css';
             include ROOT_COMPONENTS . 'blog_single_top/style.css';
        }
        elseif ($body['post_type'] === 'thx') {
            include ROOT_COMPONENTS . 'thx/style.css';
        }
        elseif ($body['post_type'] === '404') {
            include ROOT_COMPONENTS . '404/style.css';
        }
    ?>
    </style>
</head>
<body>
