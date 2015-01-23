<?php
$url = 'http://live.eservice-hk.net/hktv/';
$lists_page = $_GET['page'] ? $_GET['page'] : '1';
$lists_lim = $_GET['lim'] ? $_GET['lim'] : '6';
$lists_ofs = $lists_page * $lists_lim - $lists_lim;
$lists_json = json_decode(file_get_contents("https://ott-www.hktvmall.com/api/lists/getProgram?lim={$lists_lim}&ofs={$lists_ofs}"), true);
foreach($lists_json['videos'] as $program_x => $program_x_value) {
    rsort($program_x_value['child_nodes']);
    foreach($program_x_value['child_nodes'] as $program_y => $program_y_value) {
        sort($program_y_value['child_nodes']);
        if($program_y_value['video_id'] == $_GET['vid']) {
            if($_GET['download']) {
                $content = "@echo off\r\n";
                $content .= "chcp 65001\r\n";
                $content .= "title {$program_y_value['title']}\r\n";
                foreach($program_y_value['child_nodes'] as $program_z => $program_z_value) {
                    $section .= '"'.$program_z_value['title'].'.ts"+';
                    $content .= 'ffmpeg -i "'."{$url}?vid={$program_z_value['video_id']}".'" -c copy "'."{$program_z_value['title']}".'.ts"'."\r\n";
                }
                $content .= 'copy /b '."$section".'"" "'."{$program_y_value['title']}".'.ts"'."\r\n";
                $content .= 'ffmpeg -i "'."{$program_y_value['title']}".'.ts" -c copy -bsf:a aac_adtstoasc "'."{$program_y_value['title']}".'.mp4"'."\r\n";
                $content .= 'del "'."{$program_y_value['title']}".'.ts"';
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename='."{$program_y_value['title']}".'.bat');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($content));
                echo $content;
            } else {
                $adfly_cfg['folder'] = urlencode('HKTV');
                $adfly_cfg['title'] = urlencode($program_y_value['title']);
                $adfly_api = "http://api.adf.ly/api.php?key=52e3e71436ca2e4c736243d0d89ecb39&uid=71043&advert_type=int&domain=go.eservice-hk.net&folder={$adfly_cfg['folder']}&title={$adfly_cfg['title']}&url=";
                $adfly_url = urlencode("{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}&download=1");
                $url = file_get_contents("{$adfly_api}{$adfly_url}");
                header("Location: $url");
            }
        }
    }
}
?>
