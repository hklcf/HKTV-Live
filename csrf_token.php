<?php
$csrf_token_url = file_get_contents('https://www.hktvmall.com/hktv/zh/login', true);
$csrf_token_s = strpos($csrf_token_url, 'CSRFToken');
$csrf_token_e = strpos($csrf_token_url, '"', $csrf_token_s + 18);
$csrf_token = substr($csrf_token_url, $csrf_token_s + 18, $csrf_token_e - strlen($csrf_token_url));

print($csrf_token);
?>
