<?php
$url = 'http://live.eservice-hk.net/hktv?vid=';
$name = urldecode($_GET['name']);
if(isset($_GET['vid']) && isset($name)) {
    $content = "@echo off\r\n";
    $content .= "title 正在下載 $name\r\n";
    $content .= 'ffmpeg -i "'."{$url}{$_GET['vid']}".'" -c copy "'."$name".'.ts"';
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.$name.'.bat');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($content));
    echo $content;
} else {
    echo "Download Error!";
}
?>
