<?php
$ott_token_json = 'https://www.hktvmall.com/ott/token';
$ott_token_result = json_decode(file_get_contents($ott_token_json), true);
$ott_uid = $ott_token_result['user_id'];
$ott_token = $ott_token_result['token'];
$ott_expiry_date = $ott_token_result['expiry_date'];
$playlist_json = "https://ott-www.hktvmall.com/api/playlist/request?uid={$ott_uid}&vid=1&t={$ott_token}&ppos=0&_={$ott_expiry_date}";
$playlist_result = json_decode(file_get_contents($playlist_json), true);
if(isset($_GET['q'])) {
    if($_GET['q'] == '1080') {
        $quality = 'http://ott-video-lb.hktvmall.com:8088/hktvlive/hktv_1080p_track.m3u8?t=40015c2923714fc5050772feda59544a&uid=1&vid=1&s=fdcf4484869ea1e2b13ca79119cc8e15';
    } elseif($_GET['q'] == '720') {
        $quality = 'http://ott-video-lb.hktvmall.com:8088/hktvlive/hktv_720p_track.m3u8?t=323c9f158bcde58a777d248da1136848&uid=1&vid=1&s=fa7c9ad23dd51415f5326310733367f5';
    } elseif($_GET['q'] == '576') {
        $quality = 'http://ott-video-lb.hktvmall.com:8088/hktvlive/hktv_576p_track.m3u8?t=f5e4c7c6f28dadaaa5f5f1eda1e1d55a&uid=1&vid=1&s=2d6782fd3977eb124eb4f89edb14d152';
    } else {
        $quality = $playlist_result['m3u8'];
    }
} else {
    $quality = $playlist_result['m3u8'];
}
header("Location: {$quality}");
?>
