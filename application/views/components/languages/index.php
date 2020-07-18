<?php
$uri = $_SERVER['REQUEST_URI'];
$lang = '';
if(strpos($uri, '/ua/') === 0) $lang = 'ua';
else $lang = 'ru';
return $lang;