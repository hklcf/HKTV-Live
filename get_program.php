<?php
$lists_page = $_GET['page'] ? $_GET['page'] : '0';
$lists_ofs = $lists_page * '6';
$lists_json = json_decode(file_get_contents("https://ott-www.hktvmall.com/api/lists/getProgram?lim=6&ofs={$lists_ofs}"), true);
foreach($lists_json['videos'] as $program => $program_value) {
    //print_r($program_value['child_nodes']);
    foreach($program_value['child_nodes'] as $key => $key_value) {
        echo $key_value['title'];
        echo "<br>";
        foreach($key_value['child_nodes'] as $y => $y_value) {
            echo "<a href='http://live.eservice-hk.net/hktv?vid={$y_value['video_id']}'>{$y_value['title']}</a>";
            echo "<br>";
        }
    }
}
?>
