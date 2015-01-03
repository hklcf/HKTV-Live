<?php
$url = 'http://live.eservice-hk.net/hktv?vid=';
$lists_page = $_GET['page'] ? $_GET['page'] : '1';
$lists_lim = $_GET['lim'] ? $_GET['lim'] : '6';
$lists_ofs = $lists_page * $lists_lim - $lists_lim;
$lists_json = json_decode(file_get_contents("https://ott-www.hktvmall.com/api/lists/getProgram?lim={$lists_lim}&ofs={$lists_ofs}"), true);
$lists_total_page = ceil($lists_json['total_videos']/$lists_lim);
if($lists_page <= $lists_total_page) {
    foreach($lists_json['videos'] as $program_x => $program_x_value) {
        rsort($program_x_value['child_nodes']);
        foreach($program_x_value['child_nodes'] as $program_y => $program_y_value) {
            sort($program_y_value['child_nodes']);
            foreach($program_y_value['child_nodes'] as $program_z => $program_z_value) {
            }
        }
    }
    if(isset($_GET['vid'])) {
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
    }
} else {
    echo "Page not found";
}
?>
