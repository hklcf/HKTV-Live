<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
<title>HKTV 免登入睇點播</title>
</head>

<body>
<?php
$url = 'http://live.eservice-hk.net/hktv?vid=';
$lists_page = $_GET['page'] ? $_GET['page'] : '1';
$lists_lim = $_GET['lim'] ? $_GET['lim'] : '6';
$lists_ofs = $lists_page * $lists_lim - $lists_lim;
$lists_json = json_decode(file_get_contents("https://ott-www.hktvmall.com/api/lists/getProgram?lim={$lists_lim}&ofs={$lists_ofs}"), true);
$lists_total_page = ceil($lists_json['total_videos']/$lists_lim);
if($lists_page <= $lists_total_page) {
    foreach($lists_json['videos'] as $program_x => $program_x_value) {
        echo "<h1>{$program_x_value['title']}</h1>";
        echo "<br>";
        echo "<img src='{$program_x_value['thumbnail']}' alt='{$program_x_value['title']}'>";
        echo "<br>";
        foreach($program_x_value['child_nodes'] as $program_y => $program_y_value) {
            echo "<span>{$program_y_value['title']}</span>";
            echo "<br>";
            foreach($program_y_value['child_nodes'] as $program_z => $program_z_value) {
                echo "<a href='{$url}{$program_z_value['video_id']}'>{$program_z_value['title']}</a>";
                echo "<br>";
            }
        }
        echo "<br>";
    }
    echo "Page {$lists_page} of {$lists_total_page}"; // page
} else {
    echo "Page not found";
}
?>
</body>

</html>
