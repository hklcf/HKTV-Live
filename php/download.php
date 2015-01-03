<?php
$url = 'http://live.eservice-hk.net/hktv?vid=';
if(isset($_GET['vid']) && isset($_GET['name'])) {
    $content = "@echo off\r\n";
    $content .= "title 正在下載 {$program_z_value['title']}\r\n";
    $content .= 'ffmpeg -i '."{$url}{$program_z_value['video_id']}".' -c copy '."{$program_z_value['title']}".'.ts"';
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream; charset=UTF-8');
    header('Content-Disposition: attachment; filename='.$program_z_value['title'].'.bat');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($content));
    echo $content;
} else {
    echo "Download Error!";
}
?>
