<?php
$json = 'https://www.hktvmall.com/ott/token';
$result = json_decode(file_get_contents($json), true);

$token = $result['token'];
$expiry_date = $result['expiry_date']);
?>
