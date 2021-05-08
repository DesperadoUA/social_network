<?php
$uri = $_SERVER['REQUEST_URI'];
$lang = '';
if(strpos($uri, '/ru') === 0) $lang = 'ru';
else $lang = 'ua';
return $lang;