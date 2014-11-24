<?php
$debug = file_get_contents('https://www.hktvmall.com/hktv/zh/login', true);
$debug_s = strpos($debug, 'CSRFToken');
$debug_e = strpos($debug, '"', $debug_s + 18);
$csrf_token = substr($debug,$debug_s+18,$debug_e-strlen($debug));

print($csrf_token);
?>
