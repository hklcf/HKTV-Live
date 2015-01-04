<?php
$url = 'http://live.eservice-hk.net/hktv?vid=';
$name = urldecode($_GET['name']);
if(isset($_GET['vid']) && isset($_GET['name'])) {
    $content = "@echo off\r\n";
    $content .= "chcp 65001\r\n";
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

<?php
$url = 'http://live.eservice-hk.net/hktv?vid=';
$lists_lim = $_GET['lim'] ? $_GET['lim'] : '6';
$lists_ofs = $lists_page * $lists_lim - $lists_lim;
$lists_json = json_decode(file_get_contents("https://ott-www.hktvmall.com/api/lists/getProgram?lim={$lists_lim}&ofs={$lists_ofs}"), true);
$lists_total_page = ceil($lists_json['total_videos']/$lists_lim);
foreach($lists_json['videos'] as $program_x => $program_x_value) {
    rsort($program_x_value['child_nodes']);
    foreach($program_x_value['child_nodes'] as $program_y => $program_y_value) {
        sort($program_y_value['child_nodes']);
        echo "<span>{$program_y_value['title']}</span>";
        echo "<br>";
        foreach($program_y_value['child_nodes'] as $program_z => $program_z_value) {
            echo "<a href='{$url}{$program_z_value['video_id']}'>{$program_z_value['title']}</a>";
            echo " | ";
            echo "<a href='download.php?vid={$program_z_value['video_id']}&name=".urlencode($program_z_value['title'])."'>Download</a>";
            echo "<br>";
        }
    }
    echo "<br>";
}
if($lists_page > '1') {
    $lists_pervious_page = $lists_page - '1';
    echo "<a href='?page={$lists_pervious_page}'><&nbsp;</a>";
}
echo "Page {$lists_page} of {$lists_total_page}";
if($lists_page < $lists_total_page) {
    $lists_next_page = $lists_page + '1';
    echo "<a href='?page={$lists_next_page}'>&nbsp;></a>";
}
?>
