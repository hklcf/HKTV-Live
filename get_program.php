<?php
$lists_page = $_GET['page'] ? $_GET['page'] : '0';
$lists_ofs = $lists_page * '6';
$lists_json = json_decode(file_get_contents("https://ott-www.hktvmall.com/api/lists/getProgram?lim=6&ofs={$lists_ofs}"), true);
foreach($lists_json['videos'] as $program => $program_value) {
    //print_r($program_value['child_nodes']);
    foreach($program_value['child_nodes'] as $key => $key_value) {
        print_r($key_value['title']."-");
        //print_r($key_value);
        foreach($key_value['child_nodes'] as $y => $y_value) {
            print_r($y_value['title']."http://live.eservice-hk.net/hktv?vid=".$y_value['video_id']."\r\n");
            echo "\r\n";
        }
    }
}
?>
