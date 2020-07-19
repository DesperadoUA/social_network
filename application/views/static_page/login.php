<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title; ?></title>
    <style>
       <?php $this->load->view('components/login_form/style.css'); ?>
    </style>
</head>
<body>
   <?php $this->load->view('components/login_form/view.php'); ?>
</body>
<script src="/js/login_admin.js" language="javascript" type="text/javascript"></script>
</html>