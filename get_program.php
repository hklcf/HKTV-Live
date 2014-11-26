<?php
$lists_page = $_GET['page'] ? $_GET['page'] : '0';
$lists_ofs = $lists_page * '6';
$lists_json = json_decode(file_get_contents("https://ott-www.hktvmall.com/api/lists/getProgram?lim=6&ofs={$lists_ofs}"), true);
foreach($lists_json['videos'] as $program => $program_value) {
    //var_dump($x_value['child_nodes'][0][child_nodes]);
    var_dump($program_value['child_nodes'][0]);
}
?>
