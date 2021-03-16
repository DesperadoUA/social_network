<?php
function img_src_device() {
	$mobile_agent_array = array('ipad', 'iphone', 'android', 'pocket', 'palm', 'windows ce',
		'windowsce', 'cellphone', 'opera mobi', 'ipod', 'small', 'sharp',
		'sonyericsson', 'symbian', 'opera mini', 'nokia', 'htc_', 'samsung',
		'motorola', 'smartphone', 'blackberry', 'playstation portable',
		'tablet browser');
	$agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	foreach ($mobile_agent_array as $value) {
		if (strpos($agent, $value) !== false) return 'mobile_src';
	}
	return 'src';
}
return img_src_device();