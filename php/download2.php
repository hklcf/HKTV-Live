<?php
$name = urldecode($_GET['name']);
if(isset($_GET['content']) && isset($_GET['name'])) {
    $content = "@echo off\r\n";
    $content .= "chcp 65001\r\n";
    $content .= "title 正在下載 $name\r\n";
    $content .= $_GET['content'];
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
