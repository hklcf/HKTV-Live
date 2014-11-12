<?php
$ott_token_json = 'https://www.hktvmall.com/ott/token';
$ott_token_result = json_decode(file_get_contents($ott_token_json), true);
$ott_uid = $ott_token_result['user_id'];
$ott_token = $ott_token_result['token'];
$ott_expiry_date = $ott_token_result['expiry_date'];

$playlist_json = 'https://ott-www.hktvmall.com/api/playlist/request?uid={$ott_uid}&vid=1&t={$ott_token}&ppos=0&_={$ott_expiry_date}';
$playlist_result = json_decode(file_get_contents($playlist_json), true);
?>
