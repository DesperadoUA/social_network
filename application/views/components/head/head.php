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
    <meta name="google-site-verification" content="2fi_ej5nKMJvNz6jI9eJBsWwnZMEDsZQot-ObPR9o3s" />
    <link rel="icon" href="<?= $options['icon']['image']['src']; ?>" sizes="32x32" />
    <?php
    if($options['indexing']['status'] === 0) {
        echo "<meta name='robots' content='noindex, nofollow'/>";
    }
    ?>
    <style>
    <?php
        $this->load->view('components/variable/style.css');
        $this->load->view('components/fonts/style.css');
        $this->load->view('components/common/style.css');
        $this->load->view('components/header/style.css');
        $this->load->view('components/content/style.css');
        $this->load->view('components/footer/style.css');
        $this->load->view('components/forms/style.css');
        $this->load->view('components/cookies/style.css');

        if($body['post_type'] === 'home') {
             $this->load->view('components/home_main/style.css');
             $this->load->view('components/advantages/style.css');
             $this->load->view('components/how_it_work/style.css');
             $this->load->view('components/current_research/style.css');
             $this->load->view('components/medical_directions/style.css');
             $this->load->view('components/cities/style.css');
             $this->load->view('components/profile_ad/style.css');
        }
        elseif ($body['post_type'] === 'research') {
             $this->load->view('components/research_main_screen/style.css');
             $this->load->view('components/research_loop/style.css');
             $this->load->view('components/pagination/style.css');
             $this->load->view('components/research_single/style.css');
             $this->load->view('components/research_relative_clinic/style.css');
             $this->load->view('components/relative_research_title/style.css');
        }
        elseif ($body['post_type'] === 'city') {
             $this->load->view('components/research_main_screen/style.css');
             $this->load->view('components/research_loop/style.css');
             $this->load->view('components/pagination/style.css');
        }
        elseif ($body['post_type'] === 'clinics') {
             $this->load->view('components/research_main_screen/style.css');
             $this->load->view('components/clinical_loop/style.css');
             $this->load->view('components/pagination/style.css');
        }
        elseif ($body['post_type'] === 'clinic') {
             $this->load->view('components/single_clinic_main_screen/style.css');
             $this->load->view('components/research_loop/style.css');
             $this->load->view('components/pagination/style.css');
        }
        elseif ($body['post_type'] === 'how-it-works') {
             $this->load->view('components/how_it_work/style.css');
             $this->load->view('components/how_it_work_step/style.css');
             $this->load->view('components/cities/style.css');
             $this->load->view('components/profile_ad/style.css');
        }
        elseif ($body['post_type'] === 'for-specialists') {
             $this->load->view('components/for-specialists/style.css');
             $this->load->view('components/cities/style.css');
        }
        elseif ($body['post_type'] === 'blog') {
             $this->load->view('components/blog_main_loop/style.css');
             $this->load->view('components/pagination/style.css');
             $this->load->view('components/blog_single_top/style.css');
        }
        elseif ($body['post_type'] === 'thx') {
             $this->load->view('components/thx/style.css');
        }
        elseif ($body['post_type'] === '404') {
             $this->load->view('components/404/style.css');
        }
        elseif ($body['post_type'] === 'default') {
             $this->load->view('components/blog_single_top/style.css');
        }
        elseif ($body['post_type'] === 'subscription') {
             $this->load->view('components/subscription_banner/style.css');
             $this->load->view('components/subscription_description/style.css');
             $this->load->view('components/subscription_form/style.css');
             $this->load->view('components/research_loop/style.css');
             $this->load->view('components/subscription_useful/style.css');
             $this->load->view('components/subscription_how_it_work/style.css');
             $this->load->view('components/subscription_form_main/style.css');
        }
        elseif ($body['post_type'] === 'contacts') {
            $this->load->view('components/contacts/style.css');
        }
        elseif ($body['post_type'] === 'stories') {
            $this->load->view('components/stories_main_screen/style.css');
            $this->load->view('components/stories_main_loop/style.css');
            $this->load->view('components/stories_single_top/style.css');
        }
        elseif ($body['post_type'] === 'security') {
            $this->load->view('components/security_main_screen/style.css');
            $this->load->view('components/security_get_consultation/style.css');
        }
        elseif ($body['post_type'] === 'referral') {
            $this->load->view('components/referral_main_screen/style.css');
            $this->load->view('components/referral_get_consultation/style.css');
        }
        elseif ($body['post_type'] === 'healing') {
          $this->load->view('components/healing_main_screen/style.css');
          $this->load->view('components/healing_loop/style.css');
          $this->load->view('components/pagination/style.css');
          $this->load->view('components/stories_single_top/style.css');
      }
    ?>
    </style>
</head>
<body>
